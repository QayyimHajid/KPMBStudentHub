<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id', 20)->primary();

            $table->unsignedBigInteger('user_id')->unique();

            $table->string('student_name', 100);
            $table->string('programme', 100);
            $table->unsignedInteger('semester');
            $table->string('phone_number', 20)->nullable();
            $table->string('email', 100)->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
