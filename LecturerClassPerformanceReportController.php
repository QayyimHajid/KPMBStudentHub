<?php

namespace App\Http\Controllers;

use App\Models\AssessmentMark;
use App\Models\AssessmentScheme;
use App\Models\ClassModel;
use App\Models\StudentMark;
use App\Models\ProgrammeStructure;


class LecturerClassPerformanceReportController extends Controller
{
    /**
     * Display classes assigned to the logged-in lecturer.
     */
    public function index()
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Lecturer profile not found.');
        }

        $classes = ClassModel::with(['subject', 'classGroup'])
            ->where('lecturer_id', $lecturer->lecturer_id)
            ->orderBy('academic_session')
            ->orderBy('semester')
            ->orderBy('class_name')
            ->get();

        return view(
            'lecturer.performance-report.index',
            compact('classes')
        );
    }

    /**
     * Display the performance report for an assigned class.
     */
    public function show($classId)
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Lecturer profile not found.');
        }

        // Keep the report restricted to classes assigned to this lecturer.
        $class = ClassModel::with(['subject', 'classGroup'])
            ->where('lecturer_id', $lecturer->lecturer_id)
            ->findOrFail($classId);

        $students = $class->subjectRegistrations()
            ->where('registration_status', 'approved')
            ->with('student')
            ->get()
            ->pluck('student')
            ->filter()
            ->unique('student_id')
            ->sortBy('student_name')
            ->values();

        // Use the active scheme for this subject and academic session, if one exists.
        $scheme = AssessmentScheme::with('assessments')
            ->where('subject_id', $class->subject_id)
            ->where('academic_session', $class->academic_session)
            ->where('status', 'active')
            ->first();

    if ($scheme && $scheme->assessments->isNotEmpty()) {
        $assessmentIds = $scheme->assessments->pluck('assessment_id');

        $assessmentMarks = AssessmentMark::whereIn(
            'assessment_id',
            $assessmentIds
        )
            ->where('class_id', $class->class_id)
            ->get()
            ->groupBy('student_id');

        $reportStudents = $students->map(function ($student) use (
            $scheme,
            $assessmentMarks,
            $class
        ) {
            $studentMarks = $assessmentMarks->get(
                $student->student_id,
                collect()
            );

            $pbTotal = 0.0;
            $paTotal = 0.0;
            $pbWeightTotal = 0.0;
            $paWeightTotal = 0.0;
            $hasAllMarks = true;

            foreach ($scheme->assessments as $assessment) {
                $type = strtoupper((string) $assessment->assessment_type);
                $weight = (float) $assessment->weight_percentage;

                if ($type === 'PB') {
                    $pbWeightTotal += $weight;
                } elseif ($type === 'PA') {
                    $paWeightTotal += $weight;
                }

                $record = $studentMarks->first(
                    fn ($item) =>
                        (int) $item->assessment_id ===
                        (int) $assessment->assessment_id
                );

                if (
                    !$record ||
                    $record->marks_obtained === null ||
                    (float) $assessment->max_marks <= 0
                ) {
                    $hasAllMarks = false;
                    continue;
                }

                $weightedMark =
                    ((float) $record->marks_obtained /
                        (float) $assessment->max_marks) * $weight;

                if ($type === 'PB') {
                    $pbTotal += $weightedMark;
                } elseif ($type === 'PA') {
                    $paTotal += $weightedMark;
                }
            }

            $pbTotal = round($pbTotal, 2);
            $paTotal = round($paTotal, 2);
            $pbPerformance = $pbWeightTotal > 0
                ? round(($pbTotal / $pbWeightTotal) * 100, 2)
                : null;
            $paPerformance = $paWeightTotal > 0
                ? round(($paTotal / $paWeightTotal) * 100, 2)
                : null;

            // Cohort eligibility is determined by the student's programme structure intake,
            // not by the student's current semester.
            $requiresPbEligibility = $this->requiresPbEligibility($student, (int) $class->semester);
            $pbEligible = !$requiresPbEligibility ||
                ($pbPerformance !== null && $pbPerformance >= 45);
            $paPassed = $paPerformance !== null && $paPerformance >= 25;

            // Do not show a final result if any component is incomplete.
            $finalMark = $hasAllMarks
                ? round($pbTotal + $paTotal, 2)
                : null;

            $grade = $finalMark !== null ? $this->getGrade($finalMark) : null;
            $coursePassed = $finalMark !== null && $pbEligible && $paPassed;

            // Failing either applicable PB eligibility or PA minimum means failing the course.
            if ($finalMark !== null && !$coursePassed) {
                $grade = [
                    'grade' => 'F',
                    'grade_points' => 0.00,
                    'grade_index' => 'Fail',
                ];
            }

            return [
                'student_id' => $student->student_id,
                'student_name' => $student->student_name,
                'pb_total' => $pbTotal,
                'pa_total' => $paTotal,
                'pb_percentage' => $pbPerformance,
                'pa_percentage' => $paPerformance,
                'pb_eligibility_required' => $requiresPbEligibility,
                'pb_eligible' => $pbEligible,
                'pa_passed' => $paPassed,
                'course_passed' => $coursePassed,
                'marks' => $finalMark,
                'grade' => $grade['grade'] ?? null,
                'grade_points' => $grade['grade_points'] ?? null,
                'grade_index' => $grade['grade_index'] ?? null,
                'has_all_marks' => $hasAllMarks,
            ];
        });
    } else {
        // Keep the existing legacy overall-mark behaviour.
        $marks = StudentMark::where('class_id', $class->class_id)
            ->where('subject_id', $class->subject_id)
            ->where('academic_session', $class->academic_session)
            ->where('lecturer_id', $lecturer->lecturer_id)
            ->get()
            ->keyBy('student_id');

        $reportStudents = $students->map(function ($student) use ($marks) {
            $markRecord = $marks->get($student->student_id);
            $mark = $markRecord ? (float) $markRecord->marks : null;

            $grade = $mark !== null
                ? $this->getGrade($mark)
                : null;

            return [
                'student_id' => $student->student_id,
                'student_name' => $student->student_name,
                'pb_total' => null,
                'pa_total' => null,
                'marks' => $mark,
                'grade' => $grade['grade'] ?? null,
                'grade_points' => $grade['grade_points'] ?? null,
                'grade_index' => $grade['grade_index'] ?? null,
                'has_all_marks' => $mark !== null,
            ];
        });
    }

        $recordedMarks = $reportStudents
            ->whereNotNull('marks')
            ->pluck('marks');

        $totalStudents = $reportStudents->count();
        $recordedCount = $recordedMarks->count();

        $summary = [
            'total_students' => $totalStudents,
            'recorded_count' => $recordedCount,
            'not_recorded_count' => $totalStudents - $recordedCount,
            'average' => $recordedCount > 0
                ? round($recordedMarks->avg(), 2)
                : null,
            'highest' => $recordedCount > 0
                ? $recordedMarks->max()
                : null,
            'lowest' => $recordedCount > 0
                ? $recordedMarks->min()
                : null,
        ];

        $gradeDistribution = $reportStudents
            ->whereNotNull('grade')
            ->groupBy('grade')
            ->map(fn ($group) => $group->count());

        $gradeOrder = [
            'A+', 'A', 'A-', 'B+', 'B', 'B-',
            'C+', 'C', 'C-', 'D+', 'D', 'F',
        ];

        $gradeDistribution = collect($gradeOrder)
            ->mapWithKeys(fn ($grade) => [
                $grade => $gradeDistribution->get($grade, 0),
            ]);

        return view(
            'lecturer.performance-report.show',
            compact(
                'class',
                'reportStudents',
                'summary',
                'gradeDistribution'
            )
        );
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

    /**
     * Convert overall marks into the KPMB grade scale.
     */
    private function getGrade(float $marks): array
    {
        if ($marks >= 90) {
            return [
                'grade' => 'A+',
                'grade_points' => 4.00,
                'grade_index' => 'Excellent',
            ];
        }

        if ($marks >= 80) {
            return [
                'grade' => 'A',
                'grade_points' => 4.00,
                'grade_index' => 'Excellent',
            ];
        }

        if ($marks >= 75) {
            return [
                'grade' => 'A-',
                'grade_points' => 3.67,
                'grade_index' => 'Excellent',
            ];
        }

        if ($marks >= 70) {
            return [
                'grade' => 'B+',
                'grade_points' => 3.33,
                'grade_index' => 'Good',
            ];
        }

        if ($marks >= 65) {
            return [
                'grade' => 'B',
                'grade_points' => 3.00,
                'grade_index' => 'Good',
            ];
        }

        if ($marks >= 60) {
            return [
                'grade' => 'B-',
                'grade_points' => 2.67,
                'grade_index' => 'Good',
            ];
        }

        if ($marks >= 55) {
            return [
                'grade' => 'C+',
                'grade_points' => 2.33,
                'grade_index' => 'Satisfactory',
            ];
        }

        if ($marks >= 50) {
            return [
                'grade' => 'C',
                'grade_points' => 2.00,
                'grade_index' => 'Satisfactory',
            ];
        }

        if ($marks >= 45) {
            return [
                'grade' => 'C-',
                'grade_points' => 1.67,
                'grade_index' => 'Pass',
            ];
        }

        if ($marks >= 40) {
            return [
                'grade' => 'D+',
                'grade_points' => 1.33,
                'grade_index' => 'Fail',
            ];
        }

        if ($marks >= 35) {
            return [
                'grade' => 'D',
                'grade_points' => 1.00,
                'grade_index' => 'Fail',
            ];
        }

        return [
            'grade' => 'F',
            'grade_points' => 0.00,
            'grade_index' => 'Fail',
        ];
    }
}
