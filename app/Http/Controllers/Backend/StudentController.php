<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Result;
use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function dashboard()
    {
        $checkEmptyFields = User::where(function ($query) {
            $query->whereNull('lrn')
                ->orWhere('lrn', '');
        })->exists();
        // ->where('id', Auth::user()->id)
        // ->where(function ($query) {
        //     $query->whereNull('birthdate')
        //         ->orWhere('birthdate', '');
        // })
        // ->exists();

        if ($checkEmptyFields) {

            $studentdetails = User::where('id', Auth::user()->id)->first();
            $ceeActiveession = CeeSession::where('status', 'active')->first();

            //check if records exists
            $isreservation_exist = Reservation::where('user_id', Auth::user()->id)->count();

             //check if it has result
        $cee_result = Result::where('user_id', Auth::user()->id)->where('status', 'posted')->first();

            $cee_reservation_records = DB::table('reservations')
                ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->where('reservations.user_id', Auth::user()->id)
                ->select(
                    'reservations.user_id',
                    'reservations.app_no',
                    'reservations.firstpriorty_desc',
                    'reservations.secondpriority_desc',
                    'reservations.thirdpriorty_desc',
                    'reservations.campus_id',
                    'reservations.campus_id_prio_prog_2',
                    'reservations.campus_id_prio_prog_3',
                    'reservations.is_repeat_exam',
                    'reservations.status',
                    'reservations.created_at',
                    'reservations.cee_session_id',
                    'rooms.room_name',
                    'rooms.college_name',
                    'rooms.exam_session',
                    'rooms.campus',
                    'rooms.time',
                    'rooms.schedule'
                )
                ->orderBy('reservations.created_at', 'desc')
                ->get();

            return view("student.profile.profile", compact('studentdetails', 'ceeActiveession', 'isreservation_exist', 'cee_reservation_records','cee_result'))->with('alert', 'Please take time to complete your profile to be able to reserve a slot in USM-CEE 2025');
        } else {


            // return view('student.dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
