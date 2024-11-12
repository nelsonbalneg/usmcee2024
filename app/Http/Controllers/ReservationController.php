<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Get reservation details by ID and application number.
     *
     * @param string $id
     * @param string $app_no
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReservationByIdAndAppNo($id, $app_no)
    {
        // Check if the provided $id matches the predefined ID
        if ($id == '75b6ffd88b2b77d50aaece8d9e7e8cce') {
            // Find the reservation with the given app_no and join with the user
            $reservation = Reservation::with('applicant') // eager load the 'applicant' (User)
                ->where('app_no', $app_no)
                ->first();

            // Check if the reservation exists
            if ($reservation) {
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'reservation' => $reservation,
                        'user' => $reservation->applicant // Include the associated user
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Reservation not found'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Access not allowed'
            ], 403); // 403 for forbidden access
        }
    }
}
