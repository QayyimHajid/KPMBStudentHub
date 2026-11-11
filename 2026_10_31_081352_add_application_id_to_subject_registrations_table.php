<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add application_id only if it does not exist.
        if (!Schema::hasColumn('subject_registrations', 'application_id')) {
            Schema::table('subject_registrations', function (Blueprint $table) {
                $table->unsignedBigInteger('application_id')
                    ->nullable()
                    ->after('registration_id');
            });
        }

        $driver = DB::connection()->getDriverName();

        if ($driver === 'sqlite') {
            return;
        }
        // 2. Ensure application_id has an index.
        $applicationIndexExists = DB::table('information_schema.STATISTICS')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', 'subject_registrations')
            ->where('INDEX_NAME', 'subject_registrations_application_id_foreign')
            ->exists();

        if (!$applicationIndexExists) {
            Schema::table('subject_registrations', function (Blueprint $table) {
                $table->index('application_id');
            });
        }

        // 3. Add the application foreign key only if it does not exist.
        $applicationForeignKeyExists = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', 'subject_registrations')
            ->where('CONSTRAINT_NAME', 'subject_registrations_application_id_foreign')
            ->where('REFERENCED_TABLE_NAME', 'subject_registration_applications')
            ->exists();

        if (!$applicationForeignKeyExists) {
            Schema::table('subject_registrations', function (Blueprint $table) {
                $table->foreign('application_id')
                    ->references('application_id')
                    ->on('subject_registration_applications')
                    ->restrictOnDelete();
            });
        }

        // 4. Preserve the student foreign key when removing the composite unique index.
        $studentIndexExists = DB::table('information_schema.STATISTICS')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', 'subject_registrations')
            ->where('INDEX_NAME', 'subject_registrations_student_id_index')
            ->exists();

        if (!$studentIndexExists) {
            Schema::table('subject_registrations', function (Blueprint $table) {
                $table->index('student_id', 'subject_registrations_student_id_index');
            });
        }

        // 5. Remove the old unique index if it still exists.
        $uniqueIndexExists = DB::table('information_schema.STATISTICS')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', 'subject_registrations')
            ->where('INDEX_NAME', 'unique_student_class_registration')
            ->exists();

        if ($uniqueIndexExists) {
            Schema::table('subject_registrations', function (Blueprint $table) {
                $table->dropUnique('unique_student_class_registration');
            });
        }
    }

    public function down(): void
    {
        // Restore the original unique constraint only when it is safe to do so.
        $duplicateExists = DB::table('subject_registrations')
            ->select('student_id', 'class_id')
            ->groupBy('student_id', 'class_id')
            ->havingRaw('COUNT(*) > 1')
            ->exists();

        if (!$duplicateExists) {
            $uniqueIndexExists = DB::table('information_schema.STATISTICS')
                ->where('TABLE_SCHEMA', DB::getDatabaseName())
                ->where('TABLE_NAME', 'subject_registrations')
                ->where('INDEX_NAME', 'unique_student_class_registration')
                ->exists();

            if (!$uniqueIndexExists) {
                Schema::table('subject_registrations', function (Blueprint $table) {
                    $table->unique(
                        ['student_id', 'class_id'],
                        'unique_student_class_registration'
                    );
                });
            }
        }

        // Keep application_id and its foreign key intact.
        // This avoids deleting registration history during rollback.
    }
};