<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_mentor_assignments', function (Blueprint $table) {
            // Existing assignments keep lecturer_id; directory-only mentors use lecturer_directory_id.
            $table->dropForeign(['lecturer_id']);
            $table->string('lecturer_id', 20)->nullable()->change();
            $table->unsignedBigInteger('lecturer_directory_id')->nullable()->after('lecturer_id');

            $table->foreign('lecturer_id')
                ->references('lecturer_id')
                ->on('lecturers')
                ->restrictOnDelete();

            $table->foreign('lecturer_directory_id')
                ->references('id')
                ->on('lecturer_directory')
                ->restrictOnDelete();

            $table->index(['lecturer_directory_id', 'ended_at']);
        });
    }

    public function down(): void
    {
        // Cannot safely roll back if directory-only mentor assignments exist.
        Schema::table('student_mentor_assignments', function (Blueprint $table) {
            $table->dropForeign(['lecturer_directory_id']);
            $table->dropIndex(['lecturer_directory_id', 'ended_at']);
            $table->dropColumn('lecturer_directory_id');
            $table->dropForeign(['lecturer_id']);
            $table->string('lecturer_id', 20)->nullable(false)->change();
            $table->foreign('lecturer_id')
                ->references('lecturer_id')
                ->on('lecturers')
                ->restrictOnDelete();
        });
    }
};
