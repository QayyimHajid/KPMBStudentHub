<?php

namespace App\Http\Controllers;

use App\Models\LecturerDirectory;
use Illuminate\Http\Request;

class LecturerDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->query('search', ''));
        $department = strtoupper(trim($request->query('department', '')));

        $validDepartments = ['DIA', 'DSC', 'DLH', 'DBS', 'GSD'];
        if (! in_array($department, $validDepartments, true)) {
            $department = '';
        }

        $lecturers = LecturerDirectory::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('lecturer_name', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($department !== '', fn ($query) => $query->where('department_code', $department))
            ->orderBy('department_code')
            ->orderByRaw("CASE WHEN position = 'Ketua Jabatan' THEN 0 ELSE 1 END")
            ->orderBy('lecturer_name')
            ->get();

        return view('lecturer.index', compact('lecturers', 'search', 'department'));
    }
}
