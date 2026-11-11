<?php

namespace Tests\Feature;

use App\Models\ClassModel;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\StudentMentorAssignment;
use App\Models\Subject;
use App\Models\SubjectRegistration;
use App\Models\SubjectRegistrationApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LecturerSubjectRegistrationReviewTest extends TestCase
{
    use RefreshDatabase;

    private function createApplicationScenario(string $lecturerId = 'LECT-REVIEW-001'): array
    {
        $lecturerUser = User::create([
            'username' => 'LECT-REVIEW-USER',
            'name' => 'Lecturer Reviewer',
            'email' => 'lecturer-review@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        Lecturer::create([
            'lecturer_id' => $lecturerId,
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Lecturer Reviewer',
            'department' => 'Computer Science',
            'email' => 'lecturer-review@example.com',
        ]);

        $studentUser = User::create([
            'username' => 'STUDENT-REVIEW-USER',
            'name' => 'Student Review',
            'email' => 'student-review@example.com',
            'password' => 'password',
            'role' => 'student',
            'status' => 'active',
        ]);

        $student = Student::create([
            'student_id' => 'STU-REVIEW-001',
            'user_id' => $studentUser->id,
            'student_name' => 'Student Review',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
        ]);

        StudentMentorAssignment::create([
            'student_id' => $student->student_id,
            'lecturer_id' => $lecturerId,
            'assigned_at' => now()->toDateString(),
            'ended_at' => null,
        ]);

        $application = SubjectRegistrationApplication::create([
            'student_id' => $student->student_id,
            'semester' => 6,
            'academic_session' => '2026/2027',
            'application_status' => 'pending',
            'submitted_at' => now(),
        ]);

        $registrations = collect();
        foreach ([['CSC2863', 'Cybersecurity Fundamentals'], ['CSC2913', 'Intelligent System']] as [$code, $name]) {
            $subject = Subject::create([
                'subject_code' => $code,
                'subject_name' => $name,
                'credit_hour' => 3,
                'semester' => 6,
                'status' => 'active',
            ]);

            $class = ClassModel::create([
                'subject_id' => $subject->subject_id,
                'lecturer_id' => $lecturerId,
                'class_name' => 'REVIEW-A',
                'semester' => 6,
                'academic_session' => '2026/2027',
            ]);

            $registrations->push(SubjectRegistration::create([
                'application_id' => $application->application_id,
                'student_id' => $student->student_id,
                'subject_id' => $subject->subject_id,
                'class_id' => $class->class_id,
                'semester' => 6,
                'registration_date' => now()->toDateString(),
                'registration_status' => 'pending',
            ]));
        }

        return [$lecturerUser, $application, $registrations];
    }

    public function test_lecturer_can_view_application_details_for_own_mentee(): void
    {
        [$lecturerUser, $application] = $this->createApplicationScenario();

        $this->actingAs($lecturerUser)
            ->get(route('lecturer.subject-registrations.show', $application->application_id))
            ->assertOk()
            ->assertSee('Butiran Permohonan Pendaftaran Subjek')
            ->assertSee('Cybersecurity Fundamentals')
            ->assertSee('Intelligent System');
    }

    public function test_lecturer_can_approve_entire_application_and_all_subject_rows(): void
    {
        [$lecturerUser, $application, $registrations] = $this->createApplicationScenario();

        $this->actingAs($lecturerUser)
            ->patch(route('lecturer.subject-registrations.update', $application->application_id), [
                'application_status' => 'approved',
            ])
            ->assertRedirect(route('lecturer.subject-registrations.show', $application->application_id))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('subject_registration_applications', [
            'application_id' => $application->application_id,
            'application_status' => 'approved',
            'reviewed_by' => 'LECT-REVIEW-001',
        ]);

        foreach ($registrations as $registration) {
            $this->assertDatabaseHas('subject_registrations', [
                'registration_id' => $registration->registration_id,
                'registration_status' => 'approved',
            ]);
        }
    }

    public function test_lecturer_must_provide_remarks_when_rejecting_application(): void
    {
        [$lecturerUser, $application, $registrations] = $this->createApplicationScenario();

        $this->actingAs($lecturerUser)
            ->from(route('lecturer.subject-registrations.show', $application->application_id))
            ->patch(route('lecturer.subject-registrations.update', $application->application_id), [
                'application_status' => 'rejected',
            ])
            ->assertSessionHasErrors('remarks');

        $this->assertDatabaseHas('subject_registration_applications', [
            'application_id' => $application->application_id,
            'application_status' => 'pending',
        ]);

        foreach ($registrations as $registration) {
            $this->assertDatabaseHas('subject_registrations', [
                'registration_id' => $registration->registration_id,
                'registration_status' => 'pending',
            ]);
        }
    }

    public function test_lecturer_can_reject_application_with_remarks_for_all_subject_rows(): void
    {
        [$lecturerUser, $application, $registrations] = $this->createApplicationScenario();

        $this->actingAs($lecturerUser)
            ->patch(route('lecturer.subject-registrations.update', $application->application_id), [
                'application_status' => 'rejected',
                'remarks' => 'Sila semak semula pemilihan kelas sebelum menghantar permohonan.',
            ])
            ->assertRedirect(route('lecturer.subject-registrations.show', $application->application_id));

        $this->assertDatabaseHas('subject_registration_applications', [
            'application_id' => $application->application_id,
            'application_status' => 'rejected',
            'remarks' => 'Sila semak semula pemilihan kelas sebelum menghantar permohonan.',
            'reviewed_by' => 'LECT-REVIEW-001',
        ]);

        foreach ($registrations as $registration) {
            $this->assertDatabaseHas('subject_registrations', [
                'registration_id' => $registration->registration_id,
                'registration_status' => 'rejected',
            ]);
        }
    }

    public function test_lecturer_cannot_view_another_lecturers_mentee_application(): void
    {
        [$lecturerUser, $application] = $this->createApplicationScenario('LECT-REVIEW-OWNER');

        $otherUser = User::create([
            'username' => 'OTHER-LECT-USER',
            'name' => 'Other Lecturer',
            'email' => 'other-lecturer@example.com',
            'password' => 'password',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        Lecturer::create([
            'lecturer_id' => 'LECT-REVIEW-OTHER',
            'user_id' => $otherUser->id,
            'lecturer_name' => 'Other Lecturer',
            'department' => 'Computer Science',
            'email' => 'other-lecturer@example.com',
        ]);

        $this->actingAs($otherUser)
            ->get(route('lecturer.subject-registrations.show', $application->application_id))
            ->assertNotFound();

        $this->actingAs($otherUser)
            ->patch(route('lecturer.subject-registrations.update', $application->application_id), [
                'application_status' => 'approved',
            ])
            ->assertNotFound();
    }
}
