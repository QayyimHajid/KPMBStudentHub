
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->string('lecturer_id', 20)->primary();

            $table->unsignedBigInteger('user_id')->unique();

            $table->string('lecturer_name', 100);
            $table->string('department', 100);
            $table->string('email', 100);
            $table->string('phone_number', 20)->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
