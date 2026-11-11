<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'identifier' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string'],
            'selected_role' => [
                'required',
                'in:student,lecturer,upp',
            ],
        ]);

        $identifier = $validated['identifier'];
        $role = $validated['selected_role'];

        $userQuery = User::query()
            ->where('role', $role)
            ->where('status', 'active');

        if ($role === 'student') {
            $userQuery->whereHas('student', function ($query) use ($identifier) {
                $query->where('student_id', $identifier);
            });
        } elseif ($role === 'lecturer') {
            $userQuery->whereHas('lecturer', function ($query) use ($identifier) {
                $query->where('lecturer_id', $identifier);
            });
        } else {
            $userQuery->where('username', $identifier);
        }

        $user = $userQuery->first();

        if (
            !$user ||
            !Auth::attempt([
                'id' => $user->id,
                'password' => $validated['password'],
                'status' => 'active',
                'role' => $role,
            ])
        ) {
            throw ValidationException::withMessages([
                'identifier' => 'ID, kata laluan atau kategori pengguna tidak sah. Pastikan akaun anda aktif.',
            ]);
        }

        $request->session()->regenerate();

        return match ($role) {
            'student' => redirect()->route('student.dashboard'),
            'lecturer' => redirect()->route('lecturer.dashboard'),
            'upp' => redirect()->route('upp.dashboard'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
