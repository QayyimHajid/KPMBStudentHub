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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id('programme_id');

            $table->string('programme_code', 20)->unique();
            $table->string('programme_name', 100);
            $table->enum('status', ['active', 'inactive'])
                ->default('active');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
