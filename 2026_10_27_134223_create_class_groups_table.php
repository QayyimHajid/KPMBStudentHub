<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_groups', function (Blueprint $table) {
            $table->id('group_id');
            $table->string('group_name', 50);
            $table->unsignedBigInteger('programme_id');
            $table->unsignedInteger('semester');
            $table->string('academic_session', 20);
            $table->timestamps();

            $table->foreign('programme_id')
                ->references('programme_id')
                ->on('programmes')
                ->cascadeOnDelete();

            $table->unique([
                'group_name',
                'academic_session',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_groups');
    }
};