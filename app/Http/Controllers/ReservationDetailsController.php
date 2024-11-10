<?php

namespace App\Http\Controllers;

use App\Models\ReservationDetail;
use Illuminate\Http\Request;

class ReservationDetailsController extends Controller
{
    /**
     * Store reservation details.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        try {
            $validated = $request->validate([
                'app_no' => 'required|string|unique:reservation_details,app_no',
                'lrn' => 'required|string',
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'birthdate' => 'required|date',
                'exam_session' => 'required|string',
                'room_id' => 'required|exists:rooms,id', // assuming the rooms table exists
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 400);
        }

        // Proceed with inserting the data if validation is successful
        $reservation = ReservationDetail::create([
            'app_no' => $validated['app_no'],
            'lrn' => $validated['lrn'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'birthdate' => $validated['birthdate'],
            'exam_session' => $validated['exam_session'],
            'room_id' => $validated['room_id'],
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $reservation
        ], 201); // 201 status code for successful creation
    }
}
