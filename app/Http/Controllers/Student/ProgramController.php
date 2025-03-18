<?php

namespace App\Http\Controllers\Student;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $decryptapp_no = unserialize(Crypt::decryptString($request->app_no));

        $examinee = DB::table('reservations as r')
            ->join('results as res', 'r.app_no', '=', 'res.app_no')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->join('cee_sessions as c', 'r.cee_session_id', '=', 'c.id')
            ->where('r.app_no', $decryptapp_no)
            ->first([
                'r.user_id',
                'r.app_no',
                'r.firstpriorty_desc',
                'r.secondpriority_desc',
                'r.thirdpriorty_desc',
                'r.campus_id',
                'r.is_repeat_exam',
                'u.email',
                'u.sex',
                'u.phone',
                'u.photo',
                'u.birthdate',
                'res.fullname',
                'res.science',
                'res.math',
                'res.humanities',
                'res.inductive',
                'res.csa',
                'res.created_at',
                'c.name as cee_session_name',
            ]);

        return view('student.programs.programs', ['app_no' => $decryptapp_no], compact('examinee'));
    }
}
