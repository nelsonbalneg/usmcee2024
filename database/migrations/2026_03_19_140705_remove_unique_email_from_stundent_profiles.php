<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->dropUnique('stundent_profiles_email_unique');
            $table->unique(['email', 'preregistration_id'], 'sp_email_prereg_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->dropUnique('sp_email_prereg_unique');
            $table->unique('email');
        });
    }
};
