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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->datetime('start_prereg')->nullable();
            $table->datetime('end_prereg')->nullable();
            $table->datetime('start_prereg_second_batch')->nullable();
            $table->datetime('end_prereg_second_batch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(columns: 'start_prereg');
            $table->dropColumn(columns: 'end_prereg');
            $table->dropColumn(columns: 'start_prereg_second_batch');
            $table->dropColumn(columns: 'end_prereg_second_batch');
        });
    }
};
