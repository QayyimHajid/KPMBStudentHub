<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->string('class_type', 10)->default('regular')->after('class_id');
            $table->unsignedBigInteger('structure_id')->nullable()->after('group_id');
            $table->index(['class_type', 'structure_id', 'semester', 'academic_session'], 'classes_repeat_lookup_index');
            $table->foreign('structure_id', 'classes_structure_id_foreign')
                ->references('structure_id')->on('programme_structures')->nullOnDelete();
        });

        Schema::create('repeat_subject_applications', function (Blueprint $table) {
            $table->id('repeat_application_id');
            $table->string('student_id', 20);
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('structure_id');
            $table->unsignedInteger('student_current_semester');
            $table->unsignedInteger('subject_semester');
            $table->string('academic_session', 20);
            $table->string('eligibility_basis', 30)->nullable();
            $table->string('eligibility_grade', 5)->nullable();
            $table->decimal('pb_percentage', 6, 2)->nullable();
            $table->enum('application_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->restrictOnDelete();
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->restrictOnDelete();
            $table->foreign('class_id')->references('class_id')->on('classes')->restrictOnDelete();
            $table->foreign('structure_id')->references('structure_id')->on('programme_structures')->restrictOnDelete();
            $table->foreign('reviewed_by')->references('id')->on('users')->nullOnDelete();
            $table->index(['student_id', 'application_status'], 'repeat_app_student_status_index');
            $table->index(['subject_id', 'subject_semester', 'academic_session'], 'repeat_app_subject_semester_index');
        });

        Schema::table('subject_registrations', function (Blueprint $table) {
            $table->string('registration_type', 10)->default('regular')->after('registration_id');
            $table->unsignedBigInteger('repeat_application_id')->nullable()->after('application_id');
            $table->foreign('repeat_application_id', 'subject_reg_repeat_application_foreign')
                ->references('repeat_application_id')->on('repeat_subject_applications')->restrictOnDelete();
            $table->index(['registration_type', 'student_id'], 'subject_reg_type_student_index');
        });
    }

    public function down(): void
    {
        Schema::table('subject_registrations', function (Blueprint $table) {
            $table->dropForeign('subject_reg_repeat_application_foreign');
            $table->dropIndex('subject_reg_type_student_index');
            $table->dropColumn(['registration_type', 'repeat_application_id']);
        });

        Schema::dropIfExists('repeat_subject_applications');

        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign('classes_structure_id_foreign');
            $table->dropIndex('classes_repeat_lookup_index');
            $table->dropColumn(['class_type', 'structure_id']);
        });
    }
};
