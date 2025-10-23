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
             // Drop the old unique index first
            $table->dropUnique(['app_no']);

            // Modify the column to be nullable
            $table->string('app_no')->nullable()->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ched_applicant_profiles', function (Blueprint $table) {
             // Revert to non-nullable unique column
            $table->string('app_no')->unique(false)->nullable(false)->change();
        });
    }
};
