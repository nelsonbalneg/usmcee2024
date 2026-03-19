<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CeeSession;
use App\Models\Requirements;
use App\Models\Reservation;
use App\Models\Result;
use App\Models\StundentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;


class StudentProgramConfirmationController extends Controller
{
    // public function index()
    // {

    //     $user_id = Auth::user()->id;

    //     // Get confirmed reservation details
    //     $reservation = Reservation::where('user_id', $user_id)
    //         ->where('status', 'confirmed')
    //         ->first();

    //     //fetch the Sitesettings
    //     $site_settings = DB::table('site_settings')->first();
    //     $start_batch_2_prereg = Carbon::parse($site_settings->start_prereg_second_batch);
    //     $end_batch_2_prereg = Carbon::parse($site_settings->end_prereg_second_batch);

    //     //fetch the CSA
    //     $result = Result::where('user_id', $user_id)
    //         ->where('app_no', $reservation->app_no)
    //         ->where('status', 'posted')
    //         ->first();

    //     if (!$reservation) {
    //         return redirect()->back()->with('error', 'No confirmed reservation found.');
    //     }

    //     $prog_policy_id = $reservation->firstprogram_policy_id;

    //     //check if the user submitted requirements or has been published and check if there is a profile and published
    //     $has_requirement = Requirements::where('user_id', $user_id)->where('req_status', 1)->first();

    //     //check if the user submitted additional requirements or has been published and check if there is a profile and published
    //     $has_additional_requirement = Requirements::where('user_id', $user_id)->where('additional_req_status', 1)->first();


    //     // Get the CEE profile of the student
    //     $cee_profile = StundentProfile::where('user_id', $user_id)->first() ?? new StundentProfile();

    //     //count total prereg for the specific program policy id
    //     $total_prereg_by_prog_policy_id = StundentProfile::where('policyId', $prog_policy_id)
    //         ->where('prereg_status', '==', 'pending')
    //         ->count();

    //     //get the uploded requirements
    //     $requirements_submitted = DB::table('student_requirements')
    //         ->where('student_id', Auth::user()->id)
    //         ->first();


    //     // Initialize program data and is_qualified_pre_reg for first priority
    //     $programData = null;
    //     $is_qualified_pre_reg = null;
    //     $slot_remaning = null;

    //     if ($cee_profile->confirmation_batch == 2 && $cee_profile->campus_id != null) {
    //         return redirect()->route('student.confirm-program-ranking.second-batch.index');
    //     }

    //     $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");
    //     // Fetch program policy data from external API
    //     if ($programResponse->successful()) {
    //         $programData = json_decode($programResponse->body(), true);

    //         //compare the CSA and to usmceefp from API
    //         if ($result) {
    //             if ($result->confirmation_batch == 1 && !now()->between($start_batch_2_prereg, $end_batch_2_prereg) || $cee_profile->prereg_status == 'pending') {
    //                 $is_qualified_pre_reg = 1;


    //                 $slot_remaning = $programData['pendingLimit'] - $total_prereg_by_prog_policy_id;

    //             } elseif (now()->between($start_batch_2_prereg, $end_batch_2_prereg) && ($result->confirmation_batch == 1 || $result->confirmation_batch == 2)) {
    //                 $is_qualified_pre_reg = 0;
    //             }
    //         }


    //     } else {
    //         return redirect()->back()->with('error', 'Unable to fetch program details from the server.');
    //     }

    //     $programDataBatch2 = null;
    //     $has_policy_id = null;
    //     $cee_profile = StundentProfile::where('user_id', Auth::user()->id)->first();

    //     if (!$cee_profile || $cee_profile->policyId == null) {
    //         $has_policy_id = 0;
    //     } else {
    //         //fetch the selected program for batch 2
    //         $programResponseBatch2 = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$cee_profile->policyId}");
    //         if ($programResponseBatch2->successful()) {
    //             $programDataBatch2 = json_decode($programResponseBatch2->body(), true);
    //             $has_policy_id = 1;
    //         } else {
    //             return redirect()->back()->with('error', 'Unable to fetch program details from the server.');
    //         }
    //     }


