<?php

namespace App\Http\Controllers;

use App\Models\ProgrammeStructureSubject;
use App\Models\Lecturer;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UppManageSubjectController extends Controller
{
    /**
     * Display the subject catalogue managed by UPP.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'programme' => ['nullable', 'string', 'max:20'],
            'semester' => ['nullable', 'integer', 'min:1'],
        ]);

        $search = trim($validated['search'] ?? '');
        $programme = $validated['programme'] ?? '';
        $semester = $validated['semester'] ?? '';

        $subjects = Subject::with('coordinatorLecturer')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subjectQuery) use ($search) {
                    $subjectQuery->where('subject_code', 'like', "%{$search}%")
                        ->orWhere('subject_name', 'like', "%{$search}%");
                });
            })
            ->when($semester !== '', fn ($query) => $query->where('semester', $semester))
            ->when($programme !== '', function ($query) use ($programme) {
                $query->whereIn('subjects.subject_id', function ($subQuery) use ($programme) {
                    $subQuery->select('pss.subject_id')
                        ->from('programme_structure_subjects as pss')
                        ->join('programme_structures as ps', 'ps.structure_id', '=', 'pss.structure_id')
                        ->join('programmes as p', 'p.programme_id', '=', 'ps.programme_id')
                        ->where('p.programme_code', $programme);
                });
            })
            ->orderBy('subject_code')
            ->paginate(10)
            ->withQueryString();

        $programmes = DB::table('programmes')
            ->where('status', 'active')
            ->orderBy('programme_code')
            ->get(['programme_code', 'programme_name']);

        $semesters = Subject::query()
            ->select('semester')
            ->distinct()
            ->orderBy('semester')
            ->pluck('semester');

        return view('upp.subject', compact(
            'subjects',
            'search',
            'programme',
            'semester',
            'programmes',
            'semesters'
        ));
    }

    /**
     * Store a new subject record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_code' => ['required', 'string', 'max:20', 'unique:subjects,subject_code'],
            'subject_name' => ['required', 'string', 'max:100'],
            'credit_hour' => ['required', 'integer', 'min:1'],
            'semester' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        Subject::create($validated);

        return redirect()->route('upp.subjects.index')
            ->with('success', 'Subject record has been added successfully.');
    }

    /**
     * Show the edit form for a subject.
     */
    public function edit(int $subjectId)
    {
        $subject = Subject::with('coordinatorLecturer')->findOrFail($subjectId);
        $lecturers = Lecturer::orderBy('lecturer_name')->get();

        return view('upp.subject-record-edit', compact('subject', 'lecturers'));
    }

    /**
     * Update an existing subject record.
     */
    public function update(Request $request, int $subjectId)
    {
        $subject = Subject::findOrFail($subjectId);

        $validated = $request->validate([
            'subject_code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('subjects', 'subject_code')->ignore($subject->subject_id, 'subject_id'),
            ],
            'subject_name' => ['required', 'string', 'max:100'],
            'credit_hour' => ['required', 'integer', 'min:1'],
            'semester' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'coordinator_lecturer_id' => ['nullable', 'string', 'max:20', 'exists:lecturers,lecturer_id'],
        ]);

        $subject->update($validated);

        return redirect()->route('upp.subjects.index')
            ->with('success', 'Subject record has been updated successfully.');
    }

    /**
     * Delete a subject only when it is not used by academic records.
     */
    public function destroy(int $subjectId)
    {
        $subject = Subject::findOrFail($subjectId);

        $isInUse = $subject->classes()->exists()
            || $subject->subjectRegistrations()->exists()
            || $subject->studentMarks()->exists()
            || $subject->academicResults()->exists()
            || ProgrammeStructureSubject::where('subject_id', $subject->subject_id)->exists();

        if ($isInUse) {
            return redirect()->route('upp.subjects.index')
                ->with('error', 'This subject cannot be deleted because it is already used in programme structures, classes, registrations, marks or academic results.');
        }

        $subject->delete();

        return redirect()->route('upp.subjects.index')
            ->with('success', 'Subject record has been deleted successfully.');
    }
}
