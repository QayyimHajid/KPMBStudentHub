<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up(): void
    {
        Schema::create('programme_structure_subjects', function (Blueprint $table) {
            $table->id('structure_subject_id');

            $table->unsignedBigInteger('structure_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedInteger('semester');

            $table->timestamps();

            $table->foreign('structure_id')
                ->references('structure_id')
                ->on('programme_structures')
                ->restrictOnDelete();

            $table->foreign('subject_id')
                ->references('subject_id')
                ->on('subjects')
                ->restrictOnDelete();

            $table->unique(
                ['structure_id', 'subject_id'],
                'programme_structure_subject_unique'
            );
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_structure_subjects');
    }
};
