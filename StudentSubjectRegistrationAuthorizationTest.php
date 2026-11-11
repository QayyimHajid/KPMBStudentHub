<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\ClassGroup;
use App\Models\SubjectRegistrationApplication;
use App\Models\Programme;
use App\Models\ProgrammeStructure;
use App\Models\ProgrammeStructureSubject;
use App\Models\SubjectRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentSubjectRegistrationAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private function createStudent(
        string $username,
        string $email,
        string $studentId,
        int $structureId
    ): array {
        $user = User::create([
            'username' => $username,
            'name' => $username,
            'email' => $email,
            'password' => 'password',
            'role' => 'student',
            'status' => 'active',
        ]);

        $structure = ProgrammeStructure::findOrFail($structureId);
        $classGroup = ClassGroup::create([
            'group_name' => 'DCS 6A',
            'programme_id' => $structure->programme_id,
            'semester' => 6,
            'academic_session' => '2026/2027',
        ]);

        $student = Student::create([
            'student_id' => $studentId,
            'user_id' => $user->id,
            'student_name' => $username,
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
            'structure_id' => $structureId,
            'group_id' => $classGroup->group_id,
        ]);

        return [$user, $student];
    }

    public function test_student_registration_uses_authenticated_students_identity(): void
    {
        $programme = Programme::create([
            'programme_code' => 'DCS',
            'programme_name' => 'Diploma in Computer Science',
            'status' => 'active',
        ]);

        $structure = ProgrammeStructure::create([
            'programme_id' => $programme->programme_id,
            'intake_code' => 'TEST-INTAKE',
            'version' => 1,
            'status' => 'published',
        ]);

        [$studentUser, $studentA] = $this->createStudent(
            'STUDENT-A',
            'student-a@example.com',
            'STU-TEST-A',
            $structure->structure_id
        );

        $nextClassGroup = ClassGroup::create([
            'group_name' => 'DCS 7A',
            'programme_id' => $programme->programme_id,
            'semester' => 7,
            'academic_session' => '2026/2027',
        ]);

        $subject = Subject::create([
            'subject_code' => 'CSC2863',
            'subject_name' => 'Cybersecurity Fundamentals',
            'credit_hour' => 3,
            'semester' => 6,
            'status' => 'active',
        ]);

        $lecturerUser = User::create([
            'username' => 'LECT-TEST',
            'name' => 'Test Lecturer',
            'email' => 'lecturer-test@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        \App\Models\Lecturer::create([
            'lecturer_id' => 'LECT-TEST-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Test Lecturer',
            'department' => 'Computer Science',
            'email' => 'lecturer-test@example.com',
        ]);

        $class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'LECT-TEST-001',
            'class_name' => 'TEST-A',
            'group_id' => $nextClassGroup->group_id,
            'semester' => 7,
            'academic_session' => '2026/2027',
        ]);

        ProgrammeStructureSubject::create([
            'structure_id' => $structure->structure_id,
            'subject_id' => $subject->subject_id,
            'semester' => 7,
        ]);

        // Attempt to submit another student's ID with a valid class ID.
        $response = $this->actingAs($studentUser)
            ->from(route('student.subject-registration'))
            ->post(route('student.subject-registration.store'), [
                'class_ids' => [$class->class_id],
                'student_id' => 'STU-TEST-B',
            ]);

        $response->assertRedirect();

        // The controller must use the authenticated student's identity.
        $this->assertDatabaseHas('subject_registrations', [
            'student_id' => $studentA->student_id,
            'class_id' => $class->class_id,
            'registration_status' => 'pending',
        ]);

        $this->assertDatabaseMissing('subject_registrations', [
            'student_id' => 'STU-TEST-B',
            'class_id' => $class->class_id,
        ]);
    }

    public function test_student_cannot_register_for_class_outside_own_curriculum(): void
    {
        $programmeA = Programme::create([
            'programme_code' => 'DCS-A',
            'programme_name' => 'Diploma in Computer Science A',
            'status' => 'active',
        ]);

        $programmeB = Programme::create([
            'programme_code' => 'DCS-B',
            'programme_name' => 'Diploma in Computer Science B',
            'status' => 'active',
        ]);

        $structureA = ProgrammeStructure::create([
            'programme_id' => $programmeA->programme_id,
            'intake_code' => 'INTAKE-A',
            'version' => 1,
            'status' => 'published',
        ]);

        $structureB = ProgrammeStructure::create([
            'programme_id' => $programmeB->programme_id,
            'intake_code' => 'INTAKE-B',
            'version' => 1,
            'status' => 'published',
        ]);

        [$studentUser] = $this->createStudent(
            'STUDENT-C',
            'student-c@example.com',
            'STU-TEST-C',
            $structureA->structure_id
        );

        $subject = Subject::create([
            'subject_code' => 'CSC9999',
            'subject_name' => 'Subject Outside Curriculum',
            'credit_hour' => 3,
            'semester' => 7,
            'status' => 'active',
        ]);

        $lecturerUser = User::create([
            'username' => 'LECT-OUTSIDE',
            'name' => 'Outside Test Lecturer',
            'email' => 'lecturer-outside@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        \App\Models\Lecturer::create([
            'lecturer_id' => 'LECT-OUTSIDE-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Outside Test Lecturer',
            'department' => 'Computer Science',
            'email' => 'lecturer-outside@example.com',
        ]);

        $class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'LECT-OUTSIDE-001',
            'class_name' => 'OUTSIDE-A',
            'group_id' => null,
            'semester' => 7,
            'academic_session' => '2026/2027',
        ]);

        // The subject belongs to Structure B, not Structure A.
        ProgrammeStructureSubject::create([
            'structure_id' => $structureB->structure_id,
            'subject_id' => $subject->subject_id,
            'semester' => 7,
        ]);

        $response = $this->actingAs($studentUser)
            ->post(route('student.subject-registration.store'), [
                'class_ids' => [$class->class_id],
            ]);

        $response->assertRedirect();

        $this->assertDatabaseMissing('subject_registrations', [
            'student_id' => 'STU-TEST-C',
            'class_id' => $class->class_id,
        ]);

        $this->assertSame(
            0,
            SubjectRegistration::where('student_id', 'STU-TEST-C')->count()
        );
    }

    public function test_rejected_application_can_be_resubmitted_using_same_application(): void
    {
        $programme = Programme::create([
            'programme_code' => 'DCS-REJ',
            'programme_name' => 'Diploma in Computer Science',
            'status' => 'active',
        ]);

        $structure = ProgrammeStructure::create([
            'programme_id' => $programme->programme_id,
            'intake_code' => 'INTAKE-REJ',
            'version' => 1,
            'status' => 'published',
        ]);

        [$studentUser, $student] = $this->createStudent(
            'STUDENT-REJ',
            'student-rej@example.com',
            'STU-TEST-REJ',
            $structure->structure_id
        );

        $nextClassGroup = ClassGroup::create([
            'group_name' => 'DCS 7A',
            'programme_id' => $programme->programme_id,
            'semester' => 7,
            'academic_session' => '2026/2027',
        ]);

        $subject = Subject::create([
            'subject_code' => 'CSC-REJ',
            'subject_name' => 'Rejected Registration Test',
            'credit_hour' => 3,
            'semester' => 7,
            'status' => 'active',
        ]);

        $lecturerUser = User::create([
            'username' => 'LECT-REJ',
            'name' => 'Rejected Test Lecturer',
            'email' => 'lecturer-rej@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        \App\Models\Lecturer::create([
            'lecturer_id' => 'LECT-REJ-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Rejected Test Lecturer',
            'department' => 'Computer Science',
            'email' => 'lecturer-rej@example.com',
        ]);

        $class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'LECT-REJ-001',
            'class_name' => 'REJECTED-CLASS',
            'group_id' => $nextClassGroup->group_id,
            'semester' => 7,
            'academic_session' => '2026/2027',
        ]);

        ProgrammeStructureSubject::create([
            'structure_id' => $structure->structure_id,
            'subject_id' => $subject->subject_id,
            'semester' => 7,
        ]);

        $application = SubjectRegistrationApplication::create([
            'student_id' => $student->student_id,
            'semester' => 7,
            'academic_session' => '2026/2027',
            'application_status' => 'rejected',
            'submitted_at' => now(),
            'remarks' => 'Sila semak semula permohonan.',
        ]);

        SubjectRegistration::create([
            'application_id' => $application->application_id,
            'student_id' => $student->student_id,
            'subject_id' => $subject->subject_id,
            'class_id' => $class->class_id,
            'semester' => 7,
            'registration_date' => now()->toDateString(),
            'registration_status' => 'rejected',
        ]);

        $initialCount = SubjectRegistration::count();

        $response = $this->actingAs($studentUser)
            ->post(route('student.subject-registration.store'), [
                'class_ids' => [$class->class_id],
            ]);

        $response->assertRedirect();
        $response->assertSessionHas(
            'success',
            'Permohonan bagi semua subjek wajib Semester 7 telah dihantar untuk kelulusan mentor.'
        );

        $this->assertSame($initialCount, SubjectRegistration::count());
        $this->assertDatabaseHas('subject_registration_applications', [
            'application_id' => $application->application_id,
            'application_status' => 'pending',
            'remarks' => 'Sila semak semula permohonan.',
        ]);

        $this->assertDatabaseHas('subject_registrations', [
            'application_id' => $application->application_id,
            'student_id' => $student->student_id,
            'class_id' => $class->class_id,
            'registration_status' => 'pending',
        ]);
    }

    public function test_registration_is_blocked_when_a_required_subject_has_no_active_class(): void
    {
        $programme = Programme::create([
            'programme_code' => 'DCS-MISSING',
            'programme_name' => 'Diploma in Computer Science',
            'status' => 'active',
        ]);

        $structure = ProgrammeStructure::create([
            'programme_id' => $programme->programme_id,
            'intake_code' => 'TEST-MISSING-CLASS',
            'version' => 1,
            'status' => 'published',
        ]);

        [$studentUser, $student] = $this->createStudent(
            'STUDENT-MISSING',
            'student-missing@example.com',
            'STU-MISSING',
            $structure->structure_id
        );

        // Create two required subjects for Semester 7.
        $subjectA = Subject::create([
            'subject_code' => 'CSC-MISS-A',
            'subject_name' => 'Available Required Subject',
            'credit_hour' => 3,
            'semester' => 7,
            'status' => 'active',
        ]);

        $subjectB = Subject::create([
            'subject_code' => 'CSC-MISS-B',
            'subject_name' => 'Missing Class Required Subject',
            'credit_hour' => 3,
            'semester' => 7,
            'status' => 'active',
        ]);

        ProgrammeStructureSubject::create([
            'structure_id' => $structure->structure_id,
            'subject_id' => $subjectA->subject_id,
            'semester' => 7,
        ]);

        ProgrammeStructureSubject::create([
            'structure_id' => $structure->structure_id,
            'subject_id' => $subjectB->subject_id,
            'semester' => 7,
        ]);

        // Create a lecturer and an active class for Subject A only.
        $lecturerUser = User::create([
            'username' => 'LECT-MISSING',
            'name' => 'Missing Class Test Lecturer',
            'email' => 'lecturer-missing@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        \App\Models\Lecturer::create([
            'lecturer_id' => 'LECT-MISSING-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Missing Class Test Lecturer',
            'department' => 'Computer Science',
            'email' => 'lecturer-missing@example.com',
        ]);

        ClassModel::create([
            'subject_id' => $subjectA->subject_id,
            'lecturer_id' => 'LECT-MISSING-001',
            'class_name' => 'MISSING-TEST-A',
            'group_id' => $student->group_id,
            'semester' => 7,
            'academic_session' => '2026/2027',
        ]);

        // Subject B is required but deliberately has no class record.

        $response = $this->actingAs($studentUser)
            ->from(route('student.subject-registration'))
            ->post(route('student.subject-registration.store'));

        $response->assertRedirect();
        $response->assertSessionHasErrors('registration');

        // No partial registration should be saved.
        $this->assertDatabaseMissing('subject_registrations', [
            'student_id' => $student->student_id,
            'subject_id' => $subjectA->subject_id,
        ]);

        $this->assertDatabaseMissing('subject_registrations', [
            'student_id' => $student->student_id,
            'subject_id' => $subjectB->subject_id,
        ]);

        $this->assertSame(0, SubjectRegistration::where(
            'student_id',
            $student->student_id
        )->count());
    }

    public function test_student_registration_page_displays_all_required_semester_six_subjects_and_correct_credits(): void
    {
        $programme = Programme::create([
            'programme_code' => 'DCS-TEST-CREDIT',
            'programme_name' => 'Diploma in Computer Science',
            'status' => 'active',
        ]);

        $structure = ProgrammeStructure::create([
            'programme_id' => $programme->programme_id,
            'intake_code' => 'TEST-SEM6-CREDIT',
            'version' => 1,
            'status' => 'published',
            'has_industrial_training' => false,
            'industrial_training_semester' => null,
        ]);

        [$studentUser, $student] = $this->createStudent(
            'STUDENT-SEM6-CREDIT',
            'student-sem6-credit@example.com',
            'STU-SEM6-CREDIT',
            $structure->structure_id
        );

        // Student is currently in Semester 5 and will register for Semester 6.
        $student->semester = 5;
        $student->save();

        // Keep the student's current class group in Semester 5.
        $currentClassGroup = ClassGroup::findOrFail($student->group_id);
        $currentClassGroup->update([
            'group_name' => 'DCS 5A',
            'semester' => 5,
        ]);

        // The registration classes belong to the matching Semester 6 group.
        $nextClassGroup = ClassGroup::create([
            'group_name' => 'DCS 6A',
            'programme_id' => $programme->programme_id,
            'semester' => 6,
            'academic_session' => '2 2026/2027',
        ]);

        $subjects = [
            [
                'code' => 'CSC2863',
                'name' => 'Cybersecurity Fundamentals',
                'credits' => 3,
            ],
            [
                'code' => 'CSC2854',
                'name' => 'Project',
                'credits' => 4,
            ],
            [
                'code' => 'CSC2913',
                'name' => 'Intelligent Systems',
                'credits' => 3,
            ],
            [
                'code' => 'MPU2482',
                'name' => 'Kemahiran dan Tanggungjawab Sosial',
                'credits' => 2,
            ],
        ];

        $lecturerUser = User::create([
            'username' => 'LECT-SEM6-CREDIT',
            'name' => 'Semester 6 Test Lecturer',
            'email' => 'lect-sem6-credit@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        \App\Models\Lecturer::create([
            'lecturer_id' => 'LECT-SEM6-CREDIT',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Semester 6 Test Lecturer',
            'department' => 'Computer Science',
            'email' => 'lect-sem6-credit@example.com',
        ]);

        foreach ($subjects as $item) {
            $subject = Subject::create([
                'subject_code' => $item['code'],
                'subject_name' => $item['name'],
                'credit_hour' => $item['credits'],
                'semester' => 6,
                'status' => 'active',
            ]);

            ProgrammeStructureSubject::create([
                'structure_id' => $structure->structure_id,
                'subject_id' => $subject->subject_id,
                'semester' => 6,
            ]);

            ClassModel::create([
                'subject_id' => $subject->subject_id,
                'lecturer_id' => 'LECT-SEM6-CREDIT',
                'class_name' => 'TEST-SEM6-' . $item['code'],
                'group_id' => $nextClassGroup->group_id,
                'semester' => 6,
                'academic_session' => '2 2026/2027',
            ]);
        }

        $response = $this->actingAs($studentUser)
            ->get(route('student.subject-registration'));

        $response->assertOk();

        $response->assertViewHas('upcomingSemester', 6);

        $response->assertViewHas('requiredSubjectIds', function ($subjectIds) {
            return $subjectIds->count() === 4;
        });

        $response->assertViewHas('classes', function ($classes) {
            return $classes->unique('subject_id')->count() === 4
                && $classes->unique('subject_id')->sum(
                    fn ($class) => (int) ($class->subject->credit_hour ?? 0)
                ) === 12;
        });
    }
}
