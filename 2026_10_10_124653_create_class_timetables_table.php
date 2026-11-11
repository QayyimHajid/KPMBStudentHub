<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_timetables', function (Blueprint $table) {
            $table->id('timetable_id');

            $table->unsignedBigInteger('class_id');
            $table->string('day', 20);
            $table->time('start_time');
            $table->time('end_time');
            $table->string('venue', 50);

            $table->timestamps();

            $table->foreign('class_id')
                ->references('class_id')
                ->on('classes')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_timetables');
    }
};
