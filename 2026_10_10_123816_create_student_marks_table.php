
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id('mark_id');

            $table->string('student_id', 20);
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('class_id');
            $table->string('lecturer_id', 20);

            $table->decimal('marks', 5, 2);
            $table->string('academic_session', 20);

            $table->timestamps();

            $table->foreign('student_id')
                ->references('student_id')
                ->on('students')
                ->restrictOnDelete();

            $table->foreign('subject_id')
                ->references('subject_id')
                ->on('subjects')
                ->restrictOnDelete();

            $table->foreign('class_id')
                ->references('class_id')
                ->on('classes')
                ->restrictOnDelete();

            $table->foreign('lecturer_id')
                ->references('lecturer_id')
                ->on('lecturers')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_marks');
    }
};
