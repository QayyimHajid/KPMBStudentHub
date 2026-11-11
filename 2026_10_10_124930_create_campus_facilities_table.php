
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campus_facilities', function (Blueprint $table) {
            $table->id('facility_id');

            $table->string('facility_name', 100);
            $table->string('facility_type', 50);
            $table->string('location', 100);
            $table->text('description')->nullable();
            $table->string('operating_hours', 100)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campus_facilities');
    }
};
