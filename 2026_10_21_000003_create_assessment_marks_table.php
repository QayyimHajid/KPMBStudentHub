<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_marks', function (Blueprint $table) {
            $table->id('assessment_mark_id');
            $table->unsignedBigInteger('assessment_id');
            $table->string('student_id', 20);
            $table->unsignedBigInteger('class_id');
            $table->decimal('marks_obtained', 7, 2);
            $table->string('recorded_by', 20)->nullable();
            $table->timestamps();

            $table->foreign('assessment_id')
                ->references('assessment_id')
                ->on('assessments')
                ->restrictOnDelete();

            $table->foreign('student_id')
                ->references('student_id')
                ->on('students')
                ->restrictOnDelete();

            $table->foreign('class_id')
                ->references('class_id')
                ->on('classes')
                ->restrictOnDelete();

            $table->foreign('recorded_by')
                ->references('lecturer_id')
                ->on('lecturers')
                ->nullOnDelete();

            $table->unique(
                ['assessment_id', 'student_id', 'class_id'],
                'assessment_mark_student_class_unique'
            );
            $table->index(['student_id', 'class_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_marks');
    }
};
