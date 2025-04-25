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
            $table->integer('student_type')->nullable()->change();
            $table->integer('freshmen_type')->nullable()->change();
            $table->integer('civil_status_id')->nullable()->change();
            $table->integer('religion_id')->nullable()->change();
            $table->integer('nationality_id')->nullable()->change();
            $table->float('height')->nullable()->change();
            $table->float('weight')->nullable()->change();
            $table->string('blood_type', 3)->nullable()->change();
            $table->string('place_of_birth',400 )->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_profiless', function (Blueprint $table) {
            //
        });
    }
};