    //     return view('student.prereg.program-confirmation', compact(
    //         'reservation',
    //         'cee_profile',
    //         'programData',
    //         'is_qualified_pre_reg',
    //         'has_requirement',
    //         'slot_remaning',
    //         'has_additional_requirement',
    //         'site_settings',
    //         'result',
    //         'has_policy_id',
    //         'programDataBatch2',
    //         'requirements_submitted',
    //     ));
    // }

    public function index()
    {
        $user_id = Auth::id();

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()->back()->with('error', 'No active CEE session found.');
        }

        // Get confirmed reservation details for active term only
        $reservation = Reservation::where('user_id', $user_id)
            ->where('status', 'confirmed')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        if (!$reservation) {
            return redirect()->back()->with('error', 'No confirmed reservation found.');
        }

        // fetch the site settings
        $site_settings = DB::table('site_settings')->first();

        $start_batch_2_prereg = $site_settings && $site_settings->start_prereg_second_batch
            ? Carbon::parse($site_settings->start_prereg_second_batch)
            : null;

        $end_batch_2_prereg = $site_settings && $site_settings->end_prereg_second_batch
            ? Carbon::parse($site_settings->end_prereg_second_batch)
            : null;

        // fetch the CSA / posted result for active term only
        $result = Result::where('user_id', $user_id)
            ->where('app_no', $reservation->app_no)
            ->where('status', 'posted')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        $prog_policy_id = $reservation->firstprogram_policy_id;

        // check if the user submitted requirements
        // Add ->where('preregistration_id', $cee_session->id) if the table supports it
        $has_requirement = Requirements::where('user_id', $user_id)
            ->where('req_status', 1)
            ->first();

        $has_additional_requirement = Requirements::where('user_id', $user_id)
            ->where('additional_req_status', 1)
            ->first();

        // Get the active-term student profile
        $cee_profile = StundentProfile::where('user_id', $user_id)
            ->where('preregistration_id', $cee_session->id)
            ->first() ?? new StundentProfile();

        // count total prereg for the specific program policy id in the active term
        $total_prereg_by_prog_policy_id = StundentProfile::where('policyId', $prog_policy_id)
            ->where('preregistration_id', $cee_session->id)
            ->where('prereg_status', 'pending')
            ->count();

        // get the uploaded requirements
        $requirements_submitted = DB::table('student_requirements')
            ->where('student_id', $user_id)
            ->first();

        $programData = null;
        $is_qualified_pre_reg = null;
        $slot_remaning = null;

        if (($cee_profile->confirmation_batch ?? null) == 2 && !is_null($cee_profile->campus_id ?? null)) {
            return redirect()->route('student.confirm-program-ranking.second-batch.index');
        }

        $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");

        if ($programResponse->successful()) {
            $programData = $programResponse->json();

            if ($result) {
                $isWithinBatch2Window = $start_batch_2_prereg && $end_batch_2_prereg
                    ? now()->between($start_batch_2_prereg, $end_batch_2_prereg)
                    : false;

                if (
                    (
                        ($result->confirmation_batch ?? null) == 1 && !$isWithinBatch2Window
                    ) || (($cee_profile->prereg_status ?? null) === 'pending')
                ) {
                    $is_qualified_pre_reg = 1;
                    $slot_remaning = ($programData['pendingLimit'] ?? 0) - $total_prereg_by_prog_policy_id;
                } elseif (
                    $isWithinBatch2Window &&
                    in_array(($result->confirmation_batch ?? null), [1, 2])
                ) {
                    $is_qualified_pre_reg = 0;
                }
            }
        } else {
            return redirect()->back()->with('error', 'Unable to fetch program details from the server.');
        }

        $programDataBatch2 = null;
        $has_policy_id = null;

        if (!$cee_profile || is_null($cee_profile->policyId)) {
            $has_policy_id = 0;
        } else {
            $programResponseBatch2 = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$cee_profile->policyId}");

