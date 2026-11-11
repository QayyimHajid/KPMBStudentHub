<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id('class_id');

            $table->unsignedBigInteger('subject_id');
            $table->string('lecturer_id', 20);

            $table->string('class_name', 50);
            $table->unsignedInteger('semester');
            $table->string('academic_session', 20);

            $table->timestamps();

            $table->foreign('subject_id')
                ->references('subject_id')
                ->on('subjects')
                ->restrictOnDelete();

            $table->foreign('lecturer_id')
                ->references('lecturer_id')
                ->on('lecturers')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
