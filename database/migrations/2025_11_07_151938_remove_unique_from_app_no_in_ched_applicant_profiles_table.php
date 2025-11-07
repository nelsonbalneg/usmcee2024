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
        Schema::table('ched_applicant_profiles', function (Blueprint $table) {
             // Drop the unique index on 'app_no'
            $table->dropUnique(['app_no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ched_applicant_profiles', function (Blueprint $table) {
             // Restore the unique constraint if migration is rolled back
            $table->unique('app_no');
        });
    }
};
