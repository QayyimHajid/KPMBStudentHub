<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id('assessment_id');
            $table->unsignedBigInteger('scheme_id');
            $table->string('assessment_name', 100);
            $table->decimal('max_marks', 7, 2);
            $table->decimal('weight_percentage', 5, 2);
            $table->unsignedInteger('sort_order')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('scheme_id')
                ->references('scheme_id')
                ->on('assessment_schemes')
                ->restrictOnDelete();

            $table->unique(['scheme_id', 'assessment_name'], 'assessment_scheme_name_unique');
            $table->index(['scheme_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
