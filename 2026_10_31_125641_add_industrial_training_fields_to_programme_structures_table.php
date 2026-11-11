<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programme_structures', function (Blueprint $table) {
            $table->boolean('has_industrial_training')
                ->default(false);

            $table->unsignedTinyInteger('industrial_training_semester')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('programme_structures', function (Blueprint $table) {
            $table->dropColumn([
                'has_industrial_training',
                'industrial_training_semester',
            ]);
        });
    }
};