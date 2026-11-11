<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\ClassModel;
use App\Models\AssessmentMark;
use App\Models\LecturerDirectory;
use App\Models\Lecturer;
use App\Models\Programme;
use App\Models\ProgrammeStructure;
use App\Models\ProgrammeStructureSubject;
use App\Models\SubjectRegistration;
use App\Support\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UppManageSubjectClassController extends Controller
{
    private const DEFAULT_SESSION = AcademicSession::CURRENT;

    public function index(Request $request)
    {
        $filters = $request->validate([
            'programme_id' => ['nullable', 'integer', 'exists:programmes,programme_id'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:12'],
            'academic_session' => ['nullable', 'string', 'max:20'],
            'group_id' => ['nullable', 'integer', 'exists:class_groups,group_id'],
            'class_type' => ['nullable', 'in:all,regular,repeat'],
            'filter_programme_id' => ['nullable', 'integer', 'exists:programmes,programme_id'],
            'filter_semester' => ['nullable', 'integer', 'min:1', 'max:12'],
            'filter_group_id' => ['nullable', 'integer', 'exists:class_groups,group_id'],
            'filter_class_type' => ['nullable', 'in:all,regular,repeat'],
        ]);

        $filters['academic_session'] = AcademicSession::normalizeKnownAlias(
            $filters['academic_session'] ?? self::DEFAULT_SESSION
        ) ?? self::DEFAULT_SESSION;
        $filters['class_type'] = $filters['class_type'] ?? 'all';
        $filters['filter_class_type'] = $filters['filter_class_type'] ?? 'all';

        $programmes = Programme::where('status', 'active')->orderBy('programme_name')->get();
        $this->syncTimetableGroups($filters['academic_session']);

        // Class groups represent the students' actual current cohort.
        // Do not filter these groups by the semester of the subject being assigned.
        $groups = ClassGroup::query()
            ->when($filters['programme_id'] ?? null, fn ($q, $id) => $q->where('programme_id', $id))
            ->where('academic_session', $filters['academic_session'])
            ->orderBy('group_name')->get();

        // Used by the existing-assignment filter. Keep this list separate from
        // the cohort selector above, which is narrowed by the selected programme.
        $allGroups = ClassGroup::query()
            ->where('academic_session', $filters['academic_session'])
            ->orderBy('group_name')
            ->get();

        $selectedProgramme = !empty($filters['programme_id'])
            ? Programme::find($filters['programme_id']) : null;
        $selectedGroup = !empty($filters['group_id'])
            ? ClassGroup::with('programme')->where('group_id', $filters['group_id'])
                ->where('academic_session', $filters['academic_session'])
                ->when($filters['programme_id'] ?? null, fn ($q, $id) => $q->where('programme_id', $id))
                ->first()
            : null;

        $selectedStructure = $selectedGroup
            ? $this->resolveStructureForGroup($selectedGroup)
            : null;

        $structureWarning = null;

        if ($selectedGroup && !$selectedStructure) {
            $structureWarning =
                'Programme structure tidak ditemui untuk programme dan semester cohort ini.';
        }

        $subjects = collect();
        $lecturers = LecturerDirectory::orderBy('lecturer_name')->get();

        if ($selectedStructure && !empty($filters['semester'])) {
            $subjects = ProgrammeStructureSubject::with('subject')
                ->where('structure_id', $selectedStructure->structure_id)
                ->where('semester', $filters['semester'])
                ->whereHas('subject', fn ($q) => $q->where('status', 'active'))
                ->get()
                ->filter(fn ($row) => $row->subject)
                ->sortBy(fn ($row) => $row->subject->subject_code)
                ->values();
        }

        $classes = ClassModel::with(['subject', 'lecturerDirectory', 'lecturer', 'classGroup', 'programmeStructure.programme'])
            ->where('academic_session', $filters['academic_session'])
            ->when($filters['filter_programme_id'] ?? null, function ($q, $id) {
                $q->where(function ($sub) use ($id) {
                    $sub->whereHas('classGroup', fn ($g) => $g->where('programme_id', $id))
                        ->orWhereHas('programmeStructure', fn ($s) => $s->where('programme_id', $id));
                });
            })
            ->when($filters['filter_semester'] ?? null, fn ($q, $sem) => $q->where('semester', $sem))
            ->when($filters['filter_group_id'] ?? null, fn ($q, $id) => $q->where('group_id', $id))
            ->when($filters['filter_class_type'] !== 'all', fn ($q) => $q->where('class_type', $filters['filter_class_type']))
            ->orderBy('class_type')->orderBy('class_name')->get();
       
            $managedRepeatClass = null;
            $repeatStudents = collect();

            if ($request->filled('manage_repeat_class_id')) {
                $managedRepeatClass = ClassModel::with([
                    'subject',
                    'classGroup',
                ])
                    ->where('class_id', $request->manage_repeat_class_id)
                    ->where('class_type', 'repeat')
                    ->first();

                if ($managedRepeatClass) {
                    $repeatStudents = SubjectRegistration::with('student')
                        ->where('class_id', $managedRepeatClass->class_id)
                        ->where('registration_type', 'repeat')
                        ->where('registration_status', 'approved')
                        ->orderBy('student_id')
                        ->get();
                }
            }

        return view('upp.subject-classes', compact(
            'filters', 'programmes', 'selectedProgramme', 'selectedGroup', 'selectedStructure',
            'structureWarning', 'groups', 'allGroups', 'subjects', 'lecturers', 'classes', 
            'managedRepeatClass', 'repeatStudents'
        ));
    }

    /**
     * Synchronize only the timetable catalogue's own academic session.
     * The catalogue carries stable group_id values; use those to recover an
     * existing group when its session was previously stored in a legacy format.
     * Never copy the current timetable groups into a historical session filter.
     */
    private function syncTimetableGroups(string $session): void
    {
        $path = storage_path('app/data/student_timetable_catalog.json');
        if (!File::exists($path)) return;

        $catalog = json_decode(File::get($path), true);
        if (!is_array($catalog) || !is_array($catalog['classes'] ?? null)) return;

        $catalogSession = AcademicSession::normalizeKnownAlias(
            (string) ($catalog['academic_session'] ?? '')
        );
        $requestedSession = AcademicSession::normalizeKnownAlias($session);

        // The JSON file represents one specific timetable session. It must not
        // create/update groups when the user is viewing a different session.
        if (!$catalogSession || $requestedSession !== $catalogSession) {
            return;
        }

        DB::transaction(function () use ($catalog, $catalogSession) {
            foreach ($catalog['classes'] as $entry) {
                if (($entry['class_type'] ?? 'regular') !== 'regular') {
                    continue;
                }
                $programmeId = (int) ($entry['programme_id'] ?? 0);
                $groupName = trim((string) ($entry['class_name'] ?? ''));
                $semester = (int) ($entry['semester'] ?? 0);
                $entrySession = AcademicSession::normalizeKnownAlias(
                    (string) ($entry['academic_session'] ?? '')
                );
                $catalogGroupId = isset($entry['group_id']) ? (int) $entry['group_id'] : 0;

                if (!$programmeId || $groupName === '' || $semester < 1 || $entrySession !== $catalogSession) {
                    continue;
                }

                // Prefer the canonical name+session record when it already exists.
                $group = ClassGroup::query()
                    ->where('group_name', $groupName)
                    ->where('academic_session', $entrySession)
                    ->first();

                // If the catalogue's stable ID points to the same named group,
                // update that row instead of creating a second group just because
                // its stored academic_session uses an older spelling.
                if (!$group && $catalogGroupId > 0) {
                    $candidate = ClassGroup::query()
                        ->where('group_id', $catalogGroupId)
                        ->where('group_name', $groupName)
                        ->first();

                    if ($candidate) {
                        $group = $candidate;
                    }
                }

                if ($group) {
                    $group->update([
                        'programme_id' => $programmeId,
                        'semester' => $semester,
                        'academic_session' => $entrySession,
                    ]);
                } else {
                    ClassGroup::create([
                        'group_name' => $groupName,
                        'programme_id' => $programmeId,
                        'semester' => $semester,
                        'academic_session' => $entrySession,
                    ]);
                }
            }
        });
    }

    /**
     * Resolve the programme structure from the actual students assigned to
     * this class group. The subject semester is intentionally not used here.
     * Return a structure only when the group has exactly one matching structure.
     */
    
    private function resolveStructureForGroup(ClassGroup $group): ?ProgrammeStructure
    {
        // Programme ID => Cohort semester => Structure ID
        // Based on the existing programme structure records.
        $structureMap = [
            1 => [1 => 4, 3 => 4, 4 => 4, 5 => 3, 6 => 3], // DCS
            2 => [1 => 6, 3 => 6, 4 => 6, 6 => 5], // DBS
            3 => [1 => 8, 3 => 8, 4 => 8, 6 => 7], // DIA
            4 => [6 => 9],                          // DLH
            5 => [1 => 10, 2 => 10],                 // CFAB
        ];

        $programmeId = (int) $group->programme_id;
        $cohortSemester = (int) $group->semester;

        $structureId = $structureMap[$programmeId][$cohortSemester] ?? null;

        if (!$structureId) {
            return null;
        }

        return ProgrammeStructure::with('programme')
            ->where('structure_id', $structureId)
            ->where('programme_id', $programmeId)
            ->first();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'programme_id' => ['required', 'integer', 'exists:programmes,programme_id'],
            'semester' => ['required', 'integer', 'min:1', 'max:12'],
            'academic_session' => AcademicSession::rules(),
            'class_type' => ['required', 'in:regular,repeat'],
            'group_id' => ['required', 'integer', 'exists:class_groups,group_id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,subject_id'],
            'lecturer_directory_id' => ['required', 'integer', 'exists:lecturer_directory,id'],
        ]);

        $group = ClassGroup::with('programme')
            ->where('group_id', $validated['group_id'])
            ->where('programme_id', $validated['programme_id'])
            ->where('academic_session', $validated['academic_session'])
            ->first();

        if (!$group) {
            return $this->backToFilters($request)->with('error', 'Sila pilih class group yang sepadan dengan programme dan sesi akademik.');
        }

        $structure = $this->resolveStructureForGroup($group);
        if (!$structure) {
            return $this->backToFilters($request)->with('error', 'Programme structure tidak ditemui untuk class group ini.');
        }

        $subjectRow = ProgrammeStructureSubject::with('subject')
            ->where('structure_id', $structure->structure_id)
            ->where('subject_id', $validated['subject_id'])
            ->where('semester', $validated['semester'])
            ->whereHas('subject', fn ($q) => $q->where('status', 'active'))
            ->first();

        if (!$subjectRow || !$subjectRow->subject) {
            return $this->backToFilters($request)->with('error', 'Subjek tidak termasuk dalam programme structure cohort dan semester yang dipilih.');
        }

        $lecturer = LecturerDirectory::findOrFail($validated['lecturer_directory_id']);
        $lecturerId = $this->resolveLecturerId($lecturer);
        $subject = $subjectRow->subject;

        $duplicate = ClassModel::where('group_id', $group->group_id)
            ->where('subject_id', $subject->subject_id)
            ->where('academic_session', $validated['academic_session'])
            ->where('class_type', $validated['class_type'])
            ->exists();

        if ($duplicate) {
            return $this->backToFilters($request)->with('error', 'Subject class untuk kumpulan dan subjek ini sudah wujud.');
        }

        ClassModel::create([
            'group_id' => $group->group_id,
            'structure_id' => $structure->structure_id,
            'class_type' => $validated['class_type'],
            'subject_id' => $subject->subject_id,
            'lecturer_id' => $lecturerId,
            'lecturer_directory_id' => $lecturer->id,
            'class_name' => $validated['class_type'] === 'repeat'
                ? $group->group_name . ' - Repeat ' . $subject->subject_code
                : $group->group_name . ' - ' . $subject->subject_name,
            // This is the semester of the subject, not the student's cohort semester.
            'semester' => $subjectRow->semester,
            'academic_session' => $validated['academic_session'],
        ]);

        return $this->backToFilters($request)->with('success', 'Subject class berjaya diwujudkan.');
    }

    public function update(Request $request, int $classId)
    {
        $class = ClassModel::findOrFail($classId);
        $data = $request->validate(['lecturer_directory_id' => ['required', 'integer', 'exists:lecturer_directory,id']]);
        $lecturerDirectory = LecturerDirectory::findOrFail($data['lecturer_directory_id']);
        $lecturerId = $this->resolveLecturerId($lecturerDirectory);

        $class->update([
            'lecturer_id' => $lecturerId,
            'lecturer_directory_id' => $lecturerDirectory->id,
        ]);

        $message = $lecturerId
            ? 'Pensyarah kelas berjaya dikemaskini dan dipautkan kepada akaun lecturer.'
            : 'Directory pensyarah berjaya dikemaskini. Akaun Lecturer belum dipautkan kerana rekod dalam jadual lecturers tidak ditemui.';

        return $this->backToFilters($request)->with('success', $message);
    }

    public function destroy(Request $request, int $classId)
    {
        $class = ClassModel::findOrFail($classId);
        if (AssessmentMark::where('class_id', $class->class_id)->exists() || $class->subjectRegistrations()->exists() || $class->studentMarks()->exists() || $class->classTimetables()->exists() || $class->repeatApplications()->exists()) {
            return $this->backToFilters($request)->with('error', 'Kelas tidak boleh dipadam kerana sudah mempunyai rekod pendaftaran, markah penilaian, jadual atau permohonan repeat.');
        }
        $class->delete();
        return $this->backToFilters($request)->with('success', 'Subject class berjaya dipadam.');
    }

    // Kept for backward compatibility with existing named routes.
    public function storeRepeat(Request $request)
    {
        $request->merge(['class_type' => 'repeat']);
        return $this->store($request);
    }

    public function updateRepeat(Request $request, int $classId) { return $this->update($request, $classId); }
    public function destroyRepeat(Request $request, int $classId) { return $this->destroy($request, $classId); }

    /**
     * Match the selected directory lecturer to the lecturer account record.
     * Directory and lecturer records may use different email domains and
     * abbreviations such as "Bt" / "Binti", so use a normalized full name.
     * Return null when no unique lecturer record can be identified.
     */
    private function resolveLecturerId(LecturerDirectory $directory): ?string
    {
        $normalizeName = static function (?string $name): string {
            $name = mb_strtolower(trim((string) $name));
            $name = str_replace(['binti', 'bin'], ['bt', 'b'], $name);
            $name = preg_replace('/[^a-z0-9]+/u', ' ', $name);

            return trim(preg_replace('/\s+/', ' ', $name));
        };

        $directoryName = $normalizeName($directory->lecturer_name);

        $matches = Lecturer::query()
            ->get(['lecturer_id', 'lecturer_name'])
            ->filter(fn ($lecturer) =>
                $normalizeName($lecturer->lecturer_name) === $directoryName
            );

        // Avoid linking to the wrong person if names are not unique.
        return $matches->count() === 1
            ? (string) $matches->first()->lecturer_id
            : null;
    }

    private function backToFilters(Request $request)
    {
        return redirect()->route('upp.subject-classes.index', $request->only([
            'programme_id', 'semester', 'academic_session', 'group_id', 'class_type', 'filter_programme_id', 'filter_semester', 'filter_group_id', 'filter_class_type'
        ]));
    }
}
