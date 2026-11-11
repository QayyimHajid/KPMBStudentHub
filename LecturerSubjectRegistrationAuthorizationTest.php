<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\SubjectRegistration;
use App\Models\SubjectRegistrationApplication;
use App\Models\StudentMentorAssignment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LecturerSubjectRegistrationAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_lecturer_cannot_reject_registration_of_another_lecturers_mentee(): void
    {
        // Create student account
        $studentUser = User::create([
            'username' => 'TEST-STUDENT',
            'name' => 'Test Student',
            'email' => 'student-test@example.com',
            'password' => 'password',
            'role' => 'student',
            'status' => 'active',
        ]);

        // Create two lecturer accounts
        $lecturerOneUser = User::create([
            'username' => 'LECT-1',
            'name' => 'Lecturer One',
            'email' => 'lecturer1-test@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        $lecturerTwoUser = User::create([
            'username' => 'LECT-2',
            'name' => 'Lecturer Two',
            'email' => 'lecturer2-test@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        // Create lecturer profiles
        Lecturer::create([
            'lecturer_id' => 'LECT-001',
            'user_id' => $lecturerOneUser->id,
            'lecturer_name' => 'Lecturer One',
            'department' => 'Computer Science',
            'email' => 'lecturer1-test@example.com',
        ]);

        Lecturer::create([
            'lecturer_id' => 'LECT-002',
            'user_id' => $lecturerTwoUser->id,
            'lecturer_name' => 'Lecturer Two',
            'department' => 'Computer Science',
            'email' => 'lecturer2-test@example.com',
        ]);

        // Create student profile
        $student = Student::create([
            'student_id' => 'STU-TEST-001',
            'user_id' => $studentUser->id,
            'student_name' => 'Test Student',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
        ]);

        // Create subject and class
        $subject = Subject::create([
            'subject_code' => 'CSC2863',
            'subject_name' => 'Cybersecurity Fundamentals',
            'credit_hour' => 3,
            'semester' => 6,
            'status' => 'active',
        ]);

        $class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'LECT-001',
            'class_name' => 'TEST-A',
            'semester' => 6,
            'academic_session' => '2026/2027',
        ]);

        // Assign the student to Lecturer One only
        StudentMentorAssignment::create([
            'student_id' => $student->student_id,
            'lecturer_id' => 'LECT-001',
            'assigned_at' => now()->toDateString(),
            'ended_at' => null,
        ]);

        // Create a pending subject registration
        $application = SubjectRegistrationApplication::create([
            'student_id' => $student->student_id,
            'semester' => 6,
            'academic_session' => '2026/2027',
            'application_status' => 'pending',
            'submitted_at' => now(),
        ]);

        $registration = SubjectRegistration::create([
            'application_id' => $application->application_id,
            'student_id' => $student->student_id,
            'subject_id' => $subject->subject_id,
            'class_id' => $class->class_id,
            'semester' => 6,
            'registration_date' => now()->toDateString(),
            'registration_status' => 'pending',
        ]);

        // Lecturer Two attempts to reject the registration
        $response = $this->actingAs($lecturerTwoUser)
            ->patch(
                route(
                    'lecturer.subject-registrations.update',
                    $application->application_id
                ),
                [
                    'application_status' => 'rejected',
                    'remarks' => 'Tidak layak untuk permohonan ini.',
                ]
            );

        // The request must be denied because the student is not Lecturer Two's mentee
        $response->assertNotFound();

        // Confirm the registration remains unchanged
        $this->assertDatabaseHas('subject_registrations', [
            'registration_id' => $registration->registration_id,
            'registration_status' => 'pending',
        ]);
    }

    public function test_lecturer_can_approve_registration_of_own_mentee(): void
    {
        // Create student account
        $studentUser = User::create([
            'username' => 'TEST-STUDENT-2',
            'name' => 'Test Student Two',
            'email' => 'student-test-2@example.com',
            'password' => 'password',
            'role' => 'student',
            'status' => 'active',
        ]);

        // Create lecturer account
        $lecturerUser = User::create([
            'username' => 'LECT-APPROVE',
            'name' => 'Lecturer Approver',
            'email' => 'lecturer-approve@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        // Create lecturer profile
        Lecturer::create([
            'lecturer_id' => 'LECT-APPROVE-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Lecturer Approver',
            'department' => 'Computer Science',
            'email' => 'lecturer-approve@example.com',
        ]);

        // Create student profile
        $student = Student::create([
            'student_id' => 'STU-APPROVE-001',
            'user_id' => $studentUser->id,
            'student_name' => 'Test Student Two',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
        ]);

        // Create subject
        $subject = Subject::create([
            'subject_code' => 'CSC2863',
            'subject_name' => 'Cybersecurity Fundamentals',
            'credit_hour' => 3,
            'semester' => 6,
            'status' => 'active',
        ]);

        // Create class
        $class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'LECT-APPROVE-001',
            'class_name' => 'APPROVE-A',
            'semester' => 6,
            'academic_session' => '2026/2027',
        ]);

        // Assign student to this lecturer
        StudentMentorAssignment::create([
            'student_id' => $student->student_id,
            'lecturer_id' => 'LECT-APPROVE-001',
            'assigned_at' => now()->toDateString(),
            'ended_at' => null,
        ]);

        // Create pending registration
        $application = SubjectRegistrationApplication::create([
            'student_id' => $student->student_id,
            'semester' => 6,
            'academic_session' => '2026/2027',
            'application_status' => 'pending',
            'submitted_at' => now(),
        ]);

        $registration = SubjectRegistration::create([
            'application_id' => $application->application_id,
            'student_id' => $student->student_id,
            'subject_id' => $subject->subject_id,
            'class_id' => $class->class_id,
            'semester' => 6,
            'registration_date' => now()->toDateString(),
            'registration_status' => 'pending',
        ]);

        // Lecturer approves their own mentee's registration
        $response = $this->actingAs($lecturerUser)
            ->from(route('lecturer.subject-registrations.index'))
            ->patch(
                route(
                    'lecturer.subject-registrations.update',
                    $application->application_id
                ),
                [
                    'application_status' => 'approved',
                ]
            );

        // Confirm successful processing
        $response->assertRedirect(
            route('lecturer.subject-registrations.show', $application->application_id)
        );

        $response->assertSessionHas(
            'success',
            'Permohonan pendaftaran subjek berjaya diluluskan.'
        );

        // Confirm registration status has changed
        $this->assertDatabaseHas('subject_registrations', [
            'registration_id' => $registration->registration_id,
            'registration_status' => 'approved',
        ]);
    }

    public function test_lecturer_cannot_submit_invalid_registration_status(): void
    {
        // Create student account
        $studentUser = User::create([
            'username' => 'TEST-STUDENT-3',
            'name' => 'Test Student Three',
            'email' => 'student-test-3@example.com',
            'password' => 'password',
            'role' => 'student',
            'status' => 'active',
        ]);

        // Create lecturer account
        $lecturerUser = User::create([
            'username' => 'LECT-INVALID',
            'name' => 'Lecturer Invalid Status',
            'email' => 'lecturer-invalid@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        // Create lecturer profile
        Lecturer::create([
            'lecturer_id' => 'LECT-INVALID-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Lecturer Invalid Status',
            'department' => 'Computer Science',
            'email' => 'lecturer-invalid@example.com',
        ]);

        // Create student profile
        $student = Student::create([
            'student_id' => 'STU-INVALID-001',
            'user_id' => $studentUser->id,
            'student_name' => 'Test Student Three',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
        ]);

        // Create subject
        $subject = Subject::create([
            'subject_code' => 'CSC2913',
            'subject_name' => 'Intelligent Systems',
            'credit_hour' => 3,
            'semester' => 6,
            'status' => 'active',
        ]);

        // Create class
        $class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'LECT-INVALID-001',
            'class_name' => 'INVALID-A',
            'semester' => 6,
            'academic_session' => '2026/2027',
        ]);

        // Assign student to this lecturer
        StudentMentorAssignment::create([
            'student_id' => $student->student_id,
            'lecturer_id' => 'LECT-INVALID-001',
            'assigned_at' => now()->toDateString(),
            'ended_at' => null,
        ]);

        // Create pending registration
        $application = SubjectRegistrationApplication::create([
            'student_id' => $student->student_id,
            'semester' => 6,
            'academic_session' => '2026/2027',
            'application_status' => 'pending',
            'submitted_at' => now(),
        ]);

        $registration = SubjectRegistration::create([
            'application_id' => $application->application_id,
            'student_id' => $student->student_id,
            'subject_id' => $subject->subject_id,
            'class_id' => $class->class_id,
            'semester' => 6,
            'registration_date' => now()->toDateString(),
            'registration_status' => 'pending',
        ]);

        // Submit an invalid registration status
        $response = $this->actingAs($lecturerUser)
            ->from(route('lecturer.subject-registrations.index'))
            ->patch(
                route(
                    'lecturer.subject-registrations.update',
                    $application->application_id
                ),
                [
                    'application_status' => 'admin_approved',
                ]
            );

        // Confirm validation error
        $response->assertRedirect(
            route('lecturer.subject-registrations.index')
        );

        $response->assertSessionHasErrors('application_status');

        // Confirm registration remains pending
        $this->assertDatabaseHas('subject_registrations', [
            'registration_id' => $registration->registration_id,
            'registration_status' => 'pending',
        ]);
    }
    
    public function test_lecturer_cannot_change_rejected_registration_to_approved(): void
    {
        $studentUser = User::create([
            'username' => 'STUDENT-REJECTED',
            'name' => 'Rejected Test Student',
            'email' => 'student-rejected@example.com',
            'password' => 'password',
            'role' => 'student',
            'status' => 'active',
        ]);

        $lecturerUser = User::create([
            'username' => 'LECT-REJECTED',
            'name' => 'Rejected Test Lecturer',
            'email' => 'lecturer-rejected@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        Lecturer::create([
            'lecturer_id' => 'LECT-REJECTED-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Rejected Test Lecturer',
            'department' => 'Computer Science',
            'email' => 'lecturer-rejected@example.com',
        ]);

        $student = Student::create([
            'student_id' => 'STU-REJECTED-001',
            'user_id' => $studentUser->id,
            'student_name' => 'Rejected Test Student',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
        ]);

        $subject = Subject::create([
            'subject_code' => 'CSC-REJECTED',
            'subject_name' => 'Rejected Registration Test',
            'credit_hour' => 3,
            'semester' => 6,
            'status' => 'active',
        ]);

        $class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'LECT-REJECTED-001',
            'class_name' => 'REJECTED-TEST',
            'semester' => 6,
            'academic_session' => '2026/2027',
        ]);

        StudentMentorAssignment::create([
            'student_id' => $student->student_id,
            'lecturer_id' => 'LECT-REJECTED-001',
            'assigned_at' => now()->toDateString(),
            'ended_at' => null,
        ]);

        $application = SubjectRegistrationApplication::create([
            'student_id' => $student->student_id,
            'semester' => 6,
            'academic_session' => '2026/2027',
            'application_status' => 'rejected',
            'submitted_at' => now(),
        ]);

        $registration = SubjectRegistration::create([
            'application_id' => $application->application_id,
            'student_id' => $student->student_id,
            'subject_id' => $subject->subject_id,
            'class_id' => $class->class_id,
            'semester' => 6,
            'registration_date' => now()->toDateString(),
            'registration_status' => 'rejected',
        ]);

        $response = $this->actingAs($lecturerUser)
            ->from(route('lecturer.subject-registrations.index'))
            ->patch(
                route(
                    'lecturer.subject-registrations.update',
                    $application->application_id
                ),
                [
                    'application_status' => 'approved',
                ]
            );

        $response->assertRedirect(
            route('lecturer.subject-registrations.index')
        );

        $response->assertSessionHas(
            'error',
            'Permohonan ini telah diproses sebelum ini.'
        );

        $this->assertDatabaseHas('subject_registrations', [
            'registration_id' => $registration->registration_id,
            'registration_status' => 'rejected',
        ]);

        $this->assertDatabaseHas('subject_registration_applications', [
            'application_id' => $application->application_id,
            'application_status' => 'rejected',
        ]);
    }

    public function test_lecturer_cannot_process_registration_after_mentor_assignment_has_ended(): void
    {
        $lecturerUser = User::create([
            'username' => 'LECT-ENDED',
            'name' => 'Lecturer Ended',
            'email' => 'lecturer-ended@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        Lecturer::create([
            'lecturer_id' => 'LECT-ENDED-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Lecturer Ended',
            'department' => 'Computer Science',
            'email' => 'lecturer-ended@example.com',
        ]);

        $studentUser = User::create([
            'username' => 'STU-ENDED',
            'name' => 'Student Ended',
            'email' => 'student-ended@example.com',
            'password' => 'password',
            'role' => 'student',
            'status' => 'active',
        ]);

        $student = Student::create([
            'student_id' => 'STU-ENDED-001',
            'user_id' => $studentUser->id,
            'student_name' => 'Student Ended',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
        ]);

        $subject = Subject::create([
            'subject_code' => 'CSC-ENDED',
            'subject_name' => 'Ended Assignment Test',
            'credit_hour' => 3,
            'semester' => 6,
            'status' => 'active',
        ]);

        $class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'LECT-ENDED-001',
            'class_name' => 'ENDED-A',
            'semester' => 6,
            'academic_session' => '2026/2027',
        ]);

        StudentMentorAssignment::create([
            'student_id' => $student->student_id,
            'lecturer_id' => 'LECT-ENDED-001',
            'assigned_at' => now()->subDays(30)->toDateString(),
            'ended_at' => now()->subDay()->toDateString(),
        ]);

        $application = SubjectRegistrationApplication::create([
            'student_id' => $student->student_id,
            'semester' => 6,
            'academic_session' => '2026/2027',
            'application_status' => 'pending',
            'submitted_at' => now(),
        ]);

        $registration = SubjectRegistration::create([
            'application_id' => $application->application_id,
            'student_id' => $student->student_id,
            'subject_id' => $subject->subject_id,
            'class_id' => $class->class_id,
            'semester' => 6,
            'registration_date' => now()->toDateString(),
            'registration_status' => 'pending',
        ]);

        $response = $this->actingAs($lecturerUser)->patch(
            route(
                'lecturer.subject-registrations.update',
                $application->application_id
            ),
            ['application_status' => 'approved']
        );

        $response->assertNotFound();

        $this->assertDatabaseHas('subject_registrations', [
            'registration_id' => $registration->registration_id,
            'registration_status' => 'pending',
        ]);
    }

    public function test_lecturer_subject_registration_list_only_shows_active_mentees(): void
    {
        $lecturerUser = User::create([
            'username' => 'LECT-LIST',
            'name' => 'Lecturer List',
            'email' => 'lecturer-list@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        Lecturer::create([
            'lecturer_id' => 'LECT-LIST-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Lecturer List',
            'department' => 'Computer Science',
            'email' => 'lecturer-list@example.com',
        ]);

        $subject = Subject::create([
            'subject_code' => 'CSC-LIST',
            'subject_name' => 'Active Mentee List Test',
            'credit_hour' => 3,
            'semester' => 6,
            'status' => 'active',
        ]);

        $class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'LECT-LIST-001',
            'class_name' => 'LIST-A',
            'semester' => 6,
            'academic_session' => '2026/2027',
        ]);

        $activeUser = User::create([
            'username' => 'STU-ACTIVE',
            'name' => 'Active Mentee',
            'email' => 'student-active@example.com',
            'password' => 'password',
            'role' => 'student',
            'status' => 'active',
        ]);

        $activeStudent = Student::create([
            'student_id' => 'STU-ACTIVE-001',
            'user_id' => $activeUser->id,
            'student_name' => 'Active Mentee',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
        ]);

        StudentMentorAssignment::create([
            'student_id' => $activeStudent->student_id,
            'lecturer_id' => 'LECT-LIST-001',
            'assigned_at' => now()->toDateString(),
            'ended_at' => null,
        ]);

        $endedUser = User::create([
            'username' => 'STU-OLD',
            'name' => 'Former Mentee',
            'email' => 'student-former@example.com',
            'password' => 'password',
            'role' => 'student',
            'status' => 'active',
        ]);

        $endedStudent = Student::create([
            'student_id' => 'STU-FORMER-001',
            'user_id' => $endedUser->id,
            'student_name' => 'Former Mentee',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
        ]);

        StudentMentorAssignment::create([
            'student_id' => $endedStudent->student_id,
            'lecturer_id' => 'LECT-LIST-001',
            'assigned_at' => now()->subDays(30)->toDateString(),
            'ended_at' => now()->subDay()->toDateString(),
        ]);

        foreach ([$activeStudent, $endedStudent] as $student) {
            $application = SubjectRegistrationApplication::create([
                'student_id' => $student->student_id,
                'semester' => 6,
                'academic_session' => '2026/2027',
                'application_status' => 'pending',
                'submitted_at' => now(),
            ]);

            SubjectRegistration::create([
                'application_id' => $application->application_id,
                'student_id' => $student->student_id,
                'subject_id' => $subject->subject_id,
                'class_id' => $class->class_id,
                'semester' => 6,
                'registration_date' => now()->toDateString(),
                'registration_status' => 'pending',
            ]);
        }

        $response = $this->actingAs($lecturerUser)->get(
            route('lecturer.subject-registrations.index')
        );

        $response->assertOk();
        $response->assertSee('Active Mentee');
        $response->assertDontSee('Former Mentee');
    }

}
