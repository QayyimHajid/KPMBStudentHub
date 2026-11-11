<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\LecturerDirectory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class DemoAccountsSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $password = 'Demo@12345';

            // 1. DCS Semester 6A
            $this->createStudent(
                'DEMO-DCS6A',
                'Demo Student DCS 6A',
                'demo-dcs6a@example.test',
                'Diploma in Computer Science',
                6,
                3,
                1,
                $password
            );

            // 2. DCS Semester 6B
            $this->createStudent(
                'DEMO-DCS6B',
                'Demo Student DCS 6B',
                'demo-dcs6b@example.test',
                'Diploma in Computer Science',
                6,
                3,
                2,
                $password
            );

            // 3. DCS Semester 3A
            $this->createStudent(
                'DEMO-DCS3A',
                'Demo Student DCS 3A',
                'demo-dcs3a@example.test',
                'Diploma in Computer Science',
                3,
                4,
                31,
                $password
            );

            // 4. DBS Semester 1A
            $this->createStudent(
                'DEMO-DBS1A',
                'Demo Student DBS 1A',
                'demo-dbs1a@example.test',
                'Diploma in Business Studies',
                1,
                6,
                10,
                $password
            );

            // 5. Lecturer Demo Account
            $department = LecturerDirectory::query()
                ->whereNotNull('department')
                ->where('department', '!=', '')
                ->orderBy('department')
                ->value('department');

            if (!$department) {
                throw new RuntimeException(
                    'No department found in Lecturer Directory.'
                );
            }

            $lecturerUser = User::updateOrCreate(
                ['username' => 'DEMO-LECT-001'],
                [
                    'name' => 'Demo Lecturer',
                    'email' => 'demo-lecturer@example.test',
                    'password' => $password,
                    'role' => 'lecturer',
                    'status' => 'active',
                ]
            );

            Lecturer::updateOrCreate(
                ['lecturer_id' => 'DEMO-LECT-001'],
                [
                    'user_id' => $lecturerUser->id,
                    'lecturer_name' => 'Demo Lecturer',
                    'department' => $department,
                    'email' => 'demo-lecturer@example.test',
                    'phone_number' => null,
                ]
            );

            // 6. UPP Demo Account
            User::updateOrCreate(
                ['username' => 'DEMO-UPP'],
                [
                    'name' => 'Demo UPP',
                    'email' => 'demo-upp@example.test',
                    'password' => $password,
                    'role' => 'upp',
                    'status' => 'active',
                ]
            );
        });

        $this->command->info(
            'KPMB Student Hub demo accounts created successfully.'
        );
    }

    private function createStudent(
        string $studentId,
        string $name,
        string $email,
        string $programme,
        int $semester,
        int $structureId,
        int $groupId,
        string $password
    ): void {
        $user = User::updateOrCreate(
            ['username' => $studentId],
            [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => 'student',
                'status' => 'active',
            ]
        );

        Student::updateOrCreate(
            ['student_id' => $studentId],
            [
                'user_id' => $user->id,
                'student_name' => $name,
                'programme' => $programme,
                'semester' => $semester,
                'email' => $email,
                'structure_id' => $structureId,
                'group_id' => $groupId,
            ]
        );
    }
}
