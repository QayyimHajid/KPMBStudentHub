<?php

namespace App\Http\Controllers;

use App\Models\AssessmentMark;
use App\Models\AssessmentScheme;
use App\Models\ClassModel;
use App\Models\StudentMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LecturerRecordStudentMarksController extends Controller
{
    public function index()
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Lecturer profile not found.');
        }

        $classes = ClassModel::with('subject')
            ->where('lecturer_id', $lecturer->lecturer_id)
            ->orderBy('academic_session')
            ->orderBy('semester')
            ->orderBy('class_name')
            ->get();

        return view('lecturer.record-marks.index', compact('classes'));
    }

    public function show($classId)
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Lecturer profile not found.');
        }

        $class = ClassModel::with('subject')
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

        $scheme = AssessmentScheme::with([
                'assessments' => fn ($query) => $query->orderBy('sort_order'),
            ])
            ->where('subject_id', $class->subject_id)
            ->where('academic_session', $class->academic_session)
            ->where('status', 'active')
            ->first();

        $assessmentMarks = collect();

        if ($scheme) {
            $assessmentIds = $scheme->assessments->pluck('assessment_id');

            $assessmentMarks = AssessmentMark::whereIn('assessment_id', $assessmentIds)
                ->where('class_id', $class->class_id)
                ->get()
                ->groupBy('assessment_id')
                ->map(fn ($rows) => $rows->keyBy('student_id'));
        }

        // Keep legacy overall marks available to existing code/features while assessment entry is introduced.
        $legacyMarks = StudentMark::where('class_id', $class->class_id)
            ->where('subject_id', $class->subject_id)
            ->where('academic_session', $class->academic_session)
            ->where('lecturer_id', $lecturer->lecturer_id)
            ->get()
            ->keyBy('student_id');

        return view(
            'lecturer.record-marks.show',
            compact('class', 'students', 'scheme', 'assessmentMarks', 'legacyMarks')
        );
    }

    public function store(Request $request, $classId)
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Lecturer profile not found.');
        }

        $class = ClassModel::where('lecturer_id', $lecturer->lecturer_id)
            ->findOrFail($classId);

        /*
         * Backward compatibility:
         * Existing feature tests and older forms submit marks[student_id] = overall_mark.
         * The new assessment form submits marks[assessment_id][student_id] = component_mark.
         * Support both payload formats while the application transitions to assessment schemes.
         */
        $submittedMarks = $request->input('marks');

        if (!is_array($submittedMarks) || count($submittedMarks) === 0) {
            throw ValidationException::withMessages([
                'marks' => 'Please enter at least one mark.',
            ]);
        }

        $isAssessmentPayload = collect($submittedMarks)->contains(
            fn ($value) => is_array($value)
        );

        $eligibleStudentIds = $class->subjectRegistrations()
            ->where('registration_status', 'approved')
            ->pluck('student_id')
            ->map(fn ($id) => (string) $id)
            ->unique()
            ->values()
            ->all();

        if (!$isAssessmentPayload) {
            // Legacy overall-mark path retained for existing behaviour and tests.
            $validated = $request->validate([
                'marks' => ['required', 'array', 'min:1'],
                'marks.*' => ['required', 'numeric', 'min:0', 'max:100'],
            ]);

            foreach (array_keys($validated['marks']) as $studentId) {
                if (!in_array((string) $studentId, $eligibleStudentIds, true)) {
                    throw ValidationException::withMessages([
                        'marks' => 'One or more students are not registered in this class.',
                    ]);
                }
            }

            DB::transaction(function () use ($validated, $class, $lecturer) {
                foreach ($validated['marks'] as $studentId => $mark) {
                    StudentMark::updateOrCreate(
                        [
                            'student_id' => $studentId,
                            'subject_id' => $class->subject_id,
                            'class_id' => $class->class_id,
                            'academic_session' => $class->academic_session,
                        ],
                        [
                            'lecturer_id' => $lecturer->lecturer_id,
                            'marks' => $mark,
                        ]
                    );
                }
            });

            return back()->with('success', 'Student marks saved successfully.');
        }

        // New assessment-component path.
        $scheme = AssessmentScheme::with('assessments')
            ->where('subject_id', $class->subject_id)
            ->where('academic_session', $class->academic_session)
            ->where('status', 'active')
            ->first();

        if (!$scheme || $scheme->assessments->isEmpty()) {
            return back()->withErrors([
                'assessment' => 'There is no active assessment scheme for this subject and academic session. Please contact UPP.',
            ]);
        }

        $validated = $request->validate([
            'marks' => ['required', 'array', 'min:1'],
            'marks.*' => ['array'],
            'marks.*.*' => ['nullable', 'numeric', 'min:0'],
        ]);

        $assessmentsById = $scheme->assessments->keyBy(
            fn ($assessment) => (string) $assessment->assessment_id
        );

        foreach ($validated['marks'] as $assessmentId => $studentMarks) {
            $assessment = $assessmentsById->get((string) $assessmentId);

            if (!$assessment) {
                throw ValidationException::withMessages([
                    'marks' => 'The submitted assessment does not belong to the active scheme.',
                ]);
            }

            foreach ($studentMarks as $studentId => $mark) {
                if (!in_array((string) $studentId, $eligibleStudentIds, true)) {
                    throw ValidationException::withMessages([
                        'marks' => 'One or more students are not registered in this class.',
                    ]);
                }

                if ($mark !== null && $mark !== '' && (float) $mark > (float) $assessment->max_marks) {
                    throw ValidationException::withMessages([
                        "marks.$assessmentId.$studentId" =>
                            "The mark for {$assessment->assessment_name} cannot exceed {$assessment->max_marks}.",
                    ]);
                }
            }
        }

        DB::transaction(function () use (
            $validated,
            $class,
            $lecturer,
            $eligibleStudentIds
        ) {
            foreach ($validated['marks'] as $assessmentId => $studentMarks) {
                foreach ($studentMarks as $studentId => $mark) {
                    if (!in_array((string) $studentId, $eligibleStudentIds, true)) {
                        continue;
                    }

                    // A blank input means "not recorded"; it must not erase an existing mark.
                    if ($mark === null || $mark === '') {
                        continue;
                    }

                    AssessmentMark::updateOrCreate(
                        [
                            'assessment_id' => $assessmentId,
                            'student_id' => $studentId,
                            'class_id' => $class->class_id,
                        ],
                        [
                            'marks_obtained' => $mark,
                            'recorded_by' => $lecturer->lecturer_id,
                        ]
                    );
                }
            }
        });

        return back()->with('success', 'Assessment marks saved successfully.');
    }
}
