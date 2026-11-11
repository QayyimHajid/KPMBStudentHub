<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('next_group_id')->nullable()->after('group_id');
            $table->foreign('next_group_id')
                ->references('group_id')
                ->on('class_groups')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['next_group_id']);
            $table->dropColumn('next_group_id');
        });
    }
};
