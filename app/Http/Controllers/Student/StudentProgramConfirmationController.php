<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Result;
use App\Models\Reservation;
use App\Models\Requirements;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\StundentProfile;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class StudentProgramConfirmationController extends Controller
{
    public function index()
    {

        $user_id = Auth::user()->id;

        // Get confirmed reservation details
        $reservation = Reservation::where('user_id', $user_id)
            ->where('status', 'confirmed')
            ->first();

        //fetch the Sitesettings
        $site_settings = DB::table('site_settings')->first();
        $start_batch_2_prereg = Carbon::parse($site_settings->start_prereg_second_batch);
        $end_batch_2_prereg = Carbon::parse($site_settings->end_prereg_second_batch);

        //fetch the CSA
        $result = Result::where('user_id', $user_id)
            ->where('app_no', $reservation->app_no)
            ->where('status', 'posted')
            ->first();

        if (!$reservation) {
            return redirect()->back()->with('error', 'No confirmed reservation found.');
        }

        $prog_policy_id = $reservation->firstprogram_policy_id;

        //check if the user submitted requirements or has been published and check if there is a profile and published
        $has_requirement = Requirements::where('user_id', $user_id)->where('req_status', 1)->first();

        //check if the user submitted additional requirements or has been published and check if there is a profile and published
        $has_additional_requirement = Requirements::where('user_id', $user_id)->where('additional_req_status', 1)->first();


        // Get the CEE profile of the student
        $cee_profile = StundentProfile::where('user_id', $user_id)->first() ?? new StundentProfile();

        //count total prereg for the specific program policy id
        $total_prereg_by_prog_policy_id = StundentProfile::where('policyId', $prog_policy_id)
            ->where('prereg_status', '==', 'pending')
            ->count();

        // Initialize program data and is_qualified_pre_reg for first priority
        $programData = null;
        $is_qualified_pre_reg = null;
        $slot_remaning = null;

        //check if the student data hass policy id
        // if ($cee_profile || $cee_profile->policyId != null || $cee_profile->policyId == 6 || $cee_profile->confirmation_batch == 2) {
        //     return redirect()->route('student.confirm-program-ranking.second-batch.index');
        // }

        // } else {
        //     $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");

        // }

        if ($cee_profile->confirmation_batch == 2 && $cee_profile->campus_id != null) {
            return redirect()->route('student.confirm-program-ranking.second-batch.index');
        }

        $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");
        // Fetch program policy data from external API
        if ($programResponse->successful()) {
            $programData = json_decode($programResponse->body(), true);

            //compare the CSA and to usmceefp from API
            // if ($result && isset($programData['usmceefp']) && $result->csa >= $programData['usmceefp'] && $result->confirmation_batch == 1) {
            if ($result) {
                if ($result->confirmation_batch == 1 && !now()->between($start_batch_2_prereg, $end_batch_2_prereg) || $cee_profile->prereg_status == 'pending') {
                    $is_qualified_pre_reg = 1;


                    $slot_remaning = $programData['pendingLimit'] - $total_prereg_by_prog_policy_id;

                } elseif (now()->between($start_batch_2_prereg, $end_batch_2_prereg) && ($result->confirmation_batch == 1 || $result->confirmation_batch == 2)) {
                    $is_qualified_pre_reg = 0;
                }
            }


        } else {
            return redirect()->back()->with('error', 'Unable to fetch program details from the server.');
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


        return view('student.prereg.program-confirmation', compact(
            'reservation',
            'cee_profile',
            'programData',
            'is_qualified_pre_reg',
            'has_requirement',
            'slot_remaning',
            'has_additional_requirement',
            'site_settings',
            'result',
            'has_policy_id',
            'programDataBatch2'
        ));
    }

    public function confirmProgram(Request $request)
    {
        $userId = Auth::user()->id;

        $prog_policy_id = $request->program_policy_id;

        $slot_remaning = null;

        //count total prereg for the specific program policy id
        $total_prereg_by_prog_policy_id = StundentProfile::where('policyId', $prog_policy_id)
            ->where('prereg_status', '==', 'pending')
            ->count();

        try {
            Log::info("Fetching program policy for user_id: {$userId}, policy_id: {$prog_policy_id}");

            // Fetch program policy data from external API
            $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");

            if (!$programResponse->successful()) {
                Log::warning("API call failed for policy_id: {$prog_policy_id}, status: " . $programResponse->status());
                return redirect()->back()->with('error', 'Failed to fetch program data.');
            }

            $data = $programResponse->json();

            //count the preregister and minus it to the
            //if $data['pendingLimit'] != null get the remaining from majorSlotRemaining else programSlotRemaining
            $slot_remaning = $data['pendingLimit'] - $total_prereg_by_prog_policy_id;
            if ($slot_remaning <= 0) {
                return redirect()->back()->with('error', 'No slot remaining for this program.');
            }

            Log::info('Program data fetched successfully', $data);

            DB::beginTransaction();

            $profile = StundentProfile::updateOrCreate(
                ['user_id' => $userId],
                [
                    'policyId' => $data['id'] ?? null,
                    'campus_id' => $data['campusId'] ?? null,
                    'prog_id' => $data['programId'] ?? null,
                    'major_disc_id' => $data['majorDiscId'] ?? null,
                    'collegeId' => $data['collegeId'] ?? null,
                    'termId' => $data['termId'] ?? null,
                    'programName' => $data['programName'] ?? null,
                    'collegeName' => $data['collegeName'] ?? null,
                    'campusName' => $data['campusName'] ?? null,
                    'term' => $data['term'] ?? null,
                    'majorDiscDesc' => $data['majorDiscDesc'] ?? null,
                    'programCode' => $data['programCode'] ?? null,
                    'realCampusId' => $data['realCampusId'] ?? null,
                    'prereg_status' => 'pending',
                    'current_step' => 6,
                    'date_confirmed' => now(),
                ]
            );

            Log::info("Student profile updated for user_id: {$userId}", ['profile' => $profile]);

            DB::commit();

            return response()->json(['success' => true]); // Return JSON, not redirect

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving program info: ' . $e->getMessage(), [
                'user_id' => $userId,
                'program_policy_id' => $prog_policy_id,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Something went wrong while saving.');
        }
    }

    //program confirmation for batch 2s
    public function storeSelectProgramBatch2(Request $request)
    {
        $userId = Auth::user()->id;

        // Wrap entire logic in try-catch to track unexpected issues as well
        try {
            $user_data = User::findOrFail($userId);
            $app_no = Reservation::where('user_id', $userId)->firstOrFail();

            $prog_policy_id = $request->program_policy_id;


            Log::info('Incoming program policy ID', ['user_id' => $userId, 'program_policy_id' => $prog_policy_id]);

            // Log request payload
            Log::info('Full request data', $request->all());

            DB::beginTransaction();

            StundentProfile::updateOrCreate(
                ['user_id' => $userId],
                [
                    'app_no' => $app_no->app_no,
                    'last_name' => $user_data->lastname,
                    'middle_name' => $user_data->middlename,
                    'first_name' => $user_data->firstname,
                    'date_of_birth' => $user_data->birthdate,
                    'gender' => $user_data->sex,
                    'mobile_no' => $user_data->phone,
                    'email' => $user_data->email,
                    'policyId' => $prog_policy_id,
                    'current_step' => 0,
                    'prereg_status' => 'for_ranking',
                    'confirmation_batch' => 2,
                    'date_program_selected' => now(),
                ]
            );

            DB::commit();
            Log::info('Program policy ID saved successfully', ['user_id' => $userId]);

            return response()->json(['success' => true]);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            Log::warning('Validation failed', [
                'user_id' => $userId,
                'errors' => $ve->errors()
            ]);
            return response()->json(['success' => false, 'message' => 'Validation error', 'errors' => $ve->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving program info', [
                'user_id' => $userId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Something went wrong while saving.'], 500);
        }
    }

    //program confirmation for batch 2
    public function storeConfirmProgramBatch2(Request $request)
    {
        $userId = Auth::user()->id;

        $prog_policy_id = $request->program_policy_id;
        try {
            Log::info("Fetching program policy for user_id: {$userId}, policy_id: {$prog_policy_id}");

            // Fetch program policy data from external API
            $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");

            if (!$programResponse->successful()) {
                Log::warning("API call failed for policy_id: {$prog_policy_id}, status: " . $programResponse->status());
                return redirect()->back()->with('error', 'Failed to fetch program data.');
            }

            $data = $programResponse->json();

            Log::info('Program data fetched successfully', $data);

            DB::beginTransaction();

            $profile = StundentProfile::updateOrCreate(
                ['user_id' => $userId],
                [
                    'policyId' => $data['id'] ?? null,
                    'campus_id' => $data['campusId'] ?? null,
                    'prog_id' => $data['programId'] ?? null,
                    'major_disc_id' => $data['majorDiscId'] ?? null,
                    'collegeId' => $data['collegeId'] ?? null,
                    'termId' => $data['termId'] ?? null,
                    'programName' => $data['programName'] ?? null,
                    'collegeName' => $data['collegeName'] ?? null,
                    'campusName' => $data['campusName'] ?? null,
                    'term' => $data['term'] ?? null,
                    'majorDiscDesc' => $data['majorDiscDesc'] ?? null,
                    'programCode' => $data['programCode'] ?? null,
                    'realCampusId' => $data['realCampusId'] ?? null,
                    'prereg_status' => 'for_ranking',
                    'current_step' => 6,
                    'date_confirmed' => now(),
                ]
            );

            Log::info("Student profile updated for user_id: {$userId}", ['profile' => $profile]);

            DB::commit();

            return response()->json(['success' => true]); // Return JSON, not redirect

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving program info: ' . $e->getMessage(), [
                'user_id' => $userId,
                'program_policy_id' => $prog_policy_id,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('student.program-confirmation.index')->with('error', 'Something went wrong while saving.');
        }
    }

    public function programBatch2index()
    {

        $user_id = Auth::user()->id;

        // Get the CEE profile of the student
        $prereg_profile = StundentProfile::where('user_id', $user_id)
            ->whereNotNull('prereg_status')
            ->whereNotNull('policyId')
            ->first();

        //check if has policy id
        $has_policy_id = null;

        if (!$prereg_profile || $prereg_profile->policyId == null) {
            $has_policy_id = 0;
        } else {
            $has_policy_id = 1;
        }

        return view('student.prereg.prereg-batch-2', compact(
            'prereg_profile',
            'has_policy_id'
        ));
    }
}
