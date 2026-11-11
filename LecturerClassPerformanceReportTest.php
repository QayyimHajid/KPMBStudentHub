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

class LecturerClassPerformanceReportTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Lecturer $lecturer;
    private Student $student;
    private Subject $subject;
    private ClassModel $class;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'username' => 'reportlecturer',
            'name' => 'Report Lecturer',
            'email' => 'reportlecturer@example.com',
            'password' => 'password123',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        $this->lecturer = Lecturer::create([
            'lecturer_id' => 'REPORT-LECT-001',
            'user_id' => $this->user->id,
            'lecturer_name' => 'Report Lecturer',
            'department' => 'Computer Science',
            'email' => 'reportlecturer@example.com',
            'phone_number' => '0123456789',
        ]);

        $studentUser = User::create([
            'username' => 'reportstudent',
            'name' => 'Report Student',
            'email' => 'reportstudent@example.com',
            'password' => 'password123',
            'role' => 'student',
            'status' => 'active',
        ]);

        $this->student = Student::create([
            'student_id' => 'REPORT-STU-001',
            'user_id' => $studentUser->id,
            'student_name' => 'Report Student',
            'programme' => 'Diploma in Computer Science',
            'semester' => 4,
            'phone_number' => '0123456788',
            'email' => 'reportstudent@example.com',
        ]);

        $this->subject = Subject::create([
            'subject_code' => 'RPT1001',
            'subject_name' => 'Report Test Subject',
            'credit_hour' => 3,
            'semester' => 4,
            'status' => 'active',
        ]);

        $this->class = ClassModel::create([
            'subject_id' => $this->subject->subject_id,
            'lecturer_id' => $this->lecturer->lecturer_id,
            'class_name' => 'Report Test Class',
            'semester' => 4,
            'academic_session' => '2 2026/2027',
        ]);

        SubjectRegistration::create([
            'student_id' => $this->student->student_id,
            'subject_id' => $this->subject->subject_id,
            'class_id' => $this->class->class_id,
            'semester' => 4,
            'registration_date' => now()->toDateString(),
            'registration_status' => 'approved',
        ]);

        $this->actingAs($this->user);
    }

    private function createMark(float $mark): StudentMark
    {
        return StudentMark::create([
            'student_id' => $this->student->student_id,
            'subject_id' => $this->subject->subject_id,
            'class_id' => $this->class->class_id,
            'lecturer_id' => $this->lecturer->lecturer_id,
            'marks' => $mark,
            'academic_session' => $this->class->academic_session,
        ]);
    }

    public function test_lecturer_can_view_assigned_classes(): void
    {
        $response = $this->get(
            route('lecturer.performance-report.index')
        );

        $response->assertOk();
        $response->assertViewHas('classes');
    }

    public function test_lecturer_cannot_view_another_lecturers_report(): void
    {
        $otherUser = User::create([
            'username' => 'otherreportlecturer',
            'name' => 'Other Report Lecturer',
            'email' => 'otherreportlecturer@example.com',
            'password' => 'password123',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        $otherLecturer = Lecturer::create([
            'lecturer_id' => 'REPORT-LECT-002',
            'user_id' => $otherUser->id,
            'lecturer_name' => 'Other Report Lecturer',
            'department' => 'Computer Science',
            'email' => 'otherreportlecturer@example.com',
            'phone_number' => '0123456787',
        ]);

        $otherClass = ClassModel::create([
            'subject_id' => $this->subject->subject_id,
            'lecturer_id' => $otherLecturer->lecturer_id,
            'class_name' => 'Other Report Class',
            'semester' => 4,
            'academic_session' => '2 2026/2027',
        ]);

        $response = $this->get(
            route(
                'lecturer.performance-report.show',
                $otherClass->class_id
            )
        );

        $response->assertNotFound();
    }

    public function test_report_calculates_grade_correctly(): void
    {
        $this->createMark(85);

        $response = $this->get(
            route(
                'lecturer.performance-report.show',
                $this->class->class_id
            )
        );

        $response->assertOk();

        $response->assertViewHas('reportStudents', function ($students) {
            $student = $students->first();

            return $student['grade'] === 'A'
                && $student['grade_points'] === 4.0
                && $student['grade_index'] === 'Excellent';
        });
    }

    public function test_report_calculates_class_statistics(): void
    {
        $this->createMark(85);

        $response = $this->get(
            route(
                'lecturer.performance-report.show',
                $this->class->class_id
            )
        );

        $response->assertOk();

        $response->assertViewHas('summary', function ($summary) {
            return $summary['total_students'] === 1
                && $summary['recorded_count'] === 1
                && $summary['not_recorded_count'] === 0
                && $summary['average'] === 85.0
                && $summary['highest'] === 85.0
                && $summary['lowest'] === 85.0;
        });
    }

    public function test_student_without_marks_is_not_counted_as_zero(): void
    {
        $response = $this->get(
            route(
                'lecturer.performance-report.show',
                $this->class->class_id
            )
        );

        $response->assertOk();

        $response->assertViewHas('reportStudents', function ($students) {
            $student = $students->first();

            return $students->count() === 1
                && $student['marks'] === null
                && $student['grade'] === null;
        });

        $response->assertViewHas('summary', function ($summary) {
            return $summary['total_students'] === 1
                && $summary['recorded_count'] === 0
                && $summary['not_recorded_count'] === 1
                && $summary['average'] === null
                && $summary['highest'] === null
                && $summary['lowest'] === null;
        });
    }
}
