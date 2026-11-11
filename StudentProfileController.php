<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentProfileController extends Controller
{
    public function show()
{
    $student = Auth::user()->student;

    abort_if(!$student, 404, 'Student profile not found.');

    // Retrieve approved subject registrations for the current semester.
    $registeredSubjects = $student->subjectRegistrations()
        ->with(['subject', 'classModel'])
        ->where('registration_status', 'approved')
        ->when(
            $student->semester,
            fn ($query) => $query->where('semester', $student->semester)
        )
        ->orderBy('semester')
        ->orderBy('registration_id')
        ->get();

    // Retrieve the student's active mentor assignment.
    $mentorAssignment = $student->currentMentorAssignment()
        ->with('lecturerDirectory')
        ->first();

    return view('student.profile', compact(
        'student',
        'registeredSubjects',
        'mentorAssignment'
    ));
}

    public function printDetails()
    {
        $student = Auth::user()->student;

        abort_if(!$student, 404, 'Student profile not found.');

        return view('student.profile-print', compact('student'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $student = $user->student;

        abort_if(!$student, 404, 'Student profile not found.');

        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:100'],

            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->id),
                Rule::unique('students', 'email')
                    ->ignore($student->student_id, 'student_id'),
            ],

            'phone_number' => ['nullable', 'string', 'max:20'],
            'home_address' => ['nullable', 'string', 'max:2000'],

            'guardian_name' => ['nullable', 'string', 'max:100'],
            'guardian_relationship' => ['nullable', 'string', 'max:50'],
            'guardian_phone' => ['nullable', 'string', 'max:20'],
            'guardian_occupation' => ['nullable', 'string', 'max:100'],
            'guardian_employer' => ['nullable', 'string', 'max:150'],
        ]);

        DB::transaction(function () use ($user, $student, $validated) {
            $student->update($validated);

            $user->update([
                'name' => $validated['student_name'],
                'email' => $validated['email'],
            ]);
        });

        return redirect()
            ->route('student.profile')
            ->with('success', 'Profile updated successfully.');
    }
}