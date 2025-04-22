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
            $table->datetime('date_confirmed')->nullable();
            $table->datetime('date_enrolled')->nullable();
            $table->datetime('date_denied')->nullable();
            $table->datetime('date_cancelled')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->dropColumn(columns: 'date_confirmed');
            $table->dropColumn(columns: 'date_enrolled');
            $table->dropColumn(columns: 'date_denied');
            $table->dropColumn(columns: 'date_cancelled');
        });
    }
};
