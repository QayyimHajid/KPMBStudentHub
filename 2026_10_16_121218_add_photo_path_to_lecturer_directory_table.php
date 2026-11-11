<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lecturer_directory', function (Blueprint $table) {
            if (! Schema::hasColumn('lecturer_directory', 'photo_path')) {
                $table->string('photo_path')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('lecturer_directory', function (Blueprint $table) {
            $table->dropColumn('photo_path');
        });
    }
};
