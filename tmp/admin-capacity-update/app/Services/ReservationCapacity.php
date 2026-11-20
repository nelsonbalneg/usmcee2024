<?php

namespace App\Services;

use App\Models\CeeSession;
use App\Models\Reservation;
use App\Models\Room;
use Closure;
use Illuminate\Validation\ValidationException;

class ReservationCapacity
{
    public function delete(int $id): void
    {
        $this->locked($id, function (Reservation $reservation) {
            if ($this->occupiesSlot($reservation->status)) {
                Room::whereKey($reservation->room_id)->lockForUpdate()->firstOrFail()->increment('capacity');
            }
            $reservation->delete();
        });
    }

    public function updateStatus(int $id, string $status): void
    {
        $this->locked($id, function (Reservation $reservation) use ($status) {
            if ($reservation->status === $status) {
                return;
            }
            $wasOccupied = $this->occupiesSlot($reservation->status);
            $willBeOccupied = $this->occupiesSlot($status);
            if ($wasOccupied !== $willBeOccupied) {
                $room = Room::whereKey($reservation->room_id)->lockForUpdate()->firstOrFail();
                if ($willBeOccupied) {
                    if ($room->status !== 'active' || $room->capacity < 1) {
                        throw ValidationException::withMessages(['status' => 'This room has no available slots. The reservation remains cancelled.']);
                    }
                    if (Reservation::where('cee_session_id', $reservation->cee_session_id)
                        ->where('user_id', $reservation->user_id)->whereKeyNot($reservation->id)
                        ->whereIn('status', ['pending', 'confirmed'])->exists()) {
                        throw ValidationException::withMessages(['status' => 'This applicant already has another pending or confirmed reservation in this session.']);
                    }
                    $room->decrement('capacity');
                } else {
                    $room->increment('capacity');
                }
            }
            $reservation->status = $status;
            $reservation->save();
        });
    }

    private function occupiesSlot(?string $status): bool
    {
        return in_array($status, ['pending', 'confirmed'], true);
    }

    private function locked(int $id, Closure $operation): mixed
    {
        return app(ReservationTransaction::class)->run(function () use ($id, $operation) {
            $snapshot = Reservation::findOrFail($id);
            // Match booking's lock order so create/cancel/delete share the same session gate.
            CeeSession::whereKey($snapshot->cee_session_id)->lockForUpdate()->firstOrFail();
            $reservation = Reservation::whereKey($id)->lockForUpdate()->firstOrFail();
            return $operation($reservation);
        });
    }
}
