<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_rosters', function (Blueprint $table) {
            $table->string('student_id', 20)->primary();
            $table->string('student_name', 100);
            $table->string('programme', 100);
            $table->unsignedInteger('semester');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_rosters');
    }
};
