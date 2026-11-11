<?php

namespace App\Http\Controllers;

use App\Models\AssessmentMark;
use App\Models\AssessmentScheme;
use App\Models\ClassModel;
use App\Models\ProgrammeStructure;
use App\Models\StudentMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentAcademicResultController extends Controller
{
    public function index(Request $request)
    {
        $student = Auth::user()->student;
        abort_if(!$student, 404, 'Student profile not found.');

        $validated = $request->validate([
            'semester' => ['nullable', 'integer', 'min:1', 'max:6'],
            'session' => ['nullable', 'string', 'max:30'],
        ]);

        $studentId = $student->student_id;
        $gradeScale = [
            ['min' => 90, 'grade' => 'A+', 'point' => 4.00],
            ['min' => 80, 'grade' => 'A', 'point' => 4.00],
            ['min' => 75, 'grade' => 'A-', 'point' => 3.67],
            ['min' => 70, 'grade' => 'B+', 'point' => 3.33],
            ['min' => 65, 'grade' => 'B', 'point' => 3.00],
            ['min' => 60, 'grade' => 'B-', 'point' => 2.67],
            ['min' => 55, 'grade' => 'C+', 'point' => 2.33],
            ['min' => 50, 'grade' => 'C', 'point' => 2.00],
            ['min' => 45, 'grade' => 'C-', 'point' => 1.67],
            ['min' => 40, 'grade' => 'D+', 'point' => 1.33],
            ['min' => 35, 'grade' => 'D', 'point' => 1.00],
            ['min' => 0, 'grade' => 'F', 'point' => 0.00],
        ];

        $legacyMarks = StudentMark::with(['subject', 'classModel'])
            ->where('student_id', $studentId)->get();
        $schemes = AssessmentScheme::with('assessments')
            ->whereHas('assessments.marks', function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->get()
            ->filter(fn ($scheme) => $scheme->assessments->contains(
                fn ($assessment) => strtoupper((string) $assessment->assessment_type) === 'PA'
            ));

        $pbPaClassKeys = collect();
        $pbPaRows = collect();

        foreach ($schemes as $scheme) {
            $classes = ClassModel::with('subject')
                ->where('subject_id', $scheme->subject_id)
                ->where('academic_session', $scheme->academic_session)->get();

            foreach ($classes as $class) {
                $assessments = $scheme->assessments;
                if ($assessments->isEmpty()) continue;

                $assessmentIds = $assessments->pluck('assessment_id');
                $studentMarks = AssessmentMark::whereIn('assessment_id', $assessmentIds)
                    ->where('class_id', $class->class_id)
                    ->where('student_id', $studentId)->get()->keyBy('assessment_id');

                if (!$assessments->every(function ($assessment) use ($studentMarks) {
                    $record = $studentMarks->get($assessment->assessment_id);
                    return $record && $record->marks_obtained !== null;
                })) continue;

                $pbPaClassKeys->push(
                    $class->class_id.'|'.$class->subject_id.'|'.$class->academic_session
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
                    if ($maxMarks <= 0) { $validScheme = false; break; }
                    if ($type === 'PB') $pbWeightTotal += $weight;
                    if ($type === 'PA') $paWeightTotal += $weight;
                    $weighted = ((float) $studentMarks->get($assessment->assessment_id)->marks_obtained / $maxMarks) * $weight;
                    $finalMark += $weighted;
                    if ($type === 'PB') $pbTotal += $weighted;
                    if ($type === 'PA') $paTotal += $weighted;
                }
                if (!$validScheme) continue;

                $pbPerformance = $pbWeightTotal > 0 ? round(($pbTotal / $pbWeightTotal) * 100, 2) : null;
                $paPerformance = $paWeightTotal > 0 ? round(($paTotal / $paWeightTotal) * 100, 2) : null;
                $requiresPb = $this->requiresPbEligibility($student, (int) $class->semester);
                $passed = (!$requiresPb || ($pbPerformance !== null && $pbPerformance >= 45))
                    && $paPerformance !== null && $paPerformance >= 25;

                $row = new StudentMark([
                    'student_id' => $studentId,
                    'subject_id' => $class->subject_id,
                    'class_id' => $class->class_id,
                    'marks' => round($finalMark, 2),
                    'academic_session' => $class->academic_session,
                ]);
                $row->calculated_grade_override = $passed ? null : 'F';
                $row->calculated_point_override = $passed ? null : 0.00;
                $row->setRelation('subject', $class->subject);
                $row->setRelation('classModel', $class);
                $pbPaRows->push($row);
            }
        }

        $legacyMarks = $legacyMarks->reject(function ($mark) use ($pbPaClassKeys) {
            return $pbPaClassKeys->contains($mark->class_id.'|'.$mark->subject_id.'|'.$mark->academic_session);
        });
        $allMarks = $legacyMarks->concat($pbPaRows)->values();

        foreach ($allMarks as $mark) {
            foreach ($gradeScale as $grade) {
                if ((float) $mark->marks >= $grade['min']) {
                    $mark->calculated_grade = $grade['grade'];
                    $mark->calculated_grade_point = $grade['point'];
                    break;
                }
            }
            if (($mark->calculated_grade_override ?? null) === 'F') {
                $mark->calculated_grade = 'F';
                $mark->calculated_grade_point = 0.00;
            }
            $mark->calculated_credit_hours = (float) ($mark->subject?->credit_hour ?? 0);
            $mark->calculated_credit_points = (float) $mark->calculated_grade_point * $mark->calculated_credit_hours;
            $mark->semester = (int) ($mark->classModel?->semester ?? 0);
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
            ->groupBy('subject_id')
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
                $latest->calculated_credit_hours = $best->calculated_credit_hours;
                $latest->calculated_credit_points =
                    $best->calculated_grade_point * $latest->calculated_credit_hours;

                return $latest;
            })
            ->values();

        $selectedSemester = $validated['semester'] ?? '';
        $selectedSession = $validated['session'] ?? '';
        $sessions = $allMarks->pluck('academic_session')->filter()->unique()->sortDesc()->values();
        $semesters = $allMarks->pluck('semester')->filter()->unique()->sort()->values();

        $cgpaHours = $bestAttempts->sum('calculated_credit_hours');
        $cgpaPoints = $bestAttempts->sum('calculated_credit_points');
        $cgpa = $cgpaHours > 0 ? $cgpaPoints / $cgpaHours : null;

        $filteredMarks = $allMarks->filter(function ($mark) use ($selectedSemester, $selectedSession) {
            return ($selectedSemester === '' || (string) $mark->semester === (string) $selectedSemester)
                && ($selectedSession === '' || $mark->academic_session === $selectedSession);
        })->sortBy(fn ($mark) => $mark->subject?->subject_code)->values();

        // GPA uses the highest attempt for each subject.
        $gpaAttempts = $bestAttempts->filter(function ($mark) use (
            $selectedSemester,
            $selectedSession
        ) {
            return ($selectedSemester === '' ||
                    (string) $mark->semester === (string) $selectedSemester)
                && ($selectedSession === '' ||
                    $mark->academic_session === $selectedSession);
        });

        $gpaHours = ($selectedSemester !== '' && $selectedSession !== '')
            ? $gpaAttempts->sum('calculated_credit_hours') : 0;

        $gpaPoints = ($selectedSemester !== '' && $selectedSession !== '')
            ? $gpaAttempts->sum('calculated_credit_points') : 0;

        $gpa = $gpaHours > 0 ? $gpaPoints / $gpaHours : null;

        return view('student.academic-results', compact(
            'student', 'filteredMarks', 'sessions', 'semesters', 'selectedSemester',
            'selectedSession', 'gpa', 'cgpa', 'gpaHours', 'cgpaHours'
        ));
    }

    private function requiresPbEligibility($student, int $subjectSemester): bool
    {
        if ($subjectSemester >= 1 && $subjectSemester <= 4) return true;
        if ($subjectSemester === 5) {
            if (!$student->structure_id) return true;
            $structure = ProgrammeStructure::find($student->structure_id);
            return $structure ? (bool) $structure->requires_pb_eligibility : true;
        }
        if ($subjectSemester === 6) return false;
        return true;
    }
}
