<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class UppSubjectRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_upp_can_view_processed_registration_records(): void
    {
        $upp = User::factory()->create([
            'username' => 'testupp',
            'role' => 'upp',
            'status' => 'active',
        ]);

        $studentUserId = DB::table('users')->insertGetId([
            'username' => 'teststudent',
            'name' => 'Test Student',
            'email' => 'teststudent@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('students')->insert([
            'student_id' => 'TEST001',
            'user_id' => $studentUserId,
            'student_name' => 'Test Student',
            'programme' => 'Test Programme',
            'semester' => 1,
            'phone_number' => null,
            'email' => 'teststudent@example.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $subjectId = DB::table('subjects')->insertGetId([
            'subject_code' => 'TEST101',
            'subject_name' => 'Test Subject',
            'credit_hour' => 3,
            'semester' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lecturerUserId = DB::table('users')->insertGetId([
            'username' => 'testlecturer',
            'name' => 'Test Lecturer',
            'email' => 'testlecturer@example.com',
            'password' => bcrypt('password'),
            'role' => 'lecturer',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('lecturers')->insert([
            'lecturer_id' => 'LECTEST001',
            'user_id' => $lecturerUserId,
            'lecturer_name' => 'Test Lecturer',
            'department' => 'Test Department',
            'email' => 'testlecturer@example.com',
            'phone_number' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $classId = DB::table('classes')->insertGetId([
            'subject_id' => $subjectId,
            'lecturer_id' => 'LECTEST001',
            'class_name' => 'Test Class',
            'semester' => 1,
            'academic_session' => '2 2026/2027',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create subject registration application first
        $applicationId = DB::table('subject_registration_applications')
            ->insertGetId([
                'student_id' => 'TEST001',
                'semester' => 1,
                'academic_session' => '2 2026/2027',
                'application_status' => 'approved',
                'submitted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        // Link registration to its application
        DB::table('subject_registrations')->insert([
            'application_id' => $applicationId,
            'student_id' => 'TEST001',
            'subject_id' => $subjectId,
            'class_id' => $classId,
            'semester' => 1,
            'registration_date' => now()->toDateString(),
            'registration_status' => 'approved',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($upp)
            ->get(route('upp.subject-registrations.index'));

        $response->assertOk();

        $response->assertViewHas('applications', function ($applications) {
            return collect($applications->items())->contains(
                fn ($application) =>
                    $application->application_status === 'approved'
                    && $application->registrations->contains(
                        fn ($registration) =>
                            $registration->registration_status === 'approved'
                    )
            );
        });
    }
}