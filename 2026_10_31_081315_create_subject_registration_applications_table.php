<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subject_registration_applications', function (Blueprint $table) {
            $table->id('application_id');

            $table->string('student_id', 20);
            $table->unsignedInteger('semester');
            $table->string('academic_session', 20);

            $table->enum('application_status', [
                'pending',
                'approved',
                'rejected',
            ])->default('pending');

            $table->dateTime('submitted_at')->nullable();

            $table->string('reviewed_by', 20)->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->foreign('student_id')
                ->references('student_id')
                ->on('students')
                ->restrictOnDelete();

            $table->index(
                ['student_id', 'semester', 'academic_session'],
                'application_student_semester_session_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_registration_applications');
    }
};