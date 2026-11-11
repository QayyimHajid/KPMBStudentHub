<?php

namespace App\Http\Controllers;

use App\Models\RepeatSubjectApplication;
use App\Models\SubjectRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UppRepeatSubjectApplicationController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:pending,approved,rejected'],
        ]);

        $search = trim($validated['search'] ?? '');
        $status = $validated['status'] ?? 'pending';

        $baseQuery = RepeatSubjectApplication::query();

        $query = RepeatSubjectApplication::with([
            'student',
            'subject',
            'classModel',
            'reviewer',
        ]);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('student_id', 'like', "%{$search}%")
                    ->orWhereHas('student', function ($studentQuery) use ($search) {
                        $studentQuery->where('student_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('subject', function ($subjectQuery) use ($search) {
                        $subjectQuery->where('subject_code', 'like', "%{$search}%")
                            ->orWhere('subject_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('classModel', function ($classQuery) use ($search) {
                        $classQuery->where('class_name', 'like', "%{$search}%");
                    });
            });
        }

        if ($status !== '') {
            $query->where('application_status', $status);
        }

        $applications = $query
            ->orderByRaw("CASE WHEN application_status = 'pending' THEN 0 ELSE 1 END")
            ->orderByDesc('submitted_at')
            ->orderByDesc('repeat_application_id')
            ->paginate(10)
            ->withQueryString();

        $counts = [
            'pending' => (clone $baseQuery)->where('application_status', 'pending')->count(),
            'approved' => (clone $baseQuery)->where('application_status', 'approved')->count(),
            'rejected' => (clone $baseQuery)->where('application_status', 'rejected')->count(),
        ];

        return view('upp.repeat-subject-applications', compact(
            'applications',
            'search',
            'status',
            'counts'
        ));
    }

    public function approve(Request $request, int $applicationId)
    {
        $validated = $request->validate([
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($applicationId, $validated) {
            $application = RepeatSubjectApplication::query()
                ->with(['classModel.classGroup', 'student', 'subject'])
                ->whereKey($applicationId)
                ->lockForUpdate()
                ->firstOrFail();

            if ($application->application_status !== 'pending') {
                throw ValidationException::withMessages([
                    'application' => 'Permohonan ini telah diproses sebelum ini.',
                ]);
            }

            if (!$application->student || !$application->subject || !$application->classModel) {
                throw ValidationException::withMessages([
                    'application' => 'Maklumat pelajar, subjek atau kelas tidak lengkap. Permohonan tidak boleh diluluskan.',
                ]);
            }
            
            $class = $application->classModel;
            $classGroup = $class->classGroup;

            if (
                $class->class_type !== 'repeat'
                || !$classGroup
                || (int) $class->subject_id !== (int) $application->subject_id
                || (int) $class->structure_id !== (int) $application->structure_id
                || (int) $class->semester !== (int) $application->subject_semester
                || (int) $classGroup->semester !== (int) $application->subject_semester
                || $class->academic_session !== $application->academic_session
            ) {
                throw ValidationException::withMessages([
                    'application' => 'Maklumat kelas tidak sepadan dengan permohonan repeat subject ini.',
                ]);
            }

            $registration = SubjectRegistration::query()
                ->where('repeat_application_id', $application->repeat_application_id)
                ->lockForUpdate()
                ->first();

            if ($registration) {
                if (
                    $registration->registration_type !== 'repeat'
                    || (int) $registration->student_id !== (int) $application->student_id
                    || (int) $registration->subject_id !== (int) $application->subject_id
                    || (int) $registration->class_id !== (int) $application->class_id
                ) {
                    throw ValidationException::withMessages([
                        'application' => 'Rekod pendaftaran repeat tidak sepadan dengan permohonan.',
                    ]);
                }

                $registration->update([
                    'registration_status' => 'approved',
                ]);
            } else {
                SubjectRegistration::create([
                    'registration_type' => 'repeat',
                    'application_id' => null,
                    'repeat_application_id' => $application->repeat_application_id,
                    'student_id' => $application->student_id,
                    'subject_id' => $application->subject_id,
                    'class_id' => $application->class_id,
                    'semester' => $application->student_current_semester,
                    'registration_date' => now()->toDateString(),
                    'registration_status' => 'approved',
                ]);
            }

            $application->update([
                'application_status' => 'approved',
                'reviewed_by' => auth()->id(),
                'remarks' => $validated['remarks'] ?? null,
                'reviewed_at' => now(),
            ]);
        });

        return redirect()
            ->route('upp.repeat-subject-applications.index', ['status' => 'pending'])
            ->with('success', 'Permohonan repeat subject berjaya diluluskan dan rekod pendaftaran repeat telah disimpan.');
    }

    public function reject(Request $request, int $applicationId)
    {
        $validated = $request->validate([
            'remarks' => ['required', 'string', 'max:1000'],
        ], [
            'remarks.required' => 'Sila masukkan sebab penolakan permohonan.',
        ]);

        DB::transaction(function () use ($applicationId, $validated) {
            $application = RepeatSubjectApplication::query()
                ->whereKey($applicationId)
                ->lockForUpdate()
                ->firstOrFail();

            if ($application->application_status !== 'pending') {
                throw ValidationException::withMessages([
                    'application' => 'Permohonan ini telah diproses sebelum ini.',
                ]);
            }

            $existingRegistration = SubjectRegistration::query()
                ->where('repeat_application_id', $application->repeat_application_id)
                ->exists();

            if ($existingRegistration) {
                throw ValidationException::withMessages([
                    'application' => 'Rekod pendaftaran repeat telah wujud. Permohonan ini tidak boleh ditolak.',
                ]);
            }

            $application->update([
                'application_status' => 'rejected',
                'reviewed_by' => auth()->id(),
                'remarks' => $validated['remarks'],
                'reviewed_at' => now(),
            ]);
        });

        return redirect()
            ->route('upp.repeat-subject-applications.index', ['status' => 'pending'])
            ->with('success', 'Permohonan repeat subject telah ditolak.');
    }
}
