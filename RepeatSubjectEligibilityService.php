<?php

namespace App\Services;

use App\Models\AcademicResult;
use App\Models\Assessment;
use App\Models\AssessmentMark;
use App\Models\AssessmentScheme;
use App\Models\ClassModel;
use App\Models\ProgrammeStructure;
use App\Models\Student;
use App\Models\SubjectRegistration;

class RepeatSubjectEligibilityService
{
    /**
     * Return an eligibility decision based on the student's actual result
     * for the subject in its original programme-structure semester.
     *
     * Missing/incomplete PB evidence is never treated as a PB failure.
     */
    public function evaluate(
        Student $student,
        int $subjectId,
        int $subjectSemester,
        ?string $academicSession = null
    ): array {
        $resultQuery = AcademicResult::query()
            ->where('student_id', $student->student_id)
            ->where('subject_id', $subjectId)
            ->where('semester', $subjectSemester);

        if ($academicSession) {
            $resultQuery->where('academic_session', $academicSession);
        }

        $result = $resultQuery
            ->orderByDesc('created_at')
            ->orderByDesc('result_id')
            ->first();

        if (!$result) {
            return $this->denied('no_academic_result');
        }

        $grade = strtoupper(trim((string) $result->grade));
        $requiresPb = $this->requiresPbForSemester($student, $subjectSemester);

        // F is always a repeat basis, irrespective of PB configuration.
        if ($grade === 'F') {
            return [
                'eligible' => true,
                'basis' => 'grade_f',
                'grade' => $grade,
                'pb_percentage' => null,
                'result' => $result,
                'message' => 'Layak mengulang kerana memperoleh gred F.',
            ];
        }

        if (!$requiresPb) {
            return $this->denied(
                'grade_not_f',
                $grade,
                null,
                $result,
                'Tidak layak: struktur pengajian ini menetapkan gred F sahaja sebagai syarat repeat.'
            );
        }

        $pb = $this->calculatePbPercentage(
            $student->student_id,
            $subjectId,
            $subjectSemester,
            (string) $result->academic_session
        );

        if (!$pb['complete']) {
            return $this->denied(
                'pb_data_incomplete',
                $grade,
                null,
                $result,
                'Rekod PB belum lengkap untuk menentukan kelayakan repeat. Sila hubungi pihak akademik.'
            );
        }

        if ($pb['percentage'] < 45) {
            return [
                'eligible' => true,
                'basis' => 'pb_below_45',
                'grade' => $grade,
                'pb_percentage' => $pb['percentage'],
                'result' => $result,
                'message' => 'Layak mengulang kerana markah PB kurang daripada 45%.',
            ];
        }

        return $this->denied(
            'not_failed',
            $grade,
            $pb['percentage'],
            $result,
            'Tidak layak mengulang: gred bukan F dan markah PB mencapai sekurang-kurangnya 45%.'
        );
    }

    public function requiresPbForSemester(Student $student, int $subjectSemester): bool
    {
        if ($subjectSemester >= 1 && $subjectSemester <= 4) {
            return true;
        }

        if ($subjectSemester === 5) {
            if (!$student->structure_id) {
                return true;
            }

            $structure = ProgrammeStructure::find($student->structure_id);

            // Fail-safe: an unknown structure retains the PB requirement.
            return $structure ? (bool) $structure->requires_pb_eligibility : true;
        }

        // Semester 6 Diploma rule: F grade only.
        if ($subjectSemester === 6) {
            return false;
        }

        return true;
    }

    private function calculatePbPercentage(
        string $studentId,
        int $subjectId,
        int $semester,
        string $academicSession
    ): array {
        $scheme = AssessmentScheme::with('assessments')
            ->where('subject_id', $subjectId)
            ->where('academic_session', $academicSession)
            ->first();

        if (!$scheme) {
            return ['complete' => false, 'percentage' => null];
        }

        $pbAssessments = $scheme->assessments
            ->filter(fn ($assessment) =>
                strtoupper((string) $assessment->assessment_type) === 'PB'
            )
            ->values();

        if ($pbAssessments->isEmpty()) {
            return ['complete' => false, 'percentage' => null];
        }

        // Find the student's approved registration for this attempt.
        $registrations = SubjectRegistration::with('classModel')
            ->where('student_id', $studentId)
            ->where('subject_id', $subjectId)
            ->where('registration_status', 'approved')
            ->whereHas('classModel', function ($query) use (
                $semester,
                $academicSession
            ) {
                $query->where('semester', $semester)
                    ->where('academic_session', $academicSession);
            })
            ->get()
            ->filter(fn ($registration) => $registration->classModel !== null)
            ->unique('class_id')
            ->values();

        // Do not guess if the student's original class is ambiguous.
        if ($registrations->count() !== 1) {
            return ['complete' => false, 'percentage' => null];
        }

        $classId = $registrations->first()->class_id;

        $marks = AssessmentMark::query()
            ->where('student_id', $studentId)
            ->where('class_id', $classId)
            ->whereIn('assessment_id', $pbAssessments->pluck('assessment_id'))
            ->get()
            ->keyBy('assessment_id');

        $complete = $pbAssessments->every(function ($assessment) use ($marks) {
            $mark = $marks->get($assessment->assessment_id);

            return $mark
                && $mark->marks_obtained !== null
                && (float) $assessment->max_marks > 0;
        });

        if (!$complete) {
            return ['complete' => false, 'percentage' => null];
        }

        $weightedTotal = 0.0;
        $weightTotal = 0.0;

        foreach ($pbAssessments as $assessment) {
            $mark = $marks->get($assessment->assessment_id);
            $weight = (float) $assessment->weight_percentage;

            $weightedTotal += (
                (float) $mark->marks_obtained /
                (float) $assessment->max_marks
            ) * $weight;

            $weightTotal += $weight;
        }

        if ($weightTotal <= 0) {
            return ['complete' => false, 'percentage' => null];
        }

        return [
            'complete' => true,
            'percentage' => round(
                ($weightedTotal / $weightTotal) * 100,
                2
            ),
        ];
    }

    private function denied(
        string $basis,
        ?string $grade = null,
        ?float $pb = null,
        ?AcademicResult $result = null,
        ?string $message = null
    ): array {
        return [
            'eligible' => false,
            'basis' => $basis,
            'grade' => $grade,
            'pb_percentage' => $pb,
            'result' => $result,
            'message' => $message ?? 'Tiada rekod kegagalan yang melayakkan anda mengulang subjek ini.',
        ];
    }
}
