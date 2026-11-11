<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentAnnouncementsEventsEmptyStateTest extends TestCase
{
    use RefreshDatabase;

    private function createStudent(): User
    {
        $user = User::create([
            'username' => 'EMPTY-STATE-TEST',
            'name' => 'Empty State Test Student',
            'email' => 'empty-state-test@example.com',
            'password' => 'TestPassword@123',
            'role' => 'student',
            'status' => 'active',
        ]);

        Student::create([
            'student_id' => 'STU-EMPTY-TEST',
            'user_id' => $user->id,
            'student_name' => 'Empty State Test Student',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
            'email' => 'empty-state-test@example.com',
        ]);

        return $user;
    }

    public function test_dashboard_displays_empty_announcement_message(): void
    {
        $student = $this->createStudent();

        $response = $this->actingAs($student)
            ->get(route('student.dashboard'));

        $response->assertOk();
        $response->assertSee('Tiada pengumuman untuk dipaparkan');
    }

    public function test_dashboard_displays_empty_event_message(): void
    {
        $student = $this->createStudent();

        $response = $this->actingAs($student)
            ->get(route('student.dashboard'));

        $response->assertOk();
        $response->assertSee('Acara belum tersedia');
        $response->assertSee('Acara akan datang yang direkodkan akan dipaparkan di sini.');
    } 

    public function test_announcements_events_page_displays_empty_announcement_message(): void
    {
        $student = $this->createStudent();

        $response = $this->actingAs($student)
            ->get(route('student.announcements-events'));

        $response->assertOk();
        $response->assertSee('Tiada hebahan terkini');
        $response->assertSee('Hebahan rasmi yang diterbitkan akan dipaparkan di sini.');
    }

    public function test_announcements_events_page_displays_empty_event_message(): void
    {
        $student = $this->createStudent();

        $response = $this->actingAs($student)
            ->get(route('student.announcements-events'));

        $response->assertOk();
        $response->assertSee('Tiada acara akan datang');
        $response->assertSee('Acara kampus yang akan datang akan dipaparkan di sini apabila tersedia.');
    }
}
