<?php

namespace App\Services;

use App\Models\Reservation;

class ReservationApplicationNumber
{
    /** Call while holding the active CEE session row lock in a transaction. */
    public function next(int $sessionId): string
    {
        $count = Reservation::where('cee_session_id', $sessionId)->count();
        // Small counts occupy the final four digits; five-digit counts stand alone.
        $sequence = max(10001, $count < 10000 ? 10000 + $count : $count);
        $prefix = now('Asia/Manila')->format('y') . $sessionId;

        do {
            $number = $prefix . $sequence++;
        } while (Reservation::where('app_no', $number)->exists());

        return $number;
    }
}
