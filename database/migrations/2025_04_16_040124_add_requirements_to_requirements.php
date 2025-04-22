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
        Schema::table('requirements', function (Blueprint $table) {
            $table->json('hepa_b_test')->nullable();
            $table->json('chest_x_ray')->nullable();
            $table->json('preg_test')->nullable();
            $table->json('signature')->nullable();
            $table->json('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requirements', function (Blueprint $table) {
            $table->dropColumn(columns: 'hepa_b_test');
            $table->dropColumn(columns: 'chest_x_ray');
            $table->dropColumn(columns: 'preg_test');
            $table->dropColumn(columns: 'signature');
            $table->dropColumn(columns: 'photo');
        });
    }
};
