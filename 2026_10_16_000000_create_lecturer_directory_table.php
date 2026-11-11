<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturer_directory', function (Blueprint $table) {
            $table->id();
            $table->string('lecturer_name', 150);
            $table->string('position', 100)->default('Pensyarah');
            $table->string('department_code', 10);
            $table->string('department', 150);
            $table->string('email', 150);
            $table->timestamps();
            $table->index('department_code');
            $table->index('lecturer_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturer_directory');
    }
};
