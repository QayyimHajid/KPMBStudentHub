<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\SubjectRegistration;
use App\Models\StudentMark;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LecturerRecordStudentMarksTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Lecturer $lecturer;
    private Student $student;
    private ClassModel $class;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'username' => 'testlecturer',
            'name' => 'Test Lecturer',
            'email' => 'testlecturer@example.com',
            'password' => 'password123',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        $this->lecturer = Lecturer::create([
            'lecturer_id' => 'TEST-LECT-001',
            'user_id' => $this->user->id,
            'lecturer_name' => 'Test Lecturer',
            'department' => 'Computer Science',
            'email' => 'testlecturer@example.com',
            'phone_number' => '0123456789',
        ]);

        $studentUser = User::create([
            'username' => 'teststudent',
            'name' => 'Test Student',
            'email' => 'teststudent@example.com',
            'password' => 'password123',
            'role' => 'student',
            'status' => 'active',
        ]);

        $this->student = Student::create([
            'student_id' => 'TEST-STU-001',
            'user_id' => $studentUser->id,
            'student_name' => 'Test Student',
            'programme' => 'Diploma in Computer Science',
            'semester' => 4,
            'phone_number' => '0123456788',
            'email' => 'teststudent@example.com',
        ]);

        $subject = Subject::create([
            'subject_code' => 'TEST1001',
            'subject_name' => 'Test Subject',
            'credit_hour' => 3,
            'semester' => 4,
            'status' => 'active',
        ]);

        $this->class = ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => $this->lecturer->lecturer_id,
            'class_name' => 'Test Class',
            'semester' => 4,
            'academic_session' => '2 2026/2027',
        ]);

        SubjectRegistration::create([
            'student_id' => $this->student->student_id,
            'subject_id' => $subject->subject_id,
            'class_id' => $this->class->class_id,
            'semester' => 4,
            'registration_date' => now()->toDateString(),
            'registration_status' => 'approved',
        ]);

        $this->actingAs($this->user);
    }

    public function test_marks_below_zero_are_rejected(): void
    {
        $response = $this->post(
            route('lecturer.record-marks.store', $this->class->class_id),
            [
                'marks' => [
                    $this->student->student_id => -5,
                ],
            ]
        );

        $response->assertSessionHasErrors([
            'marks.' . $this->student->student_id,
        ]);

        $this->assertDatabaseCount('student_marks', 0);
    }

    public function test_marks_above_100_are_rejected(): void
    {
        $response = $this->post(
            route('lecturer.record-marks.store', $this->class->class_id),
            [
                'marks' => [
                    $this->student->student_id => 105,
                ],
            ]
        );

        $response->assertSessionHasErrors([
            'marks.' . $this->student->student_id,
        ]);

        $this->assertDatabaseCount('student_marks', 0);
    }

    public function test_valid_marks_are_saved(): void
    {
        $response = $this->post(
            route('lecturer.record-marks.store', $this->class->class_id),
            [
                'marks' => [
                    $this->student->student_id => 85.50,
                ],
            ]
        );

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('student_marks', [
            'student_id' => $this->student->student_id,
            'subject_id' => $this->class->subject_id,
            'class_id' => $this->class->class_id,
            'lecturer_id' => $this->lecturer->lecturer_id,
            'marks' => 85.50,
            'academic_session' => $this->class->academic_session,
        ]);
    }

    
    public function test_lecturer_cannot_record_marks_for_another_lecturers_class(): void
    {
        $otherUser = User::create([
            'username' => 'otherlecturer',
            'name' => 'Other Lecturer',
            'email' => 'otherlecturer@example.com',
            'password' => 'password123',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        $otherLecturer = Lecturer::create([
            'lecturer_id' => 'TEST-LECT-002',
            'user_id' => $otherUser->id,
            'lecturer_name' => 'Other Lecturer',
            'department' => 'Computer Science',
            'email' => 'otherlecturer@example.com',
            'phone_number' => '0123456787',
        ]);

        $otherClass = ClassModel::create([
            'subject_id' => $this->class->subject_id,
            'lecturer_id' => $otherLecturer->lecturer_id,
            'class_name' => 'Other Class',
            'semester' => 4,
            'academic_session' => '2 2026/2027',
        ]);

        $response = $this->post(
            route('lecturer.record-marks.store', $otherClass->class_id),
            [
                'marks' => [
                    $this->student->student_id => 85,
                ],
            ]
        );

        $response->assertNotFound();

        $this->assertDatabaseCount('student_marks', 0);
    }

    public function test_existing_marks_are_updated_instead_of_creating_duplicates(): void
    {
        $this->post(
            route('lecturer.record-marks.store', $this->class->class_id),
            [
                'marks' => [
                    $this->student->student_id => 70,
                ],
            ]
        )->assertSessionHasNoErrors();

        $this->post(
            route('lecturer.record-marks.store', $this->class->class_id),
            [
                'marks' => [
                    $this->student->student_id => 85,
                ],
            ]
        )->assertSessionHasNoErrors();

        $this->assertDatabaseCount('student_marks', 1);

        $this->assertDatabaseHas('student_marks', [
            'student_id' => $this->student->student_id,
            'subject_id' => $this->class->subject_id,
            'class_id' => $this->class->class_id,
            'lecturer_id' => $this->lecturer->lecturer_id,
            'marks' => 85,
            'academic_session' => $this->class->academic_session,
        ]);
    }

}

