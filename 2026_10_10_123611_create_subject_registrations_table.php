
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subject_registrations', function (Blueprint $table) {
            $table->id('registration_id');

            $table->string('student_id', 20);
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('class_id');

            $table->unsignedInteger('semester');
            $table->date('registration_date');

            $table->enum('registration_status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_registrations');
    }
};
