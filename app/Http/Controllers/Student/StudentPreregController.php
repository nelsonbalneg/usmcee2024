<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Result;
use App\Models\Reservation;
use App\Models\Requirements;
use Illuminate\Http\Request;
use App\Models\StundentProfile;
use App\Models\StudentRequirement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentPreregController extends Controller
{
    public function index()
    {

        $userId = Auth::user()->id;

        $cee_profile = User::where('id', $userId)->first();

        //get the app_no
        $app_no = Reservation::where('user_id', $userId)
            ->where('status', 'confirmed')->first();

        //check if there is a result
        $result = Result::where('user_id', $userId)->where('status', 'posted')
            ->where('app_no', $app_no->app_no)->first();

        //get the details from stundent_profile
        $applicant = StundentProfile::where('user_id', $userId)
            ->first();

        $is_applicant_exist = StundentProfile::where('user_id', $userId)
            ->where('applicant_profile_status', 1)
            ->first();

        //get the requirements in general
        $requirements = Requirements::where('user_id', $userId)->first();

        //fetch the Sitesettings
        $site_settings = DB::table('site_settings')->first();

        $is_tagged_complete_req = StudentRequirement::where('student_id', $userId)->count();


        //get the uploded requirements
        $requirements_submitted = DB::table('student_requirements')
            ->where('student_id', Auth::user()->id)
            ->first();

        return view('student.prereg.index', compact(
            'result',
            'applicant',
            'is_applicant_exist',
            'cee_profile',
            'requirements',
            'site_settings',
            'is_tagged_complete_req',
            'requirements_submitted',
        ));
    }
}
