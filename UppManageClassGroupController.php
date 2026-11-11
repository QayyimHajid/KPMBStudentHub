<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\Programme;
use App\Support\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UppManageClassGroupController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'programme_id' => ['nullable', 'integer', 'exists:programmes,programme_id'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:12'],
            'academic_session' => ['nullable', 'string', 'max:20'],
        ]);
        $filters['academic_session'] = AcademicSession::normalizeKnownAlias(
            $filters['academic_session'] ?? null
        );

        $groups = ClassGroup::query()
            ->with('programme')
            ->withCount(['students', 'classes'])
            ->when($filters['programme_id'] ?? null, fn ($query, $value) =>
                $query->where('programme_id', $value))
            ->when($filters['semester'] ?? null, fn ($query, $value) =>
                $query->where('semester', $value))
            ->when($filters['academic_session'] ?? null, fn ($query, $value) =>
                $query->where('academic_session', $value))
            ->orderBy('academic_session', 'desc')
            ->orderBy('programme_id')
            ->orderBy('semester')
            ->orderBy('group_name')
            ->paginate(12)
            ->withQueryString();

        $programmes = Programme::query()
            ->where('status', 'active')
            ->orderBy('programme_name')
            ->get();

        $academicSessions = ClassGroup::query()
            ->select('academic_session')
            ->distinct()
            ->orderByDesc('academic_session')
            ->pluck('academic_session');

        return view('upp.classes', compact(
            'groups',
            'programmes',
            'academicSessions',
            'filters'
        ));
    }

    public function show(int $groupId)
    {
        $group = ClassGroup::query()
            ->with([
                'programme',
                'students' => function ($query) {
                    $query->with([
                        'currentMentorAssignment.lecturerDirectory',
                        'currentMentorAssignment.lecturer',
                    ])->orderBy('student_id');
                },
            ])
            ->withCount('students')
            ->findOrFail($groupId);

        $programmes = Programme::query()
            ->where('status', 'active')
            ->orderBy('programme_name')
            ->get();

        return view('upp.class-show', compact('group', 'programmes'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'group_name' => trim((string) $request->input('group_name', '')),
            'academic_session' => trim((string) $request->input('academic_session', '')),
        ]);

        $validated = $request->validate([
            'group_name' => ['required', 'string', 'max:50'],
            'programme_id' => ['required', 'integer', 'exists:programmes,programme_id'],
            'semester' => ['required', 'integer', 'min:1', 'max:12'],
            'academic_session' => AcademicSession::rules(),
        ]);

        $validated['group_name'] = trim($validated['group_name']);
        $validated['academic_session'] = trim($validated['academic_session']);

        $request->validate([
            'group_name' => [
                Rule::unique('class_groups', 'group_name')
                    ->where('academic_session', $validated['academic_session']),
            ],
        ], [
            'group_name.unique' => 'Nama kumpulan ini sudah digunakan dalam sesi akademik tersebut.',
        ]);

        ClassGroup::create($validated);

        return redirect()->route('upp.classes.index')
            ->with('success', 'Class group berjaya ditambah.');
    }

    public function update(Request $request, int $groupId)
    {
        $group = ClassGroup::findOrFail($groupId);
        $request->merge([
            'group_name' => trim((string) $request->input('group_name', '')),
            'academic_session' => trim((string) $request->input('academic_session', '')),
        ]);

        $validated = $request->validate([
            'group_name' => [
                'required', 'string', 'max:50',
                Rule::unique('class_groups', 'group_name')
                    ->where('academic_session', trim((string) $request->input('academic_session')))
                    ->ignore($group->group_id, 'group_id'),
            ],
            'programme_id' => ['required', 'integer', 'exists:programmes,programme_id'],
            'semester' => ['required', 'integer', 'min:1', 'max:12'],
            'academic_session' => AcademicSession::rules($group->academic_session),
        ]);

        $validated['group_name'] = trim($validated['group_name']);
        $validated['academic_session'] = trim($validated['academic_session']);

        $group->update($validated);

        return redirect()->route('upp.classes.show', $group->group_id)
            ->with('success', 'Class group berjaya dikemas kini.');
    }

    public function destroy(int $groupId)
    {
        $group = ClassGroup::withCount(['students', 'classes'])->findOrFail($groupId);

        if ($group->students_count > 0 || $group->classes_count > 0) {
            return redirect()->route('upp.classes.index')
                ->with('error', 'Class group tidak boleh dipadam kerana masih mempunyai pelajar atau rekod kelas.');
        }

        $group->delete();

        return redirect()->route('upp.classes.index')
            ->with('success', 'Class group berjaya dipadam.');
    }
}
