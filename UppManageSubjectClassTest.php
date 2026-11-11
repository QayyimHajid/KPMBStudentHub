<?php

namespace Tests\Feature;

use App\Models\Programme;
use App\Models\User;
use App\Support\AcademicSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UppManageSubjectClassTest extends TestCase
{
    use RefreshDatabase;

    private function createProgrammes(): void
    {
        $programmes = [
            ['programme_code' => 'DCS', 'programme_name' => 'Diploma in Computer Science'],
            ['programme_code' => 'DBS', 'programme_name' => 'Diploma in Business Studies'],
            ['programme_code' => 'DIA', 'programme_name' => 'Diploma in Islamic Administration'],
            ['programme_code' => 'DLH', 'programme_name' => 'Diploma in Halal Management'],
            ['programme_code' => 'CFAB', 'programme_name' => 'Certificate in Foundation and Business'],
        ];

        foreach ($programmes as $programme) {
            Programme::create($programme + ['status' => 'active']);
        }
    }

    private function createUppUser(): User
    {
        return User::create([
            'username' => 'TEST-UPP-SUBJECT-CLASS',
            'name' => 'Test UPP',
            'email' => 'test-upp-subject-class@example.com',
            'password' => 'password',
            'role' => 'upp',
            'status' => 'active',
        ]);
    }

    /**
     * Simulate the production records before synchronization:
     * DCS 6A and DCS 6B still have their stable IDs but use a legacy session
     * spelling; DBS 2A is a valid extra group not present in the timetable JSON.
     */
    private function seedExistingGroups(): void
    {
        $now = now();

        DB::table('class_groups')->insert([
            [
                'group_id' => 1,
                'group_name' => 'DCS 6A',
                'programme_id' => 1,
                'semester' => 6,
                'academic_session' => '2026/2027',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'group_id' => 2,
                'group_name' => 'DCS 6B',
                'programme_id' => 1,
                'semester' => 6,
                'academic_session' => '2026/2027',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'group_id' => 3,
                'group_name' => 'DBS 2A',
                'programme_id' => 2,
                'semester' => 2,
                'academic_session' => AcademicSession::CURRENT,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function test_timetable_sync_is_idempotent_and_preserves_existing_group_ids(): void
    {
        $this->createProgrammes();
        $this->seedExistingGroups();

        $upp = $this->createUppUser();

        $this->actingAs($upp)
            ->get(route('upp.subject-classes.index'))
            ->assertOk();

        // Stable IDs are recovered and their legacy session values standardized.
        $this->assertDatabaseHas('class_groups', [
            'group_id' => 1,
            'group_name' => 'DCS 6A',
            'academic_session' => AcademicSession::CURRENT,
        ]);

        $this->assertDatabaseHas('class_groups', [
            'group_id' => 2,
            'group_name' => 'DCS 6B',
            'academic_session' => AcademicSession::CURRENT,
        ]);

        // DBS 2A is not in the JSON catalogue, but must remain untouched.
        $this->assertDatabaseHas('class_groups', [
            'group_id' => 3,
            'group_name' => 'DBS 2A',
            'programme_id' => 2,
            'semester' => 2,
            'academic_session' => AcademicSession::CURRENT,
        ]);

        // Repeat timetable labels are not actual class groups; they remain
        // references for repeat subject assignments only.
        $this->assertDatabaseMissing('class_groups', [
            'group_name' => 'DBS 5A',
            'academic_session' => AcademicSession::CURRENT,
        ]);
        $this->assertDatabaseMissing('class_groups', [
            'group_name' => 'DCS 2A',
            'academic_session' => AcademicSession::CURRENT,
        ]);
        $this->assertDatabaseMissing('class_groups', [
            'group_name' => 'DCS 5A',
            'academic_session' => AcademicSession::CURRENT,
        ]);
        $this->assertDatabaseMissing('class_groups', [
            'group_name' => 'DIA 5A',
            'academic_session' => AcademicSession::CURRENT,
        ]);

        // 45 real timetable class groups plus the valid DBS 2A group.
        $this->assertDatabaseCount('class_groups', 46);

        // Opening the page again must not create additional groups.
        $this->actingAs($upp)
            ->get(route('upp.subject-classes.index'))
            ->assertOk();

        $this->assertDatabaseCount('class_groups', 46);
        $this->assertDatabaseHas('class_groups', [
            'group_id' => 1,
            'group_name' => 'DCS 6A',
        ]);
        $this->assertDatabaseHas('class_groups', [
            'group_id' => 2,
            'group_name' => 'DCS 6B',
        ]);
    }

    public function test_viewing_a_historical_session_does_not_sync_the_current_timetable_catalogue(): void
    {
        $this->createProgrammes();
        $this->seedExistingGroups();

        $upp = $this->createUppUser();

        $this->actingAs($upp)
            ->get(route('upp.subject-classes.index', [
                'academic_session' => '1 2025/2026',
            ]))
            ->assertOk();

        // The current-session catalogue must not be copied into a historical view.
        $this->assertDatabaseCount('class_groups', 3);

        $this->assertDatabaseMissing('class_groups', [
            'group_name' => 'CFAB 1A',
            'academic_session' => '1 2025/2026',
        ]);

        // The pre-existing records are not rewritten by a historical-session visit.
        $this->assertDatabaseHas('class_groups', [
            'group_id' => 1,
            'academic_session' => '2026/2027',
        ]);

        $this->assertDatabaseHas('class_groups', [
            'group_id' => 2,
            'academic_session' => '2026/2027',
        ]);
    }
}
