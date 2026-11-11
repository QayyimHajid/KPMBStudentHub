<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassGroup;
use App\Models\SubjectRegistration;
use App\Models\SubjectRegistrationApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SubjectRegistrationController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        $upcomingSemester = (int) $student->semester + 1;
        $nextClassGroup = $this->resolveNextClassGroup($student, $upcomingSemester);
        $hasProgrammeStructure = !empty($student->structure_id);
        $registrationState = 'available';
        $stateMessage = null;
        $requiredSubjectIds = collect();
        $classes = collect();
        $registrations = collect();
        $missingSubjectIds = collect();
        $missingAlternativeGroups = collect();
        $academicSession = null;
        $application = null;
        $hasIndustrialTraining = false;
        $industrialTrainingSemester = null;

        if (!$hasProgrammeStructure) {
            $registrationState = 'no_structure';
            $stateMessage = 'Programme structure anda belum ditetapkan. Sila hubungi pihak pentadbiran akademik.';
        } else {
            $programmeStructure = DB::table('programme_structures')
                ->where('structure_id', $student->structure_id)
                ->first();

            if ($programmeStructure) {
                $hasIndustrialTraining = (bool) $programmeStructure->has_industrial_training;
                $industrialTrainingSemester = $programmeStructure->industrial_training_semester !== null
                    ? (int) $programmeStructure->industrial_training_semester
                    : null;
            }

            $requiredSubjectIds = DB::table('programme_structure_subjects')
                ->where('structure_id', $student->structure_id)
                ->where('semester', $upcomingSemester)
                ->whereNull('alternative_group_id')
                ->pluck('subject_id');

            $alternativeGroups = DB::table('alternative_subject_groups')
                ->where('structure_id', $student->structure_id)
                ->where('semester', $upcomingSemester)
                ->get();

            $studentChoices = DB::table('student_alternative_subject_choices')
                ->where('student_id', $student->student_id)
                ->whereIn('alternative_group_id', $alternativeGroups->pluck('alternative_group_id'))
                ->get()
                ->keyBy('alternative_group_id');

            $missingAlternativeGroups = $alternativeGroups->filter(
                fn ($group) => !$studentChoices->has($group->alternative_group_id)
            )->values();

            $chosenSubjectIds = $studentChoices->pluck('subject_id');
            $requiredSubjectIds = $requiredSubjectIds->concat($chosenSubjectIds)->unique()->values();

            if ($missingAlternativeGroups->isNotEmpty()) {
                $registrationState = 'alternative_assignment_pending';
                $stateMessage = 'Pilihan subjek alternatif anda belum ditetapkan oleh pihak UPP. Sila hubungi pihak pentadbiran akademik.';
            }

            if ($missingAlternativeGroups->isNotEmpty()) {
                // Wait for UPP to assign one subject in every alternative group.
            } elseif ($requiredSubjectIds->isEmpty()) {
                $highestMappedSemester = DB::table('programme_structure_subjects')
                    ->where('structure_id', $student->structure_id)
                    ->max('semester');

                if ($highestMappedSemester !== null && (int) $student->semester >= (int) $highestMappedSemester) {
                    if ($hasIndustrialTraining && $industrialTrainingSemester === $upcomingSemester) {
                        $registrationState = 'industrial_training';
                        $stateMessage = 'Programme structure anda menetapkan Latihan Industri (LI) untuk Semester '
                            . $industrialTrainingSemester
                            . '. Sila ikuti proses pendaftaran dan penempatan LI yang ditetapkan oleh pihak kolej.';
                    } else {
                        $registrationState = 'final_semester';
                        $stateMessage = 'Anda tidak lagi perlu mendaftar subjek melalui halaman ini untuk semester seterusnya.';
                    }
                } else {
                    $registrationState = 'no_subjects';
                    $stateMessage = 'Tiada subjek dipetakan untuk semester akan datang dalam programme structure anda. Pendaftaran belum tersedia.';
                }
            } elseif (empty($nextClassGroup)) {
                $registrationState = 'no_class_group';
                $stateMessage = 'Kumpulan kelas untuk semester seterusnya belum ditetapkan oleh UPP. Sila hubungi pihak pentadbiran akademik.';
            } else {
                $sessionValues = ClassModel::query()
                    ->where('group_id', $nextClassGroup->group_id)
                    ->where('semester', $upcomingSemester)
                    ->whereIn('subject_id', $requiredSubjectIds)
                    ->whereHas('subject', fn ($query) => $query->where('status', 'active'))
                    ->whereNotNull('academic_session')
                    ->where('academic_session', '<>', '')
                    ->distinct()
                    ->orderBy('academic_session')
                    ->pluck('academic_session');

                if ($sessionValues->isEmpty()) {
                    $registrationState = 'missing_classes';
                    $stateMessage = 'Pendaftaran belum tersedia kerana kelas aktif bagi kumpulan kelas semester seterusnya anda belum disediakan.';
                } elseif ($sessionValues->count() > 1) {
                    $registrationState = 'ambiguous_session';
                    $stateMessage = 'Pendaftaran belum tersedia kerana terdapat lebih daripada satu sesi akademik bagi kelas kumpulan kelas semester seterusnya anda. Sila hubungi pihak pentadbiran akademik.';
                } else {
                    $academicSession = (string) $sessionValues->first();

                    $availableClasses = ClassModel::with('subject')
                        ->where('group_id', $nextClassGroup->group_id)
                        ->where('semester', $upcomingSemester)
                        ->where('academic_session', $academicSession)
                        ->whereIn('subject_id', $requiredSubjectIds)
                        ->whereHas('subject', fn ($query) => $query->where('status', 'active'))
                        ->orderBy('class_id')
                        ->get()
                        ->unique('subject_id')
                        ->values();

                    $availableSubjectIds = $availableClasses->pluck('subject_id')->unique();
                    $missingSubjectIds = $requiredSubjectIds->diff($availableSubjectIds)->values();
                    $classes = $availableClasses;

                    if ($missingSubjectIds->isNotEmpty()) {
                        $registrationState = 'missing_classes';
                        $stateMessage = 'Pendaftaran belum boleh diteruskan kerana satu atau lebih subjek wajib belum mempunyai kelas aktif untuk kumpulan kelas semester seterusnya anda bagi sesi akademik ini. Sila hubungi pihak pentadbiran akademik.';
                    }

                    $application = SubjectRegistrationApplication::with('registrations')
                        ->where('student_id', $student->student_id)
                        ->where('semester', $upcomingSemester)
                        ->where('academic_session', $academicSession)
                        ->latest('application_id')
                        ->first();

                    if ($application) {
                        $registrations = $application->registrations->keyBy('subject_id');

                        if (in_array($application->application_status, ['pending', 'approved'], true)) {
                            $registrationState = 'already_registered';
                            $stateMessage = $application->application_status === 'pending'
                                ? 'Permohonan pendaftaran subjek anda sedang menunggu kelulusan mentor.'
                                : 'Permohonan pendaftaran subjek anda telah diluluskan.';
                        } elseif ($application->application_status === 'rejected' && $registrationState === 'available') {
                            $stateMessage = 'Permohonan terdahulu ditolak. Anda boleh menyemak dan menghantar semula permohonan yang sama.';
                        }
                    }
                }
            }
        }

        return view('student.subject-registration', compact(
            'student', 'classes', 'upcomingSemester', 'registrations',
            'hasProgrammeStructure', 'registrationState', 'stateMessage',
            'requiredSubjectIds', 'missingSubjectIds', 'academicSession',
            'application', 'hasIndustrialTraining', 'industrialTrainingSemester',
            'missingAlternativeGroups', 'nextClassGroup'
        ));
    }

    public function store(Request $request)
    {
        $student = auth()->user()->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        if (empty($student->structure_id)) {
            return back()->with('error', 'Programme structure anda belum ditetapkan. Pendaftaran tidak dapat diteruskan.');
        }

        $upcomingSemester = (int) $student->semester + 1;
        $nextClassGroup = $this->resolveNextClassGroup($student, $upcomingSemester);

        if (!$nextClassGroup) {
            throw ValidationException::withMessages([
                'registration' => 'Sistem tidak dapat memadankan kumpulan kelas semester seterusnya secara automatik berdasarkan kumpulan semasa anda. Sila hubungi pihak pentadbiran akademik.',
            ]);
        }
        $requiredSubjectIds = DB::table('programme_structure_subjects')
            ->where('structure_id', $student->structure_id)
            ->where('semester', $upcomingSemester)
            ->whereNull('alternative_group_id')
            ->pluck('subject_id');

        $alternativeGroups = DB::table('alternative_subject_groups')
            ->where('structure_id', $student->structure_id)
            ->where('semester', $upcomingSemester)
            ->get();

        $studentChoices = DB::table('student_alternative_subject_choices')
            ->where('student_id', $student->student_id)
            ->whereIn('alternative_group_id', $alternativeGroups->pluck('alternative_group_id'))
            ->get()
            ->keyBy('alternative_group_id');

        $missingAlternativeGroups = $alternativeGroups->filter(
            fn ($group) => !$studentChoices->has($group->alternative_group_id)
        );

        if ($missingAlternativeGroups->isNotEmpty()) {
            throw ValidationException::withMessages([
                'registration' => 'UPP belum menetapkan semua subjek alternatif untuk anda. Pendaftaran belum boleh dihantar.',
            ]);
        }

        $requiredSubjectIds = $requiredSubjectIds
            ->concat($studentChoices->pluck('subject_id'))
            ->unique()
            ->values();

        if ($requiredSubjectIds->isEmpty()) {
            return back()->with('error', 'Tiada subjek wajib untuk semester seterusnya. Anda tidak boleh menghantar pendaftaran melalui halaman ini.');
        }

        // Academic session is inferred only from classes assigned to this student's ClassGroup.
        $sessionValues = ClassModel::query()
            ->where('group_id', $nextClassGroup->group_id)
            ->where('semester', $upcomingSemester)
            ->whereIn('subject_id', $requiredSubjectIds)
            ->whereHas('subject', fn ($query) => $query->where('status', 'active'))
            ->whereNotNull('academic_session')
            ->where('academic_session', '<>', '')
            ->distinct()
            ->orderBy('academic_session')
            ->pluck('academic_session');

        if ($sessionValues->isEmpty()) {
            throw ValidationException::withMessages([
                'registration' => 'Pendaftaran tidak dapat diteruskan kerana kelas aktif bagi kumpulan kelas semester seterusnya anda belum disediakan.',
            ]);
        }

        if ($sessionValues->count() > 1) {
            throw ValidationException::withMessages([
                'registration' => 'Pendaftaran tidak dapat diteruskan kerana terdapat lebih daripada satu sesi akademik bagi kelas kumpulan kelas semester seterusnya anda. Sila hubungi pihak pentadbiran akademik.',
            ]);
        }

        $academicSession = (string) $sessionValues->first();
        $classes = ClassModel::query()
            ->where('group_id', $nextClassGroup->group_id)
            ->where('semester', $upcomingSemester)
            ->where('academic_session', $academicSession)
            ->whereIn('subject_id', $requiredSubjectIds)
            ->whereHas('subject', fn ($query) => $query->where('status', 'active'))
            ->orderBy('class_id')
            ->get()
            ->unique('subject_id')
            ->values();

        $missingSubjectIds = $requiredSubjectIds->diff($classes->pluck('subject_id')->unique());
        if ($missingSubjectIds->isNotEmpty()) {
            throw ValidationException::withMessages([
                'registration' => 'Pendaftaran tidak dapat diteruskan kerana belum semua subjek wajib mempunyai kelas aktif untuk kumpulan kelas semester seterusnya anda bagi sesi akademik ini.',
            ]);
        }

        DB::transaction(function () use ($student, $upcomingSemester, $academicSession, $classes) {
            DB::table('students')
                ->where('student_id', $student->student_id)
                ->lockForUpdate()
                ->first();

            $application = SubjectRegistrationApplication::query()
                ->where('student_id', $student->student_id)
                ->where('semester', $upcomingSemester)
                ->where('academic_session', $academicSession)
                ->latest('application_id')
                ->lockForUpdate()
                ->first();

            if ($application && in_array($application->application_status, ['pending', 'approved'], true)) {
                throw ValidationException::withMessages([
                    'registration' => $application->application_status === 'pending'
                        ? 'Permohonan anda untuk semester dan sesi akademik ini masih menunggu kelulusan mentor.'
                        : 'Permohonan anda untuk semester dan sesi akademik ini telah diluluskan.',
                ]);
            }

            if (!$application) {
                $application = SubjectRegistrationApplication::create([
                    'student_id' => $student->student_id,
                    'semester' => $upcomingSemester,
                    'academic_session' => $academicSession,
                    'application_status' => 'pending',
                    'submitted_at' => now(),
                ]);
            } else {
                // Reuse the rejected application; preserve its rejection remarks for the student to review.
                $application->update([
                    'application_status' => 'pending',
                    'submitted_at' => now(),
                ]);
            }

            $existingRows = $application->registrations()->get()->keyBy('subject_id');

            foreach ($classes as $class) {
                $registration = $existingRows->get($class->subject_id);
                $attributes = [
                    'student_id' => $student->student_id,
                    'subject_id' => $class->subject_id,
                    'class_id' => $class->class_id,
                    'semester' => $upcomingSemester,
                    'registration_date' => now()->toDateString(),
                    'registration_status' => 'pending',
                ];

                if ($registration) {
                    $registration->update($attributes);
                } else {
                    $application->registrations()->create($attributes);
                }
            }
        });

        return redirect()->route('student.subject-registration')
            ->with('success', 'Permohonan bagi semua subjek wajib Semester ' . $upcomingSemester . ' telah dihantar untuk kelulusan mentor.');
    }

    /**
     * Match the student's current class section to the same section in the
     * upcoming semester. Example: "DCS 5A TEST" -> "DCS 6A".
     */
    private function resolveNextClassGroup($student, int $upcomingSemester): ?ClassGroup
    {
        if (empty($student->group_id) || empty($student->structure_id)) {
            return null;
        }

        $currentGroup = ClassGroup::query()
            ->where('group_id', $student->group_id)
            ->first();

        if (!$currentGroup) {
            return null;
        }

        $programmeId = DB::table('programme_structures')
            ->where('structure_id', $student->structure_id)
            ->value('programme_id');

        if (!$programmeId) {
            return null;
        }

        // Extract section letter after the semester number, ignoring suffixes
        // such as "TEST": "DCS 5A TEST" produces "A".
        if (!preg_match('/\b\d+\s*([A-Z])\b/i', (string) $currentGroup->group_name, $matches)) {
            return null;
        }

        $section = strtoupper($matches[1]);

        $matchingGroups = ClassGroup::query()
            ->where('programme_id', $programmeId)
            ->where('semester', $upcomingSemester)
            ->get()
            ->filter(function (ClassGroup $group) use ($section) {
                return preg_match(
                    '/\b\d+\s*' . preg_quote($section, '/') . '\b/i',
                    (string) $group->group_name
                ) === 1;
            })
            ->values();

        // Do not guess if there is no match or more than one match.
        return $matchingGroups->count() === 1 ? $matchingGroups->first() : null;
    }

}
