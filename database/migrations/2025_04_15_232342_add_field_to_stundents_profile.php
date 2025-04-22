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
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->integer('realCampusId')->nullable();
            $table->integer('collegeId')->nullable();
            $table->integer('termId')->nullable();
            $table->string('campusName')->nullable();
            $table->string('collegeName')->nullable();
            $table->string('programName')->nullable();
            $table->string('term')->nullable();
            $table->string('majorDiscDesc')->nullable();
            $table->string('programCode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->dropColumn(columns: 'realCampusId');
            $table->dropColumn(columns: 'collegeId');
            $table->dropColumn(columns: 'termId');
            $table->dropColumn(columns: 'campusName');
            $table->dropColumn(columns: 'collegeName');
            $table->dropColumn(columns: 'programName');
            $table->dropColumn(columns: 'term');
            $table->dropColumn(columns: 'majorDiscDesc');
            $table->dropColumn(columns: 'programCode');
        });
    }
};
