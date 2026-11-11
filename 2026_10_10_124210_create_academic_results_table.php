
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_results', function (Blueprint $table) {
            $table->id('result_id');

            $table->string('student_id', 20);
            $table->unsignedBigInteger('subject_id');
            $table->unsignedInteger('semester');

            $table->string('grade', 5);
            $table->decimal('grade_point', 5, 2);
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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_results');
    }
};
