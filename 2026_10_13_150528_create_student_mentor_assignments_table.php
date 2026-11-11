<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_mentor_assignments', function (Blueprint $table) {
            $table->id('assignment_id');

            $table->string('student_id', 20);
            $table->string('lecturer_id', 20);

            $table->unsignedBigInteger('assigned_by')->nullable();

            $table->date('assigned_at');
            $table->date('ended_at')->nullable();

            $table->timestamps();

            $table->foreign('student_id')
                ->references('student_id')
                ->on('students')
                ->restrictOnDelete();

            $table->foreign('lecturer_id')
                ->references('lecturer_id')
                ->on('lecturers')
                ->restrictOnDelete();

            $table->foreign('assigned_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->index(['student_id', 'ended_at']);
            $table->index(['lecturer_id', 'ended_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_mentor_assignments');
    }
};