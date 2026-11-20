<?php

namespace App\Services;

use App\Exceptions\ReservationSequenceExhausted;
use App\Models\CeeSession;
use App\Models\Reservation;
use App\Models\ReservationSequence;
use Illuminate\Support\Facades\DB;

class ReservationApplicationNumber
{
    /** Allocation and persistence always share a transaction, including caller work. */
    public function createReservation(int $sessionId, array $attributes): Reservation
    {
        return app(ReservationTransaction::class)->run(function () use ($sessionId, $attributes) {
            CeeSession::whereKey($sessionId)->lockForUpdate()->firstOrFail();
            $now = now('Asia/Manila');
            $query = ReservationSequence::where('year', $now->year)
                ->where('cee_session_id', $sessionId);
            $counter = (clone $query)->lockForUpdate()->first();
            if (!$counter) {
                // The session lock serializes first use; the unique key is the final guard.
                DB::table('reservation_sequences')->upsert([
                    'year' => (int) $now->format('Y'),
                    'cee_session_id' => $sessionId,
                    'last_sequence' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ], ['year', 'cee_session_id'], ['cee_session_id']);
                $counter = $query->lockForUpdate()->firstOrFail();
            }
            if ($counter->last_sequence >= 99999) {
                throw new ReservationSequenceExhausted("Application numbers exhausted for CEE session {$sessionId} in {$now->year}.");
            }
            $counter->last_sequence++;
            $counter->save();
            $reservation = new Reservation;
            $reservation->forceFill($attributes);
            $reservation->cee_session_id = $sessionId;
            $reservation->app_no = $now->format('y').$sessionId.str_pad($counter->last_sequence, 5, '0', STR_PAD_LEFT);
            $reservation->save();

            return $reservation;
        });
    }
}
