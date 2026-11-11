<?php

namespace App\Http\Controllers;

use App\Models\ProgrammeStructure;
use App\Models\Lecturer;
use App\Models\LecturerDirectory;
use App\Models\StudentMentorAssignment;
use App\Models\Student;
use App\Models\StudentRoster;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class UppManageStudentController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'programme' => ['nullable', 'string', 'max:100'],
            'semester' => ['nullable', 'integer', 'min:1'],
        ]);

        $search = trim($validated['search'] ?? '');
        $programme = $validated['programme'] ?? '';
        $semester = $validated['semester'] ?? '';

        $students = StudentRoster::with([
                'student.currentMentorAssignment.lecturerDirectory',
                'student.currentMentorAssignment.lecturer',
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('student_id', 'like', "%{$search}%")
                        ->orWhere('student_name', 'like', "%{$search}%");
                });
            })
            ->when($programme !== '', fn ($query) => $query->where('programme', $programme))
            ->when($semester !== '', fn ($query) => $query->where('semester', $semester))
            ->orderBy('student_id')
            ->paginate(10)
            ->withQueryString();

        $programmes = DB::table('programmes')
            ->where('status', 'active')
            ->orderBy('programme_code')
            ->get(['programme_code', 'programme_name']);

        $semesters = StudentRoster::query()
            ->select('semester')
            ->distinct()
            ->orderBy('semester')
            ->pluck('semester');

        $lecturerDirectory = LecturerDirectory::query()
            ->orderBy('department')
            ->orderBy('lecturer_name')
            ->get([
                'id',
                'lecturer_name',
                'position',
                'department',
                'email',
                'photo_path',
            ]);

        return view('upp.student', compact(
            'students',
            'search',
            'programme',
            'semester',
            'programmes',
            'semesters',
            'lecturerDirectory'
        ));
    }

    public function store(Request $request)
    {
        $request->merge([
            'student_id' => strtoupper(trim($request->input('student_id', ''))),
            'student_name' => trim($request->input('student_name', '')),
            'programme' => trim($request->input('programme', '')),
        ]);

        $validated = $request->validate([
            'student_id' => ['required', 'string', 'max:20', Rule::unique('student_rosters', 'student_id')],
            'student_name' => ['required', 'string', 'max:100'],
            'programme' => [
                'required',
                'string',
                Rule::in([
                    'Diploma in Accounting',
                    'Diploma in Business Studies',
                    'Diploma in Computer Science',
                    'Diploma in Landscape and Horticulture',
                    'Certificate in Finance, Accounting and Business',
                ]),
            ],
            'semester' => ['required', 'integer', 'min:1'],
        ]);

        StudentRoster::create($validated);

        return redirect()->route('upp.students.index')
            ->with('success', 'Student record added successfully.');
    }

    public function edit(string $studentId)
    {
        $student = StudentRoster::with('student')->findOrFail($studentId);

        // Draft structures are intentionally selectable for development/testing.
        $programmeStructures = ProgrammeStructure::with('programme')
            ->where('status', 'draft')
            ->whereHas('programme', function ($query) use ($student) {
                $query->where('programme_name', trim($student->programme));
            })
            ->orderBy('intake_code')
            ->orderBy('version')
            ->get();

        // Class groups represent the student's current semester.
        // The dropdown is filtered client-side when UPP changes the semester.
        $programmeId = ProgrammeStructure::query()
            ->whereHas('programme', function ($query) use ($student) {
                $query->where('programme_name', trim($student->programme));
            })
            ->value('programme_id');

        $classGroups = $programmeId
            ? DB::table('class_groups')
                ->where('programme_id', $programmeId)
                ->orderBy('semester')
                ->orderBy('group_name')
                ->get([
                    'group_id',
                    'group_name',
                    'semester',
                    'academic_session',
                ])
            : collect();

        return view('upp.student-edit', compact(
            'student',
            'programmeStructures',
            'classGroups'
        ));
    }

    public function update(Request $request, string $studentId)
    {
        $student = StudentRoster::findOrFail($studentId);

        $request->merge([
            'student_name' => trim($request->input('student_name', '')),
            'programme' => trim($request->input('programme', '')),
        ]);

        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:100'],
            'programme' => [
                'required',
                'string',
                Rule::in([
                    'Diploma in Accounting',
                    'Diploma in Business Studies',
                    'Diploma in Computer Science',
                    'Diploma in Landscape and Horticulture',
                    'Certificate in Finance, Accounting and Business',
                ]),
            ],
            'semester' => ['required', 'integer', 'min:1'],
            'structure_id' => ['nullable', 'integer', 'exists:programme_structures,structure_id'],
            'group_id' => ['nullable', 'integer', 'exists:class_groups,group_id'],
            'email' => ['nullable', 'email', 'max:100'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'home_address' => ['nullable', 'string', 'max:2000'],
            'guardian_name' => ['nullable', 'string', 'max:100'],
            'guardian_relationship' => ['nullable', 'string', 'max:50'],
            'guardian_phone' => ['nullable', 'string', 'max:20'],
            'guardian_occupation' => ['nullable', 'string', 'max:100'],
            'guardian_employer' => ['nullable', 'string', 'max:150'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        DB::transaction(function () use ($student, $validated, $request) {
            $student->update([
                'student_name' => $validated['student_name'],
                'programme' => $validated['programme'],
                'semester' => $validated['semester'],
            ]);

            $registeredStudent = Student::with('user')
                ->where('student_id', $student->student_id)
                ->lockForUpdate()
                ->first();

            if (!$registeredStudent) {
                if (!empty($validated['structure_id'])) {
                    throw ValidationException::withMessages([
                        'structure_id' => 'Pelajar ini belum mempunyai akaun pelajar. Programme structure belum boleh ditetapkan.',
                    ]);
                }

                return;
            }

            $structureId = $validated['structure_id'] ?? null;

            if ($structureId !== null) {
                $structure = ProgrammeStructure::with('programme')
                    ->where('structure_id', $structureId)
                    ->lockForUpdate()
                    ->firstOrFail();

                if (!$structure->programme ||
                    $structure->programme->programme_name !== trim($validated['programme'])) {
                    throw ValidationException::withMessages([
                        'structure_id' => 'Programme structure yang dipilih bukan untuk program pelajar ini.',
                    ]);
                }

                if ($structure->status !== 'draft') {
                    throw ValidationException::withMessages([
                        'structure_id' => 'Untuk proses pembangunan ini, hanya programme structure berstatus draft boleh dipilih.',
                    ]);
                }
            }

            $groupId = $validated['group_id'] ?? null;

            if ($groupId !== null) {
                $programmeId = ProgrammeStructure::query()
                    ->whereHas('programme', function ($query) use ($validated) {
                        $query->where('programme_name', trim($validated['programme']));
                    })
                    ->value('programme_id');

                $validGroup = DB::table('class_groups')
                    ->where('group_id', $groupId)
                    ->where('programme_id', $programmeId)
                    ->where('semester', (int) $validated['semester'])
                    ->exists();

                if (!$validGroup) {
                    throw ValidationException::withMessages([
                        'group_id' => 'Kumpulan kelas mesti sepadan dengan program dan semester semasa pelajar.',
                    ]);
                }
            }

            $registeredStudent->update([
                'student_name' => $validated['student_name'],
                'programme' => $validated['programme'],
                'semester' => $validated['semester'],
                'structure_id' => $structureId,
                'group_id' => $groupId,
                'email' => $validated['email'] ?? $registeredStudent->email,
                'phone_number' => array_key_exists('phone_number', $validated) ? $validated['phone_number'] : $registeredStudent->phone_number,
                'home_address' => array_key_exists('home_address', $validated) ? $validated['home_address'] : $registeredStudent->home_address,
                'guardian_name' => array_key_exists('guardian_name', $validated) ? $validated['guardian_name'] : $registeredStudent->guardian_name,
                'guardian_relationship' => array_key_exists('guardian_relationship', $validated) ? $validated['guardian_relationship'] : $registeredStudent->guardian_relationship,
                'guardian_phone' => array_key_exists('guardian_phone', $validated) ? $validated['guardian_phone'] : $registeredStudent->guardian_phone,
                'guardian_occupation' => array_key_exists('guardian_occupation', $validated) ? $validated['guardian_occupation'] : $registeredStudent->guardian_occupation,
                'guardian_employer' => array_key_exists('guardian_employer', $validated) ? $validated['guardian_employer'] : $registeredStudent->guardian_employer,
            ]);

            if ($request->hasFile('profile_picture')) {
                $oldPicture = $registeredStudent->profile_picture;
                $path = $request->file('profile_picture')->store('student-profiles', 'public');
                $registeredStudent->update(['profile_picture' => $path]);
                if ($oldPicture && $oldPicture !== $path) {
                    Storage::disk('public')->delete($oldPicture);
                }
            }

            if ($registeredStudent->user) {
                $userUpdates = ['name' => $validated['student_name']];
                if (!empty($validated['email'])) {
                    $userUpdates['email'] = $validated['email'];
                }
                $registeredStudent->user->update($userUpdates);
            }
        });

        return redirect()->route('upp.students.index')
            ->with('success', 'Student record updated successfully.');
    }

    public function assignMentor(Request $request, string $studentId)
    {
        $validated = $request->validate([
            'lecturer_directory_id' => ['required', 'integer', Rule::exists('lecturer_directory', 'id')],
        ]);

        $student = Student::where('student_id', $studentId)->firstOrFail();
        $directoryEntry = LecturerDirectory::findOrFail($validated['lecturer_directory_id']);

        DB::transaction(function () use ($student, $directoryEntry) {
            StudentMentorAssignment::where('student_id', $student->student_id)
                ->whereNull('ended_at')
                ->lockForUpdate()
                ->get()
                ->each(function ($assignment) {
                    $assignment->update(['ended_at' => now()->toDateString()]);
                });

            // Keep the legacy lecturers link when an exact email match exists.
            // Directory-only lecturers remain valid mentors without requiring an account.
            $lecturer = Lecturer::query()
                ->whereRaw('LOWER(TRIM(email)) = ?', [mb_strtolower(trim($directoryEntry->email))])
                ->first();

            StudentMentorAssignment::create([
                'student_id' => $student->student_id,
                'lecturer_id' => $lecturer?->lecturer_id,
                'lecturer_directory_id' => $directoryEntry->id,
                'assigned_by' => Auth::id(),
                'assigned_at' => now()->toDateString(),
                'ended_at' => null,
            ]);
        });

        return redirect()->route('upp.students.index', ['search' => $request->input('search')])
            ->with('success', 'Academic mentor assigned successfully.');
    }

    public function destroy(string $studentId)
    {
        $result = DB::transaction(function () use ($studentId) {
            $roster = StudentRoster::where('student_id', $studentId)
                ->lockForUpdate()
                ->firstOrFail();

            $registeredStudent = Student::with('user')
                ->where('student_id', $studentId)
                ->lockForUpdate()
                ->first();

            if (!$registeredStudent) {
                $roster->delete();

                return ['success' => true, 'message' => 'Student roster record deleted successfully.'];
            }

            $hasRelatedRecords =
                $registeredStudent->subjectRegistrations()->exists()
                || $registeredStudent->studentMarks()->exists()
                || $registeredStudent->academicResults()->exists()
                || $registeredStudent->mentorAssignments()->exists();

            if ($hasRelatedRecords) {
                return ['success' => false, 'message' => 'This student cannot be deleted because related academic or mentor records exist.'];
            }

            if ($registeredStudent->user) {
                $registeredStudent->user->delete();
            } else {
                $registeredStudent->delete();
            }

            $roster->delete();

            return ['success' => true, 'message' => 'Student record and linked account deleted successfully.'];
        });

        return redirect()->route('upp.students.index')
            ->with($result['success'] ? 'success' : 'error', $result['message']);
    }
}
