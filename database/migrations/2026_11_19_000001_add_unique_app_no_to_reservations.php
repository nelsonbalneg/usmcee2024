<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        app(\App\Services\ReservationNumberAudit::class)->assertValid();

        if (! Schema::hasIndex('reservations', 'reservations_app_no_unique')) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->unique('app_no', 'reservations_app_no_unique');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasIndex('reservations', 'reservations_app_no_unique')) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->dropUnique('reservations_app_no_unique');
            });
        }
    }
};
