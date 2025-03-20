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
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('firstprogram_policy_id')->nullable();
            $table->integer('secondprogram_policy_id')->nullable();
            $table->integer('thirdprogram_policy_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(columns: 'firstprogram_policy_id');
            $table->dropColumn(columns: 'secondprogram_policy_id');
            $table->dropColumn(columns: 'thirdprogram_policy_id');
        });
    }
};
