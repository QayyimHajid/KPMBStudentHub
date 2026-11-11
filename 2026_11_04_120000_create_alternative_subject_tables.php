<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alternative_subject_groups', function (Blueprint $table) {
            $table->bigIncrements('alternative_group_id');
            $table->unsignedBigInteger('structure_id');
            $table->unsignedInteger('semester');
            $table->string('group_code', 40);
            $table->string('group_name', 150);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(
                ['structure_id', 'semester', 'group_code'],
                'alt_groups_structure_semester_code_unique'
            );
            $table->foreign('structure_id', 'alt_groups_structure_fk')
                ->references('structure_id')->on('programme_structures')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::table('programme_structure_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('alternative_group_id')->nullable()->after('semester');
            $table->index('alternative_group_id', 'pss_alternative_group_index');
            $table->unique(
                ['alternative_group_id', 'subject_id'],
                'pss_alt_group_subject_unique'
            );
            $table->foreign('alternative_group_id', 'pss_alternative_group_fk')
                ->references('alternative_group_id')->on('alternative_subject_groups')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::create('student_alternative_subject_choices', function (Blueprint $table) {
            $table->bigIncrements('choice_id');
            $table->string('student_id', 20);
            $table->unsignedBigInteger('alternative_group_id');
            $table->unsignedBigInteger('subject_id');
            $table->timestamps();

            $table->unique(
                ['student_id', 'alternative_group_id'],
                'student_alt_group_choice_unique'
            );
            $table->index('subject_id', 'student_alt_choice_subject_index');
            $table->foreign('student_id', 'student_alt_choice_student_fk')
                ->references('student_id')->on('students')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(
                ['alternative_group_id', 'subject_id'],
                'student_alt_choice_group_subject_fk'
            )->references(['alternative_group_id', 'subject_id'])
                ->on('programme_structure_subjects')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_alternative_subject_choices');

        Schema::table('programme_structure_subjects', function (Blueprint $table) {
            $table->dropForeign('pss_alternative_group_fk');
            $table->dropUnique('pss_alt_group_subject_unique');
            $table->dropIndex('pss_alternative_group_index');
            $table->dropColumn('alternative_group_id');
        });

        Schema::dropIfExists('alternative_subject_groups');
    }
};
