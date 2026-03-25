<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CeeSession;
use App\Models\Requirements;
use App\Models\Reservation;
use App\Models\Result;
use App\Models\StudentRequirement;
use App\Models\StundentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentPreregController extends Controller
{
    // public function index()
    // {

    //     $userId = Auth::user()->id;

    //     $cee_profile = User::where('id', $userId)->first();

    //     $cee_active_session = CeeSession::where('status', 'active')->first();

    //     //get the app_no
    //     $app_no = Reservation::where('user_id', $userId)
    //         ->where('status', 'confirmed')
    //         ->where('cee_session_id', $cee_active_session->id)
    //         ->first();

    //     //check if there is a result
    //     $result = Result::where('user_id', $userId)->where('status', 'posted')
    //         ->where('app_no', $app_no->app_no)->first();

    //     //get the details from stundent_profile
    //     $applicant = StundentProfile::where('user_id', $userId)->where('app_no', $app_no->app_no)
    //         ->first();

    //     $is_applicant_exist = StundentProfile::where('user_id', $userId)->where('app_no', $app_no->app_no)
    //         ->where('applicant_profile_status', 1)
    //         ->first();

    //     //get the requirements in general
    //     $requirements = Requirements::where('user_id', $userId)->first();

    //     //fetch the Sitesettings
    //     $site_settings = DB::table('site_settings')->first();

    //     $is_tagged_complete_req = StudentRequirement::where('student_id', $userId)->count();


    //     //get the uploded requirements
    //     $requirements_submitted = DB::table('student_requirements')
    //         ->where('student_id', Auth::user()->id)
    //         ->first();

    //     return view('student.prereg.index', compact(
    //         'result',
    //         'applicant',
    //         'is_applicant_exist',
    //         'cee_profile',
    //         'requirements',
    //         'site_settings',
    //         'is_tagged_complete_req',
    //         'requirements_submitted',
    //     ));
    // }

    public function index()
    {
        $userId = Auth::id();

        $cee_profile = User::find($userId);

        $cee_active_session = CeeSession::where('status', 'active')->first();

        $result = null;
        $applicant = null;
        $is_applicant_exist = null;
        
        $requirements = Requirements::where('user_id', $userId)->first();
        $site_settings = DB::table('site_settings')->first();
        $is_tagged_complete_req = StudentRequirement::where('student_id', $userId)->count();
        $requirements_submitted = DB::table('student_requirements')
            ->where('student_id', $userId)
            ->first();

        $isPreregOpen = false;
        $preregMessage = 'Preregistration has ended.';

        if ($cee_active_session) {
            $app_no = Reservation::where('user_id', $userId)
                ->where('status', 'confirmed')
                ->where('cee_session_id', $cee_active_session->id)
                ->first();

            if ($app_no) {
                $result = Result::where('user_id', $userId)
                    ->where('status', 'posted')
                    ->where('app_no', $app_no->app_no)
                    ->first();

                $applicant = StundentProfile::where('user_id', $userId)
                    ->where('app_no', $app_no->app_no)
                    ->first();

                $is_applicant_exist = StundentProfile::where('user_id', $userId)
                    ->where('app_no', $app_no->app_no)
                    ->where('applicant_profile_status', 1)
                    ->first();
            }
        }

        if ($site_settings && $result && $result->csa >= 25) {
            $now = now();

            $startBatch1 = \Carbon\Carbon::parse($site_settings->start_prereg);
            $endBatch1 = \Carbon\Carbon::parse($site_settings->end_prereg);

            $startBatch2 = \Carbon\Carbon::parse($site_settings->start_prereg_second_batch);
            $endBatch2 = \Carbon\Carbon::parse($site_settings->end_prereg_second_batch);

            $isBatch1Window = $now->between($startBatch1, $endBatch1);
            $isBatch2Window = $now->between($startBatch2, $endBatch2);

            $confirmationBatch = (int) ($result->confirmation_batch ?? 0);

            // Batch 1 can access during batch 1 OR batch 2
            // Batch 2 can access only during batch 2
            $isPreregOpen =
                ($confirmationBatch === 1 && ($isBatch1Window || $isBatch2Window)) ||
                ($confirmationBatch === 2 && $isBatch2Window);

            if (!$isPreregOpen) {
                if ($confirmationBatch === 1 && $now->lt($startBatch1)) {
                    $preregMessage = 'Preregistration for your batch has not yet started.';
                } elseif ($confirmationBatch === 2 && $now->lt($startBatch2)) {
                    $preregMessage = 'Please wait for the second batch of preregistration.';
                } else {
                    $preregMessage = 'Preregistration has ended.';
                }
            } else {
                $preregMessage = null;
            }
        }

        return view('student.prereg.index', compact(
            'result',
            'applicant',
            'is_applicant_exist',
            'cee_profile',
            'requirements',
            'site_settings',
            'is_tagged_complete_req',
            'requirements_submitted',
            'isPreregOpen',
            'preregMessage'
        ));
    }
}
