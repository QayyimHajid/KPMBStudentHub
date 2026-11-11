<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentRoster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SignUpController extends Controller
{
    public function show()
    {
        return view('auth.signup');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'Emel ini sudah mempunyai akaun. Sila log masuk.',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan.',
            'password.min' => 'Kata laluan mestilah sekurang-kurangnya 8 aksara.',
        ]);

        $studentId = strtoupper(trim($validated['student_id']));
        $roster = StudentRoster::where('student_id', $studentId)->first();

        if (!$roster) {
            throw ValidationException::withMessages([
                'student_id' => 'Nombor ID anda tidak terdapat dalam rekod KPMB. Sila pastikan nombor ID anda betul atau hubungi pihak pengurusan KPMB untuk bantuan.',
            ]);
        }

        // Require the entered name to match the test roster; official academic details
        // are copied from the roster rather than accepted from user input.
        if (mb_strtolower(trim($validated['name'])) !== mb_strtolower(trim($roster->student_name))) {
            throw ValidationException::withMessages([
                'name' => 'Nama tidak sepadan dengan rekod pelajar. Sila semak nama yang dimasukkan.',
            ]);
        }

        if (Student::where('student_id', $studentId)->exists()) {
            throw ValidationException::withMessages([
                'student_id' => 'ID pelajar ini sudah mempunyai akaun. Sila log masuk.',
            ]);
        }

        DB::transaction(function () use ($validated, $studentId, $roster) {
            $user = User::create([
                'username' => $studentId,
                'name' => $roster->student_name,
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => 'student',
                'status' => 'active',
            ]);

            Student::create([
                'student_id' => $studentId,
                'user_id' => $user->id,
                'student_name' => $roster->student_name,
                'programme' => $roster->programme,
                'semester' => $roster->semester,
                'email' => $validated['email'],
            ]);
        });

        return redirect()->route('login')->with(
            'success',
            'Akaun berjaya didaftarkan. Sila log masuk menggunakan ID pelajar dan kata laluan anda.'
        );
    }
}
