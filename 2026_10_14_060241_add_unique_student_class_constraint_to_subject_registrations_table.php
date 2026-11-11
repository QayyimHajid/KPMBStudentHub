<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subject_registrations', function (Blueprint $table) {
            $table->unique(
                ['student_id', 'class_id'],
                'unique_student_class_registration'
            );
        });
    }

    public function down(): void
    {
        Schema::table('subject_registrations', function (Blueprint $table) {
            $table->dropUnique('unique_student_class_registration');
        });
    }
};
