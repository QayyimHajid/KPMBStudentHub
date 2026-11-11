<?php

namespace App\Http\Controllers;

use App\Models\SubjectRegistrationApplication;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UppSubjectRegistrationController extends Controller
{
    /**
     * UPP monitors each application as one record. Approval/rejection remains
     * the responsibility of the student's mentor.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::in(['pending', 'approved', 'rejected'])],
            'programme' => ['nullable', 'string', 'max:100'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:20'],
        ]);

        $search = trim($validated['search'] ?? '');
        $status = $validated['status'] ?? '';
        $programme = $validated['programme'] ?? '';
        $semester = $validated['semester'] ?? '';

        $baseQuery = SubjectRegistrationApplication::query()
            ->whereHas('registrations');

        $totalApplications = (clone $baseQuery)->count();
        $pendingApplications = (clone $baseQuery)->where('application_status', 'pending')->count();
        $approvedApplications = (clone $baseQuery)->where('application_status', 'approved')->count();
        $rejectedApplications = (clone $baseQuery)->where('application_status', 'rejected')->count();

        $query = SubjectRegistrationApplication::with([
            'student',
            'registrations.subject',
            'registrations.classModel',
        ])->whereHas('registrations');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery->where('student_id', 'like', "%{$search}%")
                        ->orWhere('student_name', 'like', "%{$search}%");
                })->orWhereHas('registrations.subject', function ($subjectQuery) use ($search) {
                    $subjectQuery->where('subject_code', 'like', "%{$search}%")
                        ->orWhere('subject_name', 'like', "%{$search}%");
                });
            });
        }

        if ($status !== '') {
            $query->where('application_status', $status);
        }

        if ($programme !== '') {
            $query->whereHas('student', function ($studentQuery) use ($programme) {
                $studentQuery->where('programme', $programme);
            });
        }

        if ($semester !== '') {
            $query->where('semester', (int) $semester);
        }

        $applications = $query
            ->orderByRaw("CASE WHEN application_status = 'pending' THEN 0 ELSE 1 END")
            ->orderByDesc('submitted_at')
            ->orderByDesc('application_id')
            ->paginate(10)
            ->withQueryString();

        $programmeOptions = DB::table('students')
            ->whereNotNull('programme')
            ->where('programme', '!=', '')
            ->distinct()
            ->orderBy('programme')
            ->pluck('programme');

        $semesterOptions = SubjectRegistrationApplication::query()
            ->whereHas('registrations')
            ->select('semester')
            ->distinct()
            ->orderBy('semester')
            ->pluck('semester');

        return view('upp.subject-registrations', compact(
            'applications',
            'search',
            'status',
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'rejectedApplications',
            'programme',
            'semester',
            'programmeOptions',
            'semesterOptions'
        ));
    }

    /**
     * Read-only application details for UPP.
     */
    public function show($applicationId)
    {
        $application = SubjectRegistrationApplication::with([
            'student',
            'registrations.subject',
            'registrations.classModel',
        ])->whereHas('registrations')->findOrFail($applicationId);

        return view('upp.subject-registration-details', compact('application'));
    }
}
