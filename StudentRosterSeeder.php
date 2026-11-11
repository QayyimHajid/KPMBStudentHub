<?php

namespace Database\Seeders;

use App\Models\StudentRoster;
use Illuminate\Database\Seeder;

class StudentRosterSeeder extends Seeder
{
    public function run(): void
    {
        // Fictional test records for FYP demonstration only. Not real KPMB data.
        $records = [
            ['student_id' => 'TESTSTU001', 'student_name' => 'Aiman Hakim bin Rahman', 'programme' => 'Diploma in Computer Science', 'semester' => 2],
            ['student_id' => 'TESTSTU002', 'student_name' => 'Nur Alya binti Zulkifli', 'programme' => 'Diploma in Computer Science', 'semester' => 4],
            ['student_id' => 'TESTSTU003', 'student_name' => 'Danish Irfan bin Azman', 'programme' => 'Diploma in Computer Science', 'semester' => 6],
            ['student_id' => 'TESTSTU004', 'student_name' => 'Siti Hajar binti Hassan', 'programme' => 'Diploma in Business Studies', 'semester' => 2],
            ['student_id' => 'TESTSTU005', 'student_name' => 'Muhammad Firdaus bin Ismail', 'programme' => 'Diploma in Business Studies', 'semester' => 4],
        ];

        foreach ($records as $record) {
            StudentRoster::updateOrCreate(
                ['student_id' => $record['student_id']],
                $record
            );
        }
    }
}
