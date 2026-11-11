<?php

namespace App\Http\Controllers;

use App\Models\AssessmentMark;
use App\Models\AssessmentScheme;
use App\Models\ClassModel;
use App\Models\Student;
use App\Models\StudentMark;
use App\Models\ProgrammeStructure;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UppResultReportController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'programme' => ['nullable', 'string', 'max:100'],
            'session' => ['nullable', 'string', 'max:30'],
            'semester' => ['nullable', 'integer', 'min:1'],
            'class_id' => ['nullable', 'integer', Rule::exists('classes', 'class_id')],
        ]);

        $search = trim($validated['search'] ?? '');
        $programme = $validated['programme'] ?? '';
        $session = $validated['session'] ?? '';
        $semester = $validated['semester'] ?? '';
        $classId = $validated['class_id'] ?? '';

        $gradeScale = [
            ['min' => 90, 'grade' => 'A+', 'point' => 4.00, 'status' => 'Excellent'],
            ['min' => 80, 'grade' => 'A',  'point' => 4.00, 'status' => 'Excellent'],
            ['min' => 75, 'grade' => 'A-', 'point' => 3.67, 'status' => 'Excellent'],
            ['min' => 70, 'grade' => 'B+', 'point' => 3.33, 'status' => 'Good'],
            ['min' => 65, 'grade' => 'B',  'point' => 3.00, 'status' => 'Good'],
            ['min' => 60, 'grade' => 'B-', 'point' => 2.67, 'status' => 'Good'],
            ['min' => 55, 'grade' => 'C+', 'point' => 2.33, 'status' => 'Satisfactory'],
            ['min' => 50, 'grade' => 'C',  'point' => 2.00, 'status' => 'Satisfactory'],
            ['min' => 45, 'grade' => 'C-', 'point' => 1.67, 'status' => 'Pass'],
            ['min' => 40, 'grade' => 'D+', 'point' => 1.33, 'status' => 'Fail'],
            ['min' => 35, 'grade' => 'D',  'point' => 1.00, 'status' => 'Fail'],
            ['min' => 0,  'grade' => 'F',  'point' => 0.00, 'status' => 'Fail'],
        ];

        // Legacy overall marks remain available for subjects without a configured PB/PA scheme.
        $legacyMarks = StudentMark::with(['student', 'subject', 'classModel'])->get();

        // Require at least one PA component so old schemes whose assessment_type defaulted to PB
        // are not accidentally treated as PB/PA schemes.
        $schemes = AssessmentScheme::with('assessments')
            ->whereHas('assessments.marks')
            ->get()
            ->filter(fn ($scheme) => $scheme->assessments->contains(
                fn ($assessment) => strtoupper((string) $assessment->assessment_type) === 'PA'
            ));

        $pbPaClassKeys = collect();
        $pbPaRows = collect();

        foreach ($schemes as $scheme) {
            $schemeClasses = ClassModel::with('subject')
                ->where('subject_id', $scheme->subject_id)
                ->where('academic_session', $scheme->academic_session)
                ->get();

            foreach ($schemeClasses as $class) {
                $assessments = $scheme->assessments;
                if ($assessments->isEmpty()) {
                    continue;
                }

                $assessmentIds = $assessments->pluck('assessment_id');
                $marksByStudent = AssessmentMark::whereIn('assessment_id', $assessmentIds)
                    ->where('class_id', $class->class_id)
                    ->get()
                    ->groupBy('student_id');

                foreach ($marksByStudent as $studentId => $studentMarks) {
                    $marksByAssessment = $studentMarks->keyBy('assessment_id');

                    // Incomplete components are not final results; never treat missing marks as zero.
                    if (!$assessments->every(function ($assessment) use ($marksByAssessment) {
                        $record = $marksByAssessment->get($assessment->assessment_id);
                        return $record && $record->marks_obtained !== null;
                    })) {
                        continue;
                    }

                    $pbPaClassKeys->push(
                        $studentId.'|'.$class->class_id.'|'.$class->subject_id.'|'.$class->academic_session
                    );

                    $finalMark = 0.0;
                    $pbTotal = 0.0;
                    $paTotal = 0.0;
                    $pbWeightTotal = 0.0;
                    $paWeightTotal = 0.0;
                    $validScheme = true;

                    foreach ($assessments as $assessment) {
                        $maxMarks = (float) $assessment->max_marks;
                        $weight = (float) $assessment->weight_percentage;
                        $type = strtoupper((string) $assessment->assessment_type);

                        if ($maxMarks <= 0) {
                            $validScheme = false;
                            break;
                        }

                        if ($type === 'PB') {
                            $pbWeightTotal += $weight;
                        } elseif ($type === 'PA') {
                            $paWeightTotal += $weight;
                        }

                        $recordedMark = $marksByAssessment->get($assessment->assessment_id);
                        $weightedMark = ((float) $recordedMark->marks_obtained / $maxMarks) * $weight;
                        $finalMark += $weightedMark;

                        if ($type === 'PB') {
                            $pbTotal += $weightedMark;
                        } elseif ($type === 'PA') {
                            $paTotal += $weightedMark;
                        }
                    }

                    if (!$validScheme) {
                        continue;
                    }

                    $student = Student::where('student_id', $studentId)->first();
                    if (!$student) {
                        continue;
                    }

                    $pbPerformance = $pbWeightTotal > 0
                        ? round(($pbTotal / $pbWeightTotal) * 100, 2)
                        : null;
                    $paPerformance = $paWeightTotal > 0
                        ? round(($paTotal / $paWeightTotal) * 100, 2)
                        : null;

                    // Cohort eligibility is determined by programme structure intake_code.
                    $requiresPbEligibility = $this->requiresPbEligibility($student, (int) $class->semester);
                    $pbEligible = !$requiresPbEligibility ||
                        ($pbPerformance !== null && $pbPerformance >= 45);
                    $paPassed = $paPerformance !== null && $paPerformance >= 25;
                    $coursePassed = $pbEligible && $paPassed;

                    // Create an in-memory row compatible with the existing Blade view.
                    $row = new StudentMark([
                        'student_id' => (string) $studentId,
                        'subject_id' => $class->subject_id,
                        'class_id' => $class->class_id,
                        'marks' => round($finalMark, 2),
                        'academic_session' => $class->academic_session,
                    ]);

                    // The numeric mark stays visible; grade/GPA use the PB/PA pass rules below.
                    $row->pb_pa_course_failed = !$coursePassed;
                    $row->pb_pa_pb_percentage = $pbPerformance;
                    $row->pb_pa_pa_percentage = $paPerformance;
                    $row->pb_pa_pb_eligible = $pbEligible;
                    $row->pb_pa_pa_passed = $paPassed;
                    $row->pb_pa_pb_eligibility_required = $requiresPbEligibility;

                    $row->setRelation('student', $student);
                    $row->setRelation('subject', $class->subject);
                    $row->setRelation('classModel', $class);
                    $pbPaRows->push($row);
                }
            }
        }

        // Avoid showing both a legacy mark and a PB/PA result for the same class/subject/session.
        $legacyMarks = $legacyMarks->reject(function ($mark) use ($pbPaClassKeys) {
            $key = $mark->student_id.'|'.$mark->class_id.'|'.$mark->subject_id.'|'.$mark->academic_session;

            return $pbPaClassKeys->contains($key);
        });

        $allMarks = $legacyMarks->concat($pbPaRows)->values();

        foreach ($allMarks as $mark) {
            foreach ($gradeScale as $grade) {
                if ((float) $mark->marks >= $grade['min']) {
                    $mark->calculated_grade = $grade['grade'];
                    $mark->calculated_grade_point = $grade['point'];
                    $mark->calculated_status = $grade['status'];
                    break;
                }
            }

            // A PB eligibility failure or PA minimum failure makes the course grade F,
            // even when the weighted numeric total would normally receive a passing grade.
            if (($mark->pb_pa_course_failed ?? false) === true) {
                $mark->calculated_grade = 'F';
                $mark->calculated_grade_point = 0.00;
                $mark->calculated_status = 'Fail';
            }

            $creditHours = (float) ($mark->subject?->credit_hour ?? 0);
            $mark->calculated_credit_hours = $creditHours;
            $mark->calculated_credit_points = ($mark->calculated_grade_point ?? 0) * $creditHours;
        }
              
        $gradeRank = [
            'F' => 0,
            'D' => 1,
            'D+' => 2,
            'C-' => 3,
            'C' => 4,
            'C+' => 5,
            'B-' => 6,
            'B' => 7,
            'B+' => 8,
            'A-' => 9,
            'A' => 10,
            'A+' => 11,
        ];

        $bestAttempts = $allMarks
            ->groupBy(fn ($mark) =>
                $mark->student_id.'|'.$mark->subject_id
            )
            ->map(function ($attempts) use ($gradeRank) {

                // Select the highest earned grade.
                $best = $attempts->sortByDesc(
                    fn ($mark) => $gradeRank[$mark->calculated_grade] ?? -1
                )->first();

                // Place the selected grade in the latest repeat attempt.
                $latest = clone $attempts->sort(function ($a, $b) {
                    $aRepeat = $a->classModel?->class_type === 'repeat' ? 1 : 0;
                    $bRepeat = $b->classModel?->class_type === 'repeat' ? 1 : 0;

                    if ($aRepeat !== $bRepeat) {
                        return $bRepeat <=> $aRepeat;
                    }

                    return (int) $b->class_id <=> (int) $a->class_id;
                })->first();

                $latest->calculated_grade = $best->calculated_grade;
                $latest->calculated_grade_point = $best->calculated_grade_point;
                $latest->calculated_status = $best->calculated_status;
                $latest->calculated_credit_hours = $best->calculated_credit_hours;
                $latest->calculated_credit_points =
                    $best->calculated_grade_point * $latest->calculated_credit_hours;

                return $latest;
            })
            ->values();

        $gpaResults = [];
        foreach ($bestAttempts->groupBy(fn ($mark) =>
            $mark->student_id.'|'.$mark->academic_session.'|'.($mark->classModel?->semester ?? 0)
        ) as $key => $records) {
            $hours = $records->sum('calculated_credit_hours');
            $points = $records->sum('calculated_credit_points');
            $gpaResults[$key] = [
                'credit_hours' => $hours,
                'credit_points' => $points,
                'gpa' => $hours > 0 ? $points / $hours : null,
            ];
        }

        $cgpaResults = [];
        foreach ($bestAttempts->groupBy('student_id') as $studentId => $records) {
            $hours = $records->sum('calculated_credit_hours');
            $points = $records->sum('calculated_credit_points');
            $cgpaResults[$studentId] = [
                'credit_hours' => $hours,
                'credit_points' => $points,
                'cgpa' => $hours > 0 ? $points / $hours : null,
            ];
        }

        $marks = $allMarks->filter(function ($mark) use ($search, $programme, $session, $semester, $classId) {
            if ($search !== '') {
                $fields = [
                    $mark->student?->student_id,
                    $mark->student?->student_name,
                    $mark->subject?->subject_code,
                    $mark->subject?->subject_name,
                ];
                if (!collect($fields)->contains(
                    fn ($value) => str_contains(strtolower((string) $value), strtolower($search))
                )) {
                    return false;
                }
            }

            if ($programme !== '' && $mark->student?->programme !== $programme) {
                return false;
            }
            if ($session !== '' && $mark->academic_session !== $session) {
                return false;
            }
            if ($semester !== '' && (string) $mark->classModel?->semester !== (string) $semester) {
                return false;
            }
            if ($classId !== '' && (string) $mark->class_id !== (string) $classId) {
                return false;
            }

            return true;
        })->values();

        $totalRecords = $marks->count();
        $uniqueStudents = $marks->pluck('student_id')->unique()->count();

        $programmes = Student::query()
            ->whereNotNull('programme')
            ->where('programme', '!=', '')
            ->distinct()
            ->orderBy('programme')
            ->pluck('programme');

        $sessions = $allMarks->pluck('academic_session')->filter()->unique()->sortDesc()->values();
        $classIds = $allMarks->pluck('class_id')->filter()->unique();

        $semesters = ClassModel::whereIn('class_id', $classIds)
            ->whereNotNull('semester')
            ->distinct()
            ->orderBy('semester')
            ->pluck('semester');

        $classes = ClassModel::with('subject')
            ->whereIn('class_id', $classIds)
            ->when($semester !== '', fn ($query) => $query->where('semester', $semester))
            ->orderBy('class_name')
            ->get();

        return view('upp.result-report', compact(
            'marks', 'search', 'programme', 'session', 'semester', 'classId',
            'programmes', 'sessions', 'semesters', 'classes',
            'gpaResults', 'cgpaResults', 'totalRecords', 'uniqueStudents'
        ));
    }

    /**
     * PB eligibility is determined by the subject's original semester.
     * Semester 1-4 always require PB >= 45%; Semester 5 follows its
     * programme-structure setting; Semester 6 uses the F-grade-only rule.
     */
    private function requiresPbEligibility($student, int $subjectSemester): bool
    {
        if ($subjectSemester >= 1 && $subjectSemester <= 4) {
            return true;
        }

        if ($subjectSemester === 5) {
            if (!$student || !$student->structure_id) {
                return true;
            }

            $structure = ProgrammeStructure::find($student->structure_id);
            return $structure ? (bool) $structure->requires_pb_eligibility : true;
        }

        if ($subjectSemester === 6) {
            return false;
        }

        return true;
    }
}
