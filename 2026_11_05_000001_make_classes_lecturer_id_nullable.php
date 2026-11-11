<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Preserve all existing lecturer_id values while allowing directory-only lecturers.
        try {
            Schema::table('classes', function (Blueprint $table) {
                $table->dropForeign(['lecturer_id']);
            });
        } catch (\Throwable $e) {
            // The constraint may already have been removed in a manually adjusted database.
        }

        Schema::table('classes', function (Blueprint $table) {
            $table->string('lecturer_id', 20)->nullable()->change();
        });
    }

    public function down(): void
    {
        // Do not restore NOT NULL automatically: directory-only classes may have NULL lecturer_id.
        // Restoring the old constraint could fail or damage data after this migration is used.
    }
};
