<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up(): void
    {
        Schema::create('programme_structures', function (Blueprint $table) {
            $table->id('structure_id');

            $table->unsignedBigInteger('programme_id');
            $table->string('intake_code', 30);
            $table->unsignedInteger('version')->default(1);

            $table->enum('status', [
                'draft',
                'verified',
                'published',
            ])->default('draft');

            $table->timestamps();

            $table->foreign('programme_id')
                ->references('programme_id')
                ->on('programmes')
                ->restrictOnDelete();

            $table->unique(
                ['programme_id', 'intake_code', 'version'],
                'programme_structure_version_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_structures');
    }
};
