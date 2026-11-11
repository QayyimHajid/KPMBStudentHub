<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\LecturerDirectory;
use App\Models\StudentMentorAssignment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class UppAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(string $role): User
    {
        static $counter = 0;
        $counter++;

        return User::create([
            'username' => 'TEST-' . strtoupper($role) . '-' . $counter,
            'name' => 'Test ' . strtoupper($role),
            'email' => strtolower($role) . $counter . '@example.com',
            'password' => 'password',
            'role' => $role,
            'status' => 'active',
        ]);
    }

    public function test_upp_can_access_dashboard(): void
    {
        $upp = $this->createUser('upp');

        $this->actingAs($upp)
            ->get(route('upp.dashboard'))
            ->assertOk();
    }

    public function test_student_cannot_access_upp_dashboard(): void
    {
        $student = $this->createUser('student');

        $this->actingAs($student)
            ->get(route('upp.dashboard'))
            ->assertForbidden();
    }

    public function test_lecturer_cannot_access_upp_dashboard(): void
    {
        $lecturer = $this->createUser('lecturer');

        $this->actingAs($lecturer)
            ->get(route('upp.dashboard'))
            ->assertForbidden();
    }

    public function test_upp_can_access_subject_registration_approval_page(): void
    {
        $upp = $this->createUser('upp');

        $this->actingAs($upp)
            ->get(route('upp.subject-registrations.index'))
            ->assertOk();
    }

    public function test_student_and_lecturer_cannot_access_upp_subject_registration_page(): void
    {
        $student = $this->createUser('student');
        $lecturer = $this->createUser('lecturer');

        $this->actingAs($student)
            ->get(route('upp.subject-registrations.index'))
            ->assertForbidden();

        $this->actingAs($lecturer)
            ->get(route('upp.subject-registrations.index'))
            ->assertForbidden();
    }

    public function test_upp_subject_registration_page_is_read_only(): void
    {
        $upp = $this->createUser('upp');

        $this->actingAs($upp)
            ->get(route('upp.subject-registrations.index'))
            ->assertOk();

        $this->assertFalse(
            Route::has('upp.subject-registrations.update'),
            'UPP should not have a route to approve or reject subject registrations.'
        );
    }


    private function createMentorTestStudent(string $studentId): Student
    {
        $studentUser = $this->createUser('student');

        return Student::create([
            'student_id' => $studentId,
            'user_id' => $studentUser->id,
            'student_name' => 'Test Student ' . $studentId,
            'programme' => 'DCS',
            'semester' => 1,
        ]);
    }

    public function test_upp_assigns_lecturer_and_directory_when_emails_match(): void
    {
        $upp = $this->createUser('upp');
        $student = $this->createMentorTestStudent('TEST-MENTOR-001');

        $lecturerUser = $this->createUser('lecturer');
        $lecturer = Lecturer::create([
            'lecturer_id' => 'TEST-LECT-001',
            'user_id' => $lecturerUser->id,
            'lecturer_name' => 'Test Lecturer',
            'department' => 'Computer Science',
            'email' => '  TEST.MENTOR@EXAMPLE.COM ',
        ]);

        $directory = LecturerDirectory::create([
            'lecturer_name' => 'Test Lecturer',
            'position' => 'Pensyarah',
            'department_code' => 'DCS',
            'department' => 'Computer Science',
            'email' => 'test.mentor@example.com',
        ]);

        $this->actingAs($upp)
            ->post(route('upp.students.assign-mentor', $student->student_id), [
                'lecturer_directory_id' => $directory->id,
            ])
            ->assertRedirect(route('upp.students.index'));

        $this->assertDatabaseHas('student_mentor_assignments', [
            'student_id' => $student->student_id,
            'lecturer_id' => $lecturer->lecturer_id,
            'lecturer_directory_id' => $directory->id,
            'ended_at' => null,
        ]);
    }

    public function test_upp_can_assign_directory_lecturer_without_matching_lecturer_record(): void
    {
        $upp = $this->createUser('upp');
        $student = $this->createMentorTestStudent('TEST-MENTOR-002');

        $directory = LecturerDirectory::create([
            'lecturer_name' => 'Directory Only Lecturer',
            'position' => 'Pensyarah',
            'department_code' => 'DCS',
            'department' => 'Computer Science',
            'email' => 'directory.only@example.com',
        ]);

        $this->actingAs($upp)
            ->post(route('upp.students.assign-mentor', $student->student_id), [
                'lecturer_directory_id' => $directory->id,
            ])
            ->assertRedirect(route('upp.students.index'));

        $this->assertDatabaseHas('student_mentor_assignments', [
            'student_id' => $student->student_id,
            'lecturer_id' => null,
            'lecturer_directory_id' => $directory->id,
            'ended_at' => null,
        ]);
    }

    public function test_assigning_new_mentor_ends_previous_active_assignment(): void
    {
        $upp = $this->createUser('upp');
        $student = $this->createMentorTestStudent('TEST-MENTOR-003');

        $oldDirectory = LecturerDirectory::create([
            'lecturer_name' => 'Old Mentor',
            'position' => 'Pensyarah',
            'department_code' => 'DCS',
            'department' => 'Computer Science',
            'email' => 'old.mentor@example.com',
        ]);

        $newDirectory = LecturerDirectory::create([
            'lecturer_name' => 'New Mentor',
            'position' => 'Pensyarah',
            'department_code' => 'DCS',
            'department' => 'Computer Science',
            'email' => 'new.mentor@example.com',
        ]);

        $oldAssignment = StudentMentorAssignment::create([
            'student_id' => $student->student_id,
            'lecturer_id' => null,
            'lecturer_directory_id' => $oldDirectory->id,
            'assigned_by' => $upp->id,
            'assigned_at' => now()->subDay()->toDateString(),
            'ended_at' => null,
        ]);

        $this->actingAs($upp)
            ->post(route('upp.students.assign-mentor', $student->student_id), [
                'lecturer_directory_id' => $newDirectory->id,
            ])
            ->assertRedirect(route('upp.students.index'));

        $this->assertDatabaseHas('student_mentor_assignments', [
            'assignment_id' => $oldAssignment->assignment_id,
            'ended_at' => now()->startOfDay()->toDateTimeString(),
        ]);

        $this->assertDatabaseHas('student_mentor_assignments', [
            'student_id' => $student->student_id,
            'lecturer_directory_id' => $newDirectory->id,
            'lecturer_id' => null,
            'ended_at' => null,
        ]);
    }

}
