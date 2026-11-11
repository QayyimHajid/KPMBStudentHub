<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentAnnouncementEventPaginationTest extends TestCase
{
    use RefreshDatabase;

    private function createStudent(): User
    {
        $user = User::create([
            'username' => 'PAGINATION-TEST',
            'name' => 'Pagination Test Student',
            'email' => 'pagination-test@example.com',
            'password' => 'TestPassword@123',
            'role' => 'student',
            'status' => 'active',
        ]);

        Student::create([
            'student_id' => 'STU-PAGINATION-TEST',
            'user_id' => $user->id,
            'student_name' => 'Pagination Test Student',
            'programme' => 'Diploma in Computer Science',
            'semester' => 6,
            'email' => 'pagination-test@example.com',
        ]);

        return $user;
    }

    public function test_announcements_are_paginated_five_per_page(): void
    {
        $student = $this->createStudent();

        for ($i = 1; $i <= 6; $i++) {
            Announcement::create([
                'title' => "Pagination Announcement {$i}",
                'content' => "Test announcement content {$i}.",
                'date_published' => now()->toDateString(),
                'status' => 'published',
            ]);
        }

        $response = $this->actingAs($student)
            ->get(route('student.announcements-events'));

        $response->assertOk();

        $response->assertViewHas('announcements', function ($announcements) {
            return $announcements->count() === 5
                && $announcements->total() === 6
                && $announcements->currentPage() === 1;
        });

        $response = $this->actingAs($student)
            ->get(route('student.announcements-events', [
                'announcements_page' => 2,
            ]));

        $response->assertOk();

        $response->assertViewHas('announcements', function ($announcements) {
            return $announcements->count() === 1
                && $announcements->currentPage() === 2;
        });
    }

    public function test_events_are_paginated_five_per_page(): void
    {
        $student = $this->createStudent();

        for ($i = 1; $i <= 6; $i++) {
            Event::create([
                'event_name' => "Pagination Event {$i}",
                'description' => "Test event description {$i}.",
                'event_date' => now()->addDays($i)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'venue' => 'KPMB Test Venue',
            ]);
        }

        $response = $this->actingAs($student)
            ->get(route('student.announcements-events'));

        $response->assertOk();

        $response->assertViewHas('events', function ($events) {
            return $events->count() === 5
                && $events->total() === 6
                && $events->currentPage() === 1;
        });

        $response = $this->actingAs($student)
            ->get(route('student.announcements-events', [
                'events_page' => 2,
            ]));

        $response->assertOk();

        $response->assertViewHas('events', function ($events) {
            return $events->count() === 1
                && $events->currentPage() === 2;
        });
    }

    public function test_announcement_and_event_pagination_work_independently(): void
    {
        $student = $this->createStudent();

        for ($i = 1; $i <= 6; $i++) {
            Announcement::create([
                'title' => "Independent Announcement {$i}",
                'content' => "Test announcement content {$i}.",
                'date_published' => now()->toDateString(),
                'status' => 'published',
            ]);

            Event::create([
                'event_name' => "Independent Event {$i}",
                'description' => "Test event description {$i}.",
                'event_date' => now()->addDays($i)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'venue' => 'KPMB Test Venue',
            ]);
        }

        $response = $this->actingAs($student)
            ->get(route('student.announcements-events', [
                'announcements_page' => 2,
                'events_page' => 1,
            ]));

        $response->assertOk();

        $response->assertViewHas('announcements', function ($announcements) {
            return $announcements->currentPage() === 2
                && $announcements->count() === 1;
        });

        $response->assertViewHas('events', function ($events) {
            return $events->currentPage() === 1
                && $events->count() === 5;
        });

        $response = $this->actingAs($student)
            ->get(route('student.announcements-events', [
                'announcements_page' => 2,
                'events_page' => 2,
            ]));

        $response->assertOk();

        $response->assertViewHas('announcements', function ($announcements) {
            return $announcements->currentPage() === 2
                && $announcements->count() === 1;
        });

        $response->assertViewHas('events', function ($events) {
            return $events->currentPage() === 2
                && $events->count() === 1;
        });
    }

    public function test_guest_cannot_access_announcements_events_page(): void
    {
        $response = $this->get(route('student.announcements-events'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_student_can_access_announcements_events_page(): void
    {
        $student = $this->createStudent();

        $response = $this->actingAs($student)
            ->get(route('student.announcements-events'));

        $response->assertOk();
    }

    public function test_non_student_cannot_access_announcements_events_page(): void
    {
        $user = User::create([
            'username' => 'LECTURER-TEST',
            'name' => 'Test Lecturer',
            'email' => 'lecturer-test@example.com',
            'password' => 'TestPassword@123',
            'role' => 'lecturer',
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)
            ->get(route('student.announcements-events'));

        $response->assertForbidden();
    }
}