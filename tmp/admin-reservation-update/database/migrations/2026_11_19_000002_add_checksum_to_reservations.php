<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedInteger('checksum')->nullable();
        });

        DB::table('reservations')->select('id', 'app_no')->chunkById(500, function ($reservations) {
            foreach ($reservations as $reservation) {
                $number = (string) $reservation->app_no;
                if (!preg_match('/^[0-9]{2,}$/D', $number)) {
                    continue;
                }

                $checksum = (int) $number[0] * (int) $number[1];
                for ($index = 2; $index < strlen($number); $index++) {
                    $checksum += (int) $number[$index];
                }

                DB::table('reservations')->where('id', $reservation->id)->update(['checksum' => $checksum]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('checksum');
        });
    }
};
