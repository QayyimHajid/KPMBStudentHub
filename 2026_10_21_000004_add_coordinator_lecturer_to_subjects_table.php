<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('coordinator_lecturer_id', 20)
                ->nullable()
                ->after('status');

            $table->foreign('coordinator_lecturer_id')
                ->references('lecturer_id')
                ->on('lecturers')
                ->nullOnDelete();

            $table->index('coordinator_lecturer_id');
        });
    }

    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['coordinator_lecturer_id']);
            $table->dropIndex(['coordinator_lecturer_id']);
            $table->dropColumn('coordinator_lecturer_id');
        });
    }
};
