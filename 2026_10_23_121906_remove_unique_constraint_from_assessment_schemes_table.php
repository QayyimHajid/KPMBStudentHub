<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assessment_schemes', function (Blueprint $table) {
            $table->index(
                'subject_id',
                'assessment_schemes_subject_id_index'
            );
        });

        Schema::table('assessment_schemes', function (Blueprint $table) {
            $table->dropUnique(
                'assessment_scheme_subject_session_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('assessment_schemes', function (Blueprint $table) {
            $table->unique(
                ['subject_id', 'academic_session'],
                'assessment_scheme_subject_session_unique'
            );
        });

        Schema::table('assessment_schemes', function (Blueprint $table) {
            $table->dropIndex(
                'assessment_schemes_subject_id_index'
            );
        });
    }
};
