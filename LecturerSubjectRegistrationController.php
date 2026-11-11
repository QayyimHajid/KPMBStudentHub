<?php

namespace App\Http\Controllers;

use App\Models\SubjectRegistration;
use App\Models\SubjectRegistrationApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LecturerSubjectRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Profil Lecturer tidak ditemui.');
        }

        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => [
                'nullable',
                Rule::in(['pending', 'approved', 'rejected']),
            ],
        ]);

        $search = trim($validated['search'] ?? '');
        $status = $validated['status'] ?? '';

        // Dapatkan ID mentee yang mempunyai assignment aktif.
        $menteeIds = $lecturer->mentorAssignments()
            ->whereNull('ended_at')
            ->select('student_id');

        // Satu rekod senarai mewakili satu application, bukan satu subject row.
        $query = SubjectRegistrationApplication::with([
            'student',
            'registrations.subject',
            'registrations.classModel.classGroup',
        ])->whereIn('student_id', $menteeIds)
            ->whereHas('registrations');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery
                        ->where('student_id', 'like', "%{$search}%")
                        ->orWhere('student_name', 'like', "%{$search}%");
                })->orWhereHas('registrations.subject', function ($subjectQuery) use ($search) {
                    $subjectQuery
                        ->where('subject_code', 'like', "%{$search}%")
                        ->orWhere('subject_name', 'like', "%{$search}%");
                });
            });
        }

        if ($status !== '') {
            $query->where('application_status', $status);
        }

        $registrations = $query
            ->orderByRaw("
                CASE
                    WHEN application_status = 'pending' THEN 0
                    ELSE 1
                END
            ")
            ->orderByDesc('submitted_at')
            ->orderByDesc('application_id')
            ->paginate(10)
            ->withQueryString();

        return view(
            'lecturer.subject-registrations',
            compact('registrations', 'search', 'status')
        );
    }

    public function show($applicationId)
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Profil Lecturer tidak ditemui.');
        }

        $menteeIds = $lecturer->mentorAssignments()
            ->whereNull('ended_at')
            ->select('student_id');

        $application = SubjectRegistrationApplication::with([
            'student',
            'registrations.subject',
            'registrations.classModel',
        ])
            ->whereIn('student_id', $menteeIds)
            ->whereHas('registrations')
            ->findOrFail($applicationId);

        return view('lecturer.subject-registration-details', compact('application'));
    }

    public function updateStatus(Request $request, $applicationId)
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Profil Lecturer tidak ditemui.');
        }

        $validated = $request->validate([
            'application_status' => [
                'required',
                Rule::in(['approved', 'rejected']),
            ],
            'remarks' => [
                'nullable',
                'string',
                'max:2000',
                Rule::requiredIf($request->input('application_status') === 'rejected'),
            ],
        ], [
            'remarks.required' => 'Sila nyatakan sebab penolakan permohonan.',
        ]);

        $menteeIds = $lecturer->mentorAssignments()
            ->whereNull('ended_at')
            ->select('student_id');

        $application = SubjectRegistrationApplication::whereIn('student_id', $menteeIds)
            ->with('registrations')
            ->findOrFail($applicationId);

        if ($application->application_status !== 'pending') {
            return back()->with('error', 'Permohonan ini telah diproses sebelum ini.');
        }

        if ($application->registrations->isEmpty()) {
            return back()->with('error', 'Permohonan ini tidak mempunyai rekod subjek untuk diproses.');
        }

        DB::transaction(function () use ($application, $validated, $lecturer) {
            $application->update([
                'application_status' => $validated['application_status'],
                'reviewed_by' => $lecturer->lecturer_id,
                'reviewed_at' => now(),
                'remarks' => $validated['remarks'] ?? null,
            ]);

            $application->registrations()->update([
                'registration_status' => $validated['application_status'],
            ]);
        });

        return redirect()
            ->route('lecturer.subject-registrations.show', $application->application_id)
            ->with(
                'success',
                $validated['application_status'] === 'approved'
                    ? 'Permohonan pendaftaran subjek berjaya diluluskan.'
                    : 'Permohonan pendaftaran subjek telah ditolak.'
            );
    }

}