<?php

namespace App\Http\Controllers;

use App\Models\AlternativeSubjectGroup;
use App\Models\Student;
use App\Models\StudentAlternativeSubjectChoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UppAlternativeSubjectController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'programme' => ['nullable', 'string', 'max:20'],
            'semester' => ['nullable', 'integer', 'min:1'],
        ]);

        $search = trim($validated['search'] ?? '');
        $programme = $validated['programme'] ?? '';
        $semesterFilter = $validated['semester'] ?? '';

        $query = Student::with(['programmeStructure.programme', 'classGroup'])
            ->whereNotNull('structure_id');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('student_id', 'like', "%{$search}%")
                    ->orWhere('student_name', 'like', "%{$search}%");
            });
        }

        if ($programme !== '') {
            $query->whereHas('programmeStructure.programme', function ($q) use ($programme) {
                $q->where('programme_code', $programme);
            });
        }

        if ($semesterFilter !== '') {
            $query->where('semester', (int) $semesterFilter);
        }

        // Students with an alternative subject group for their next semester
        // are prioritized before students who do not have an eligible group yet.
        $query->orderByRaw(
            'CASE WHEN EXISTS (
                SELECT 1
                FROM alternative_subject_groups AS asg
                WHERE asg.structure_id = students.structure_id
                  AND asg.semester = students.semester + 1
            ) THEN 0 ELSE 1 END'
        )
        ->orderBy('semester')
        ->orderBy('student_name');

        $students = $query->paginate(20)->withQueryString();

        $programmeOptions = DB::table('programmes')
            ->orderBy('programme_code')
            ->get(['programme_code', 'programme_name']);

        $semesterOptions = Student::query()
            ->whereNotNull('structure_id')
            ->select('semester')
            ->distinct()
            ->orderBy('semester')
            ->pluck('semester');

        $groupsByStudent = [];
        foreach ($students as $student) {
            $nextSemester = (int) $student->semester + 1;

            $groups = AlternativeSubjectGroup::with(['subjectMappings.subject'])
                ->where('structure_id', $student->structure_id)
                ->where('semester', $nextSemester)
                ->orderBy('group_name')
                ->get();

            $choices = StudentAlternativeSubjectChoice::where('student_id', $student->student_id)
                ->whereIn('alternative_group_id', $groups->pluck('alternative_group_id'))
                ->get()
                ->keyBy('alternative_group_id');

            $groupsByStudent[$student->student_id] = [
                'semester' => $nextSemester,
                'groups' => $groups,
                'choices' => $choices,
            ];
        }

        return view('upp.alternative-subjects', compact(
            'students',
            'programmeOptions',
            'semesterOptions',
            'groupsByStudent',
            'search',
            'programme',
            'semesterFilter'
        ));
    }

    public function update(Request $request, string $studentId)
    {
        $student = Student::findOrFail($studentId);
        abort_unless($student->structure_id, 422, 'Programme structure pelajar belum ditetapkan.');

        $semester = (int) $student->semester + 1;
        $groups = AlternativeSubjectGroup::where('structure_id', $student->structure_id)
            ->where('semester', $semester)
            ->get()
            ->keyBy('alternative_group_id');

        $validated = $request->validate([
            'choices' => ['required', 'array'],
            'choices.*' => ['required', 'integer'],
        ]);

        foreach ($validated['choices'] as $groupId => $subjectId) {
            $group = $groups->get((int) $groupId);
            if (!$group) {
                throw ValidationException::withMessages([
                    'choices' => 'Kumpulan alternatif tidak sah untuk pelajar atau semester ini.',
                ]);
            }

            $isMember = DB::table('programme_structure_subjects')
                ->where('structure_id', $student->structure_id)
                ->where('semester', $semester)
                ->where('alternative_group_id', $group->alternative_group_id)
                ->where('subject_id', $subjectId)
                ->exists();

            if (!$isMember) {
                throw ValidationException::withMessages([
                    'choices.' . $groupId => 'Subjek yang dipilih bukan ahli kumpulan alternatif ini.',
                ]);
            }
        }

        DB::transaction(function () use ($student, $validated, $groups) {
            foreach ($validated['choices'] as $groupId => $subjectId) {
                StudentAlternativeSubjectChoice::updateOrCreate(
                    [
                        'student_id' => $student->student_id,
                        'alternative_group_id' => (int) $groupId,
                    ],
                    ['subject_id' => $subjectId]
                );
            }
        });

        return redirect()->route('upp.alternative-subjects.index')
            ->with('success', 'Pilihan subjek alternatif pelajar berjaya disimpan.');
    }
}
