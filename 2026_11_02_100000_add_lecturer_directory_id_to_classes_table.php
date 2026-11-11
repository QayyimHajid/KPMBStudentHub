<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('classes', 'lecturer_directory_id')) {
            Schema::table('classes', function (Blueprint $table) {
                $table->foreignId('lecturer_directory_id')
                    ->nullable()
                    ->after('lecturer_id')
                    ->constrained('lecturer_directory')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('classes', 'lecturer_directory_id')) {
            Schema::table('classes', function (Blueprint $table) {
                $table->dropConstrainedForeignId('lecturer_directory_id');
            });
        }
    }
};
