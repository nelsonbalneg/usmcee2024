<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Result;
use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\StundentProfile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ChedApplicantProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

        $is_ched_applicant_profile = ChedApplicantProfile::where('user_id', Auth::user()->id)
            ->where('status', '1')->first();

        return view("student.result.result", compact('cee_result', 'reservation', 'is_ched_applicant_profile'));
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

    public function viewResultMessageIndex($encryptedAppNo)
    {
        $decryptapp_no = unserialize(Crypt::decryptString($encryptedAppNo));

        //fetch the Sitesettings
        $site_settings = DB::table('site_settings')->first();
        $start_batch_2_prereg = Carbon::parse($site_settings->start_prereg_second_batch);
        $end_batch_2_prereg = Carbon::parse($site_settings->end_prereg_second_batch);

        $cee_result = DB::table('reservations')
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
                'users.created_at as user_created_at',
                'results.fullname',
                'users.lastname',
                'users.firstname',
                'users.middlename',
                'users.suffix',
                'results.science',
                'results.math',
                'results.humanities',
                'results.inductive',
                'results.csa',
                'results.confirmation_batch',
                'results.created_at',
                'cee_sessions.name',
                'rooms.schedule',
                'reservations.firstprogram_policy_id',
            )
            ->first();

        $programData = null;
        $is_qualified_pre_reg = null;

        $prog_policy_id = $cee_result->firstprogram_policy_id;
        $result = $cee_result->csa;


        //fetch from the API
        // Fetch program policy data from external API
        $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");

        if ($programResponse->successful()) {
            $programData = json_decode($programResponse->body(), true);

            //compare the CSA and to usmceefp from API
            if ($result && isset($programData['usmceefp']) && $result >= $programData['usmceefp'] && $cee_result->confirmation_batch == 1) {
                $is_qualified_pre_reg = 1;
            } elseif ($cee_result->confirmation_batch == 2) {
                $is_qualified_pre_reg = 0;
            } else {
                $is_qualified_pre_reg = 0;
            }

        } else {
            return redirect()->back()->with('error', 'Unable to fetch program details from the server.');
        }

        $qualifiedCampuses = null;
        $csa = (float) $result;


        // fetch all the programs for batch 2
        if (now()->between($start_batch_2_prereg, $end_batch_2_prereg)) {
            $programsfor_batch_2 = Http::get("http://172.16.0.60/academic/api/v2/CeeV/get-qualified-programs/{$csa}");

            if ($programsfor_batch_2->successful()) {
                $qualifiedCampuses = json_decode($programsfor_batch_2->body(), true);
            }
        }
        $programDataBatch2 = null;
        $has_policy_id = null;
        $cee_profile = StundentProfile::where('user_id', Auth::user()->id)->first();

        if (!$cee_profile || $cee_profile->policyId == null) {
            $has_policy_id = 0;
        } else {
            //fetch the selected program for batch 2
            $programResponseBatch2 = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$cee_profile->policyId}");
            if ($programResponseBatch2->successful()) {
                $programDataBatch2 = json_decode($programResponseBatch2->body(), true);
                $has_policy_id = 1;
            } else {
                return redirect()->back()->with('error', 'Unable to fetch program details from the server.');
            }
        }

        //get the uploded requirements
        $requirements_submitted = DB::table('student_requirements')
            ->where('student_id', Auth::user()->id)
            ->first();


        return view('student.result.result-message', compact(
            'cee_result',
            'is_qualified_pre_reg',
            'programResponse',
            'site_settings',
            'qualifiedCampuses',
            'has_policy_id',
            'cee_profile',
            'programDataBatch2',
            'requirements_submitted',
        ));
    }

    public function programFetchforBatch2()
    {

    }
}
