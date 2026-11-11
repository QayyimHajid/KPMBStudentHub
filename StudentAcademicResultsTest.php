<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\AssessmentMark;
use App\Models\AssessmentScheme;
use App\Models\ClassModel;
use App\Models\Student;
use App\Models\StudentMark;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentAcademicResultsTest extends TestCase
{
    use RefreshDatabase;

    private User $studentUser;
    private Student $student;
    private User $otherStudentUser;
    private Student $otherStudent;
    private User $lecturerUser;
    private string $session = '2 2026/2027';

    protected function setUp(): void
    {
        parent::setUp();

        $this->studentUser = $this->createUser('resultstudent', 'resultstudent@example.com', 'student');
        $this->student = $this->createStudent(
            'RESULT-STU-001',
            $this->studentUser,
            'Result Student'
        );

        $this->otherStudentUser = $this->createUser('otherresultstudent', 'otherresultstudent@example.com', 'student');
        $this->otherStudent = $this->createStudent(
            'RESULT-STU-002',
            $this->otherStudentUser,
            'Other Result Student'
        );

        $this->lecturerUser = $this->createUser('resultlecturer', 'resultlecturer@example.com', 'lecturer');
        \App\Models\Lecturer::create([
            'lecturer_id' => 'RESULT-LECT-001',
            'user_id' => $this->lecturerUser->id,
            'lecturer_name' => 'Result Lecturer',
            'department' => 'Computer Science',
            'email' => 'resultlecturer@example.com',
            'phone_number' => '0123456789',
        ]);
    }

    private function createUser(string $username, string $email, string $role): User
    {
        return User::create([
            'username' => $username,
            'name' => $username,
            'email' => $email,
            'password' => 'password123',
            'role' => $role,
            'status' => 'active',
        ]);
    }

    private function createStudent(string $studentId, User $user, string $name): Student
    {
        return Student::create([
            'student_id' => $studentId,
            'user_id' => $user->id,
            'student_name' => $name,
            'programme' => 'Diploma in Computer Science',
            'semester' => 4,
            'phone_number' => '0123456788',
            'email' => $user->email,
        ]);
    }

    private function createClassWithSubject(
        string $code,
        int $semester = 4,
        string $session = '2 2026/2027',
        int $creditHours = 3
    ): ClassModel {
        $subject = Subject::create([
            'subject_code' => $code,
            'subject_name' => 'Subject '.$code,
            'credit_hour' => $creditHours,
            'semester' => $semester,
            'status' => 'active',
        ]);

        return ClassModel::create([
            'subject_id' => $subject->subject_id,
            'lecturer_id' => 'RESULT-LECT-001',
            'class_name' => 'Class '.$code,
            'semester' => $semester,
            'academic_session' => $session,
        ]);
    }

    private function createLegacyMark(
        Student $student,
        ClassModel $class,
        float $marks
    ): StudentMark {
        return StudentMark::create([
            'student_id' => $student->student_id,
            'subject_id' => $class->subject_id,
            'class_id' => $class->class_id,
            'lecturer_id' => 'RESULT-LECT-001',
            'marks' => $marks,
            'academic_session' => $class->academic_session,
        ]);
    }

    public function test_student_can_view_own_academic_results(): void
    {
        $class = $this->createClassWithSubject('RES1001');
        $this->createLegacyMark($this->student, $class, 85);

        $response = $this->actingAs($this->studentUser)
            ->get(route('student.academic-results'));

        $response->assertOk()
            ->assertViewHas('filteredMarks', function ($marks) {
                return $marks->count() === 1
                    && $marks->first()->student_id === $this->student->student_id
                    && $marks->first()->calculated_grade === 'A'
                    && $marks->first()->calculated_grade_point === 4.00;
            });
    }

    public function test_student_cannot_see_another_students_academic_results(): void
    {
        $ownClass = $this->createClassWithSubject('RES1002');
        $otherClass = $this->createClassWithSubject('RES1003');

        $this->createLegacyMark($this->student, $ownClass, 80);
        $this->createLegacyMark($this->otherStudent, $otherClass, 95);

        $response = $this->actingAs($this->studentUser)
            ->get(route('student.academic-results'));

        $response->assertOk()
            ->assertViewHas('filteredMarks', function ($marks) {
                return $marks->count() === 1
                    && $marks->first()->student_id === $this->student->student_id
                    && $marks->pluck('subject.subject_code')->contains('RES1002')
                    && !$marks->pluck('subject.subject_code')->contains('RES1003');
            });
    }

    public function test_student_can_filter_results_by_semester_and_session(): void
    {
        $currentClass = $this->createClassWithSubject('RES2001', 4, '2 2026/2027');
        $otherSemesterClass = $this->createClassWithSubject('RES2002', 3, '2 2026/2027');
        $otherSessionClass = $this->createClassWithSubject('RES2003', 4, '1 2025/2026');

        $this->createLegacyMark($this->student, $currentClass, 85);
        $this->createLegacyMark($this->student, $otherSemesterClass, 75);
        $this->createLegacyMark($this->student, $otherSessionClass, 65);

        $response = $this->actingAs($this->studentUser)->get(route(
            'student.academic-results',
            ['semester' => 4, 'session' => '2 2026/2027']
        ));

        $response->assertOk()
            ->assertViewHas('filteredMarks', function ($marks) {
                return $marks->count() === 1
                    && $marks->first()->subject->subject_code === 'RES2001';
            })
            ->assertViewHas('gpa', fn ($gpa) => $gpa === 4.0);
    }

    public function test_gpa_uses_selected_semester_and_session_while_cgpa_uses_all_results(): void
    {
        $first = $this->createClassWithSubject('RES3001', 4, '2 2026/2027', 3);
        $second = $this->createClassWithSubject('RES3002', 4, '2 2026/2027', 3);
        $previous = $this->createClassWithSubject('RES3003', 3, '1 2025/2026', 3);

        $this->createLegacyMark($this->student, $first, 85);    // 4.00
        $this->createLegacyMark($this->student, $second, 75);   // 3.67
        $this->createLegacyMark($this->student, $previous, 50); // 2.00

        $response = $this->actingAs($this->studentUser)->get(route(
            'student.academic-results',
            ['semester' => 4, 'session' => '2 2026/2027']
        ));

        $response->assertOk()
            ->assertViewHas('gpa', fn ($gpa) => abs($gpa - 3.835) < 0.001)
            ->assertViewHas('cgpa', fn ($cgpa) => abs($cgpa - 3.2233333333) < 0.001);
    }

    public function test_gpa_is_not_calculated_until_both_filters_are_selected(): void
    {
        $class = $this->createClassWithSubject('RES4001');
        $this->createLegacyMark($this->student, $class, 85);

        $response = $this->actingAs($this->studentUser)
            ->get(route('student.academic-results', ['semester' => 4]));

        $response->assertOk()
            ->assertViewHas('gpa', fn ($gpa) => $gpa === null)
            ->assertViewHas('cgpa', fn ($cgpa) => $cgpa === 4.0);
    }

    public function test_pb_pa_eligibility_failure_results_in_grade_f(): void
    {
        $class = $this->createClassWithSubject('RES5001', 4);
        $scheme = AssessmentScheme::create([
            'subject_id' => $class->subject_id,
            'academic_session' => $class->academic_session,
            'status' => 'active',
        ]);

        $pb = Assessment::create([
            'scheme_id' => $scheme->scheme_id,
            'assessment_name' => 'PB Test',
            'assessment_type' => 'PB',
            'max_marks' => 60,
            'weight_percentage' => 60,
            'sort_order' => 1,
        ]);

        $pa = Assessment::create([
            'scheme_id' => $scheme->scheme_id,
            'assessment_name' => 'PA Test',
            'assessment_type' => 'PA',
            'max_marks' => 40,
            'weight_percentage' => 40,
            'sort_order' => 2,
        ]);

        AssessmentMark::create([
            'assessment_id' => $pb->assessment_id,
            'student_id' => $this->student->student_id,
            'class_id' => $class->class_id,
            'marks_obtained' => 20,
        ]);

        AssessmentMark::create([
            'assessment_id' => $pa->assessment_id,
            'student_id' => $this->student->student_id,
            'class_id' => $class->class_id,
            'marks_obtained' => 30,
        ]);

        $response = $this->actingAs($this->studentUser)
            ->get(route('student.academic-results'));

        $response->assertOk()
            ->assertViewHas('filteredMarks', function ($marks) {
                return $marks->count() === 1
                    && $marks->first()->calculated_grade === 'F'
                    && $marks->first()->calculated_grade_point === 0.00;
            });
    }

    public function test_pa_below_25_percent_results_in_grade_f(): void
    {
        $class = $this->createClassWithSubject('RES5501', 4);
        $scheme = AssessmentScheme::create([
            'subject_id' => $class->subject_id,
            'academic_session' => $class->academic_session,
            'status' => 'active',
        ]);

        $pb = Assessment::create([
            'scheme_id' => $scheme->scheme_id,
            'assessment_name' => 'PB Test',
            'assessment_type' => 'PB',
            'max_marks' => 60,
            'weight_percentage' => 60,
            'sort_order' => 1,
        ]);

        $pa = Assessment::create([
            'scheme_id' => $scheme->scheme_id,
            'assessment_name' => 'PA Test',
            'assessment_type' => 'PA',
            'max_marks' => 40,
            'weight_percentage' => 40,
            'sort_order' => 2,
        ]);

        AssessmentMark::create([
            'assessment_id' => $pb->assessment_id,
            'student_id' => $this->student->student_id,
            'class_id' => $class->class_id,
            'marks_obtained' => 50,
        ]);

        AssessmentMark::create([
            'assessment_id' => $pa->assessment_id,
            'student_id' => $this->student->student_id,
            'class_id' => $class->class_id,
            'marks_obtained' => 5,
        ]);

        $response = $this->actingAs($this->studentUser)
            ->get(route('student.academic-results'));

        $response->assertOk()
            ->assertViewHas('filteredMarks', function ($marks) {
                return $marks->count() === 1
                    && $marks->first()->calculated_grade === 'F'
                    && $marks->first()->calculated_grade_point === 0.00;
            });
    }

    public function test_incomplete_pb_pa_assessment_is_not_displayed_as_final_result(): void
    {
        $class = $this->createClassWithSubject('RES6001', 4);
        $scheme = AssessmentScheme::create([
            'subject_id' => $class->subject_id,
            'academic_session' => $class->academic_session,
            'status' => 'active',
        ]);

        $pb = Assessment::create([
            'scheme_id' => $scheme->scheme_id,
            'assessment_name' => 'PB Test',
            'assessment_type' => 'PB',
            'max_marks' => 60,
            'weight_percentage' => 60,
            'sort_order' => 1,
        ]);

        Assessment::create([
            'scheme_id' => $scheme->scheme_id,
            'assessment_name' => 'PA Test',
            'assessment_type' => 'PA',
            'max_marks' => 40,
            'weight_percentage' => 40,
            'sort_order' => 2,
        ]);

        AssessmentMark::create([
            'assessment_id' => $pb->assessment_id,
            'student_id' => $this->student->student_id,
            'class_id' => $class->class_id,
            'marks_obtained' => 50,
        ]);

        $response = $this->actingAs($this->studentUser)
            ->get(route('student.academic-results'));

        $response->assertOk()
            ->assertViewHas('filteredMarks', fn ($marks) => $marks->isEmpty());
    }

    public function test_non_student_roles_cannot_access_student_academic_results(): void
    {
        $response = $this->actingAs($this->lecturerUser)
            ->get(route('student.academic-results'));

        $response->assertForbidden();
    }

    public function test_invalid_semester_filter_is_rejected(): void
    {
        $response = $this->actingAs($this->studentUser)
            ->get(route('student.academic-results', ['semester' => 99]));

        $response->assertSessionHasErrors('semester');
    }
}
