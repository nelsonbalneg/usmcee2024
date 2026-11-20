<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasIndex('reservations', 'reservations_user_session_status_index')) {
            Schema::table('reservations', fn (Blueprint $table) =>
                $table->index(['user_id', 'cee_session_id', 'status'], 'reservations_user_session_status_index'));
        }
        if (!Schema::hasIndex('rooms', 'rooms_booking_selection_index')) {
            Schema::table('rooms', fn (Blueprint $table) =>
                $table->index(['cee_session_id', 'campus', 'status', 'sequence_no'], 'rooms_booking_selection_index'));
        }
    }

    public function down(): void
    {
        Schema::table('reservations', fn (Blueprint $table) => $table->dropIndex('reservations_user_session_status_index'));
        Schema::table('rooms', fn (Blueprint $table) => $table->dropIndex('rooms_booking_selection_index'));
    }
};
