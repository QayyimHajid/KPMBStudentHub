<?php

namespace App\Http\Controllers;

use App\Models\SubjectRegistration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UppRegistrationReportController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => [
                'nullable',
                Rule::in(['pending', 'approved', 'rejected']),
            ],
        ]);

        $search = trim($validated['search'] ?? '');
        $status = $validated['status'] ?? '';

        // Ringkasan keseluruhan rekod pendaftaran
        $totalRegistrations = SubjectRegistration::count();

        $pendingRegistrations = SubjectRegistration::where(
            'registration_status',
            'pending'
        )->count();

        $approvedRegistrations = SubjectRegistration::where(
            'registration_status',
            'approved'
        )->count();

        $rejectedRegistrations = SubjectRegistration::where(
            'registration_status',
            'rejected'
        )->count();

        // Ambil rekod pendaftaran bersama maklumat berkaitan
        $query = SubjectRegistration::with([
            'student',
            'subject',
            'classModel',
        ]);

        // Carian berdasarkan ID/nama pelajar atau kod/nama subjek
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery
                        ->where('student_id', 'like', "%{$search}%")
                        ->orWhere('student_name', 'like', "%{$search}%");
                })
                ->orWhereHas('subject', function ($subjectQuery) use ($search) {
                    $subjectQuery
                        ->where('subject_code', 'like', "%{$search}%")
                        ->orWhere('subject_name', 'like', "%{$search}%");
                });
            });
        }

        // Filter status hanya mengubah rekod yang dipaparkan
        if ($status !== '') {
            $query->where('registration_status', $status);
        }

        // Tiada pagination: semua rekod yang sepadan dipaparkan
        $registrations = $query
            ->orderByDesc('registration_date')
            ->orderByDesc('registration_id')
            ->get();

        return view('upp.registration-report', compact(
            'registrations',
            'search',
            'status',
            'totalRegistrations',
            'pendingRegistrations',
            'approvedRegistrations',
            'rejectedRegistrations'
        ));
    }
}