            if ($programResponseBatch2->successful()) {
                $programDataBatch2 = $programResponseBatch2->json();
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
            'programDataBatch2',
            'requirements_submitted',
        ));
    }

    public function confirmProgram(Request $request)
    {
        $userId = Auth::id();

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return response()->json([
                'success' => false,
                'message' => 'No active CEE session found.'
            ], 404);
        }

        $validated = $request->validate([
            'program_policy_id' => 'required|integer',
        ]);

        $prog_policy_id = $validated['program_policy_id'];

        try {
            Log::info("Fetching program policy for user_id: {$userId}, policy_id: {$prog_policy_id}");

            // count preregistered students for this program in the active term
            $total_prereg_by_prog_policy_id = StundentProfile::where('policyId', $prog_policy_id)
                ->where('preregistration_id', $cee_session->id)
                ->where('prereg_status', 'pending')
                ->count();

            // Fetch program policy data from external API
            $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");

            if (!$programResponse->successful()) {
                Log::warning("API call failed for policy_id: {$prog_policy_id}, status: " . $programResponse->status());

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch program data.'
                ], 422);
            }

            $data = $programResponse->json();

            $slot_remaning = ($data['pendingLimit'] ?? 0) - $total_prereg_by_prog_policy_id;

            if ($slot_remaning <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No slot remaining for this program.'
                ], 422);
            }

            Log::info('Program data fetched successfully', $data);

            DB::beginTransaction();

            $profile = StundentProfile::updateOrCreate(
                [
                    'user_id' => $userId,
                    'preregistration_id' => $cee_session->id,
                ],
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
                    'date_program_selected' => now(),
                    'date_confirmed' => now(),
                ]
            );

            Log::info("Student profile updated for user_id: {$userId}", ['profile' => $profile]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Program confirmed successfully.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error saving program info: ' . $e->getMessage(), [
                'user_id' => $userId,
                'program_policy_id' => $prog_policy_id,
                'preregistration_id' => $cee_session->id ?? null,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while saving.'
            ], 500);
        }
    }

    //program confirmation for batch 2s
    public function storeSelectProgramBatch2(Request $request)
    {
        $userId = Auth::id();

        try {
            $cee_session = CeeSession::where('status', 'active')->first();

            if (!$cee_session) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active CEE session found.'
                ], 404);
            }

            $validated = $request->validate([
                'program_policy_id' => 'required|integer',
            ]);

            $user_data = User::findOrFail($userId);

            $reservation = Reservation::where('user_id', $userId)
                ->where('status', 'confirmed')
                ->where('cee_session_id', $cee_session->id)
                ->firstOrFail();

            $prog_policy_id = $validated['program_policy_id'];

            $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");

            if (!$programResponse->successful()) {
                Log::warning("API call failed for policy_id: {$prog_policy_id}, status: " . $programResponse->status());

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch program data.'
                ], 422);
            }

            $data = $programResponse->json();

            Log::info('Incoming program policy ID', [
                'user_id' => $userId,
                'program_policy_id' => $prog_policy_id,
                'preregistration_id' => $cee_session->id,
            ]);

            Log::info('Full request data', $request->all());

            DB::beginTransaction();

            $profile = StundentProfile::updateOrCreate(
                [
                    'user_id' => $userId,
                    'preregistration_id' => $cee_session->id,
                ],
                [
                    'app_no' => $reservation->app_no,
                    'last_name' => $user_data->lastname,
                    'middle_name' => $user_data->middlename,
                    'first_name' => $user_data->firstname,
                    'date_of_birth' => $user_data->birthdate,
                    'gender' => $user_data->sex,
                    'mobile_no' => $user_data->phone,
                    'email' => $user_data->email,

                    'preregistration_id' => $cee_session->id,

                    'policyId' => $prog_policy_id,
                    'campus_id' => $data['campusId'] ?? null,
                    'prog_id' => $data['programId'] ?? null,
                    'major_disc_id' => $data['majorDiscId'] ?? null,
                    'collegeId' => $data['collegeId'] ?? null,
                    'termId' => $data['termId'] ?? null,
                    'programName' => $data['programName'] ?? null,
                    'collegeName' => $data['collegeName'] ?? null,
                    'majorDiscDesc' => $data['majorDiscDesc'] ?? null,
                    'campusName' => $data['campusName'] ?? ($data['realCampus'] ?? null),
                    'term' => $data['term'] ?? null,
                    'programCode' => $data['programCode'] ?? null,
                    'realCampusId' => $data['realCampusId'] ?? null,

                    'current_step' => 0,
                    'prereg_status' => 'for_ranking',
                    'confirmation_batch' => 2,
                    'date_program_selected' => now(),
                ]
            );

            DB::commit();

            Log::info('Program policy ID saved successfully', [
                'user_id' => $userId,
                'profile_id' => $profile->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Program selected successfully.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            Log::warning('Validation failed', [
                'user_id' => $userId,
                'errors' => $ve->errors()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $ve->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Required user or confirmed reservation was not found for the active session.'
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error saving program info', [
                'user_id' => $userId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while saving.'
            ], 500);
        }
    }

    //program confirmation for batch 2
    public function storeConfirmProgramBatch2(Request $request)
    {
        $userId = Auth::id();

        try {
            $cee_session = CeeSession::where('status', 'active')->first();

            if (!$cee_session) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active CEE session found.'
                ], 404);
            }

            $validated = $request->validate([
                'program_policy_id' => 'required|integer',
            ]);

            $prog_policy_id = $validated['program_policy_id'];

            Log::info("Fetching program policy for user_id: {$userId}, policy_id: {$prog_policy_id}");

            $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$prog_policy_id}");

            if (!$programResponse->successful()) {
                Log::warning("API call failed for policy_id: {$prog_policy_id}, status: " . $programResponse->status());

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch program data.'
                ], 422);
            }

            $data = $programResponse->json();

            Log::info('Program data fetched successfully', $data);

            DB::beginTransaction();

            $profile = StundentProfile::updateOrCreate(
                [
                    'user_id' => $userId,
                    'preregistration_id' => $cee_session->id,
                ],
                [
                    'policyId' => $data['id'] ?? null,
                    'campus_id' => $data['campusId'] ?? null,
                    'prog_id' => $data['programId'] ?? null,
                    'major_disc_id' => $data['majorDiscId'] ?? null,
                    'collegeId' => $data['collegeId'] ?? null,
                    'termId' => $data['termId'] ?? null,
                    'programName' => $data['programName'] ?? null,
                    'collegeName' => $data['collegeName'] ?? null,
                    'campusName' => $data['campusName'] ?? ($data['realCampus'] ?? null),
                    'term' => $data['term'] ?? null,
                    'majorDiscDesc' => $data['majorDiscDesc'] ?? null,
                    'programCode' => $data['programCode'] ?? null,
                    'realCampusId' => $data['realCampusId'] ?? null,
                    'prereg_status' => 'for_ranking',
                    'confirmation_batch' => 2,
                    'current_step' => 6,
                    'date_confirmed' => now(),
                ]
            );

            Log::info("Student profile updated for user_id: {$userId}", ['profile' => $profile]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Program confirmed successfully.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error saving program info: ' . $e->getMessage(), [
                'user_id' => $userId,
                'program_policy_id' => $request->program_policy_id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while saving.'
            ], 500);
        }
    }

    public function programBatch2index()
    {
        $user_id = Auth::id();

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()
                ->route('student.cee.result')
                ->with('error', 'No active CEE session found.');
        }

        $prereg_profile = StundentProfile::where('user_id', $user_id)
            ->where('preregistration_id', $cee_session->id)
            ->whereNotNull('prereg_status')
            ->whereNotNull('policyId')
            ->first();

        $has_policy_id = 0;

        if (!$prereg_profile || $prereg_profile->policyId == null) {
            return redirect()->route('student.cee.result');
        }

        $has_policy_id = 1;

        return view('student.prereg.prereg-batch-2', compact(
            'prereg_profile',
            'has_policy_id'
        ));
    }
}
