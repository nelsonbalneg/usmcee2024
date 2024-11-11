<?php

namespace App\Http\Controllers\Student;

use PDF;
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use DB;

class CeeSlipController extends Controller
{

    public function generateceeExamSlip(Request $request)
    {
        $app_no = Crypt::decryptString($request->app_no);
        // $cee_reservation = Reservation::where('app_no',$app_no)->first();
        $cee_reservation = DB::table('reservations')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->where('reservations.app_no', $app_no)
            ->select(
                'reservations.user_id',
                'reservations.app_no',
                'reservations.firstpriorty_desc',
                'reservations.secondpriority_desc',
                'reservations.thirdpriorty_desc',
                'reservations.campus_id',
                'reservations.is_repeat_exam',
                'rooms.room_name',
                'rooms.college_name',
                'rooms.campus',
                'rooms.exam_session',
                'rooms.time',
                'rooms.schedule',
                'users.firstname',
                'users.lastname',
                'users.email',
                'users.sex',
                'users.phone',
                'users.photo',
                'users.birthdate'
            )
            ->first();

        $pdf = PDF::loadView('student.cee-slip.exam-slip', compact('cee_reservation'));

        // Stream the PDF instead of downloading it
        return $pdf->stream('usmcee-slip.pdf');
    }
}
