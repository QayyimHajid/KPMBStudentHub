<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentTimetableController extends Controller
{
    public function index(Request $request)
    {
        $student = auth()->user()->student;
        $programmes = Programme::where('status', 'active')->orderBy('programme_name')->get();
        $catalogPath = storage_path('app/data/student_timetable_catalog.json');
        $catalog = is_file($catalogPath)
            ? json_decode(file_get_contents($catalogPath), true)
            : ['classes' => []];
        $catalogClasses = collect($catalog['classes'] ?? []);

        $studentGroup = $student?->group_id
            ? ClassGroup::with('programme')->find($student->group_id)
            : null;

        $studentProgrammeId = $studentGroup?->programme_id;
        if (!$studentProgrammeId && $student?->programme) {
            $studentProgrammeId = $programmes->first(fn ($programme) =>
                strcasecmp($programme->programme_name, (string) $student->programme) === 0
                || strcasecmp($programme->programme_code, (string) $student->programme) === 0
            )?->programme_id;
        }

        $selectedProgrammeId = $request->filled('programme_id')
            ? $request->integer('programme_id')
            : ($studentProgrammeId ?: $programmes->first()?->programme_id);

        $programme = $programmes->firstWhere('programme_id', $selectedProgrammeId);
        $programmeCode = $programme?->programme_code;

        $programmeClasses = $catalogClasses
            ->where('programme_code', $programmeCode)
            ->values();

        $availableSemesters = $programmeClasses
            ->pluck('semester')->filter()->unique()->sort()->values();

        $selectedSemester = $request->filled('semester')
            ? $request->integer('semester')
            : ($studentGroup && (int) $studentGroup->programme_id === (int) $selectedProgrammeId
                ? (int) $studentGroup->semester
                : $availableSemesters->first());

        $semesterClasses = $programmeClasses
            ->filter(fn ($item) => (int) ($item['semester'] ?? 0) === (int) $selectedSemester)
            ->sortBy('class_name')->values();

        $groups = $semesterClasses->map(function ($item) use ($programme, $catalog) {
            $slug = Str::slug($item['class_name']);
            return (object) [
                'group_id' => 'catalog-' . $item['programme_code'] . '-' . $slug,
                'group_name' => $item['class_name'],
                'programme_id' => $item['programme_id'],
                'programme' => $programme,
                'semester' => $item['semester'],
                'academic_session' => $item['academic_session'] ?? ($catalog['academic_session'] ?? '2 2026/2027'),
                'source' => $item['source'] ?? 'DOCX',
                'schedule_available' => !empty($item['schedule']),
                'catalog_item' => $item,
            ];
        })->values();

        $selectedGroup = null;
        if ($request->filled('group_id')) {
            $selectedGroup = $groups->first(fn ($group) =>
                (string) $group->group_id === (string) $request->input('group_id')
            );
        }

        if (!$selectedGroup && $studentGroup && (int) $studentGroup->programme_id === (int) $selectedProgrammeId) {
            $selectedGroup = $groups->first(fn ($group) =>
                strcasecmp($group->group_name, $studentGroup->group_name) === 0
            );
        }

        $selectedGroup ??= $groups->first();

        $timetable = collect();
        $classes = collect();
        $subjects = collect();
        $scheduleAvailable = false;

        if ($selectedGroup) {
            $item = $selectedGroup->catalog_item;
            $scheduleRows = collect($item['schedule'] ?? []);
            $scheduleAvailable = $scheduleRows->isNotEmpty();

            // Existing DCS 6A/6B schedules are read from the current database.
            // The other 47 catalogue entries are display-only JSON data; no class rows are created.
            if (($item['source'] ?? '') === 'DATABASE_EXISTING') {
                $dbGroupId = $item['group_id'] ?? null;
                $dbClasses = DB::table('classes as c')
                    ->leftJoin('subjects as s', 'c.subject_id', '=', 's.subject_id')
                    ->leftJoin('lecturer_directory as ld', 'c.lecturer_directory_id', '=', 'ld.id')
                    ->leftJoin('lecturers as l', 'c.lecturer_id', '=', 'l.lecturer_id')
                    ->leftJoin('class_timetables as ct', 'c.class_id', '=', 'ct.class_id')
                    ->where('c.group_id', $dbGroupId)
                    ->where('c.class_type', 'regular')
                    ->select(
                        'c.class_id', 'c.class_name', 's.subject_id', 's.subject_code', 's.subject_name', 's.credit_hour',
                        'ld.lecturer_name as directory_lecturer_name', 'ld.email as directory_email',
                        'l.lecturer_name as lecturer_name', 'l.email as lecturer_email',
                        'ct.timetable_id', 'ct.day', 'ct.start_time', 'ct.end_time', 'ct.venue'
                    )->orderBy('ct.day')->orderBy('ct.start_time')->get();

                $timetable = $dbClasses->filter(fn ($row) => $row->timetable_id !== null)->map(function ($row) {
                    return (object) [
                        'timetable_id' => $row->timetable_id,
                        'day' => $row->day,
                        'start_time' => $row->start_time,
                        'end_time' => $row->end_time,
                        'venue' => $row->venue,
                        'class_id' => $row->class_id,
                        'class_name' => $row->class_name,
                        'subject' => (object) ['subject_id' => $row->subject_id, 'subject_code' => $row->subject_code, 'subject_name' => $row->subject_name, 'credit_hour' => $row->credit_hour],
                        'lecturer' => (object) ['lecturer_name' => $row->directory_lecturer_name ?: $row->lecturer_name],
                    ];
                })->values();

                $classes = $dbClasses->groupBy('subject_id')->map(function ($rows) {
                    $first = $rows->first();
                    return (object) [
                        'class_name' => $first->class_name,
                        'subject' => (object) ['subject_id' => $first->subject_id, 'subject_code' => $first->subject_code, 'subject_name' => $first->subject_name, 'credit_hour' => $first->credit_hour],
                        'lecturerDirectory' => (object) ['lecturer_name' => $first->directory_lecturer_name, 'email' => $first->directory_email],
                        'lecturer' => (object) ['lecturer_name' => $first->lecturer_name, 'email' => $first->lecturer_email],
                        'classTimetables' => $rows->filter(fn ($row) => $row->timetable_id !== null)->map(fn ($row) => (object) ['venue' => $row->venue])->values(),
                    ];
                })->values();
            } else {
                $timetable = $scheduleRows->map(function ($row, $index) use ($item) {
                    return (object) [
                        'timetable_id' => $index + 1,
                        'day' => $row['day'],
                        'start_time' => $row['start_time'],
                        'end_time' => $row['end_time'],
                        'venue' => $row['venue'],
                        'class_id' => null,
                        'class_name' => $item['class_name'],
                        'subject' => (object) [
                            'subject_id' => $row['subject_id'] ?? null,
                            'subject_code' => $row['subject_code'] ?? null,
                            'subject_name' => $row['subject_name'] ?? 'Subjek tidak dinyatakan',
                            'credit_hour' => $row['credit_hour'] ?? null,
                        ],
                        'lecturer' => (object) ['lecturer_name' => $row['lecturer_name'] ?? null],
                    ];
                })->sortBy(fn ($entry) => sprintf('%d-%s', $this->dayOrder($entry->day), $entry->start_time))->values();

                $classes = $scheduleRows->groupBy(fn ($row) => ($row['subject_code'] ?? '') . '|' . $row['subject_name'])
                    ->map(function ($rows) use ($item) {
                        $first = $rows->first();
                        return (object) [
                            'class_name' => $item['class_name'],
                            'subject' => (object) [
                                'subject_id' => $first['subject_id'] ?? null,
                                'subject_code' => $first['subject_code'] ?? null,
                                'subject_name' => $first['subject_name'] ?? 'Subjek tidak dinyatakan',
                                'credit_hour' => $first['credit_hour'] ?? null,
                            ],
                            'lecturerDirectory' => null,
                            'lecturer' => (object) ['lecturer_name' => $first['lecturer_name'] ?? null, 'email' => null],
                            'classTimetables' => $rows->map(fn ($row) => (object) ['venue' => $row['venue']])->values(),
                        ];
                    })->values();
            }

            $subjects = $classes->pluck('subject')->filter()->unique('subject_id')->values();
        }

        $groupAssignmentMissing = false;

        return view('student.timetable', compact(
            'student', 'programmes', 'studentProgrammeId', 'selectedProgrammeId', 'availableSemesters',
            'groups', 'selectedGroup', 'groupAssignmentMissing', 'scheduleAvailable', 'timetable', 'subjects', 'classes'
        ));
    }

    private function dayOrder(?string $day): int
    {
        return match (strtolower((string) $day)) {
            'monday', 'isnin' => 1,
            'tuesday', 'selasa' => 2,
            'wednesday', 'rabu' => 3,
            'thursday', 'khamis' => 4,
            'friday', 'jumaat' => 5,
            default => 6,
        };
    }
}
