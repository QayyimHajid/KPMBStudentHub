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
        Schema::table('students', function (Blueprint $table) {
            $table->text('home_address')->nullable();
            $table->string('guardian_name', 100)->nullable();
            $table->string('guardian_relationship', 50)->nullable();
            $table->string('guardian_phone', 20)->nullable();
            $table->string('guardian_occupation', 100)->nullable();
            $table->string('guardian_employer', 150)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'home_address',
                'guardian_name',
                'guardian_relationship',
                'guardian_phone',
                'guardian_occupation',
                'guardian_employer',
            ]);
        });
    }

};
