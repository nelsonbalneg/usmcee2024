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
            //1 is CWTS
            //2 ROTC
            $table->integer('nstp')->default(2)->nullable();
            //0 did not answered
            //1 ansered
            $table->integer('is_answered_nstp')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stundent_profiles', function (Blueprint $table) {
            $table->dropColumn(columns: 'nstp');
            $table->dropColumn(columns: 'is_answered_nstp');
        });
    }
};
