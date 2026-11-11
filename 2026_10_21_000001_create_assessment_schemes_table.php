<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_schemes', function (Blueprint $table) {
            $table->id('scheme_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('academic_session', 20);
            $table->enum('status', ['draft', 'active', 'archived'])->default('draft');
            $table->string('notes', 500)->nullable();
            $table->timestamps();

            $table->foreign('subject_id')
                ->references('subject_id')
                ->on('subjects')
                ->restrictOnDelete();

            $table->unique(['subject_id', 'academic_session'], 'assessment_scheme_subject_session_unique');
            $table->index(['status', 'academic_session']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_schemes');
    }
};
