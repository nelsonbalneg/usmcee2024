<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Result;
use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ResultController extends Controller
{
    public function index()
    {

        // $cee_term = CeeSession::where('status', 'active')->first();
        // $cee_term_active = $cee_term->id;

        // $reservation = Reservation::where('user_id', Auth::user()->id)
        //     ->where('cee_session_id', $cee_term_active)
        //     ->first();

        $reservation = User::where('id', Auth::user()->id)->first();

        $cee_result = Result::where('user_id', Auth::user()->id)
            ->where('status', 'posted')->get();

        return view("student.result.result", compact( 'cee_result','reservation'));
    }

    public function generateceeResultSlip($encryptedAppNo)
    {

        $decryptapp_no = unserialize(Crypt::decryptString($encryptedAppNo));

        // dd($decryptapp_no);

        $ceeresult = DB::table('reservations')
            ->join('results', 'reservations.app_no', '=', 'results.app_no')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->where('reservations.app_no', '=', $decryptapp_no)
            ->select(
                'reservations.user_id',
                'reservations.app_no',
                'reservations.firstpriorty_desc',
                'reservations.secondpriority_desc',
                'reservations.thirdpriorty_desc',
                'reservations.campus_id',
                'reservations.is_repeat_exam',
                'users.email',
                'users.sex',
                'users.phone',
                'users.photo',
                'users.birthdate',
                'results.fullname',
                'results.science',
                'results.math',
                'results.humanities',
                'results.inductive',
                'results.csa',
                'results.created_at',
                'cee_sessions.name',
                'rooms.schedule',
            )
            ->first();

        // dd($ceeresult);

        // Pass the base64 QR code string to the view for inclusion in the PDF
        $pdf = PDF::loadView('student.result.result-slip', compact('ceeresult'));

        // Stream the PDF instead of downloading it
        return $pdf->stream("{$ceeresult->app_no}-usmcee-result.pdf");
    }
}
