<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\Student;
use Illuminate\Http\Request;

class LecturerStudentRecordController extends Controller
{
    /**
     * Lecturers may view every student record, regardless of programme,
     * semester, class group or mentor assignment.
     */
    public function index(Request $request)
    {
        abort_unless(auth()->user()?->lecturer, 403, 'Lecturer profile not found.');

        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'programme' => ['nullable', 'string', 'max:150'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:20'],
            'group_id' => ['nullable', 'integer', 'exists:class_groups,group_id'],
        ]);

        $search = trim($validated['search'] ?? '');

        $studentQuery = Student::query()
            ->with(['user', 'classGroup'])
            ->withCount(['subjectRegistrations', 'studentMarks']);

        if ($search !== '') {
            $studentQuery->where(function ($query) use ($search) {
                $query->where('student_id', 'like', "%{$search}%")
                    ->orWhere('student_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if (!empty($validated['programme'])) {
            $studentQuery->where('programme', $validated['programme']);
        }

        if (!empty($validated['semester'])) {
            $studentQuery->where('semester', (int) $validated['semester']);
        }

        if (!empty($validated['group_id'])) {
            $studentQuery->where('group_id', (int) $validated['group_id']);
        }

        $students = $studentQuery
            ->orderBy('student_name')
            ->paginate(12)
            ->withQueryString();

        $totalStudents = Student::count();
        $programmes = Student::query()
            ->whereNotNull('programme')
            ->where('programme', '<>', '')
            ->distinct()
            ->orderBy('programme')
            ->pluck('programme');
        $semesters = Student::query()
            ->whereNotNull('semester')
            ->distinct()
            ->orderBy('semester')
            ->pluck('semester');
        $classGroups = ClassGroup::query()
            ->with('programme')
            ->orderBy('group_name')
            ->get();

        return view('lecturer.student-records.index', compact(
            'students',
            'totalStudents',
            'programmes',
            'semesters',
            'classGroups',
            'search',
            'validated'
        ));
    }

    /** A lecturer can open any student's read-only record. */
    public function show($studentId)
    {
        abort_unless(auth()->user()?->lecturer, 403, 'Lecturer profile not found.');

        $student = Student::query()
            ->where('student_id', $studentId)
            ->with([
                'user',
                'classGroup.programme',
                'programmeStructure',
                'subjectRegistrations' => function ($query) {
                    $query->with(['subject', 'classModel.classGroup'])
                        ->orderByDesc('registration_date');
                },
                'studentMarks' => function ($query) {
                    $query->with(['subject', 'classModel.classGroup', 'lecturer'])
                        ->latest('updated_at');
                },
                'academicResults' => function ($query) {
                    $query->with('subject')
                        ->orderBy('semester')
                        ->orderBy('subject_id');
                },
            ])
            ->firstOrFail();

        return view('lecturer.student-records.show', compact('student'));
    }
}
