<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facility_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->foreignId('facility_id')
                ->constrained('campus_facilities', 'facility_id')
                ->cascadeOnDelete();
            $table->string('image_path', 255);
            $table->boolean('is_primary')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['facility_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_images');
    }
};
