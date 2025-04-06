<?php

namespace App\Http\Controllers\Student;

use App\Models\Result;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ChedApplicantProfile;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChedApplicantProfileRequest;
use Illuminate\Support\Facades\File;

class ChedApplicantProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get the existing details of the user during registration
        $cee_profile = User::where('id', Auth::user()->id)->first();

        //get the application number with confirmed status
        $app_no = Reservation::where('user_id', Auth::user()->id)
            ->where('status', 'confirmed')->first();

        //check if there is a result
        $result = Result::where('user_id', Auth::user()->id)->where('status', 'posted')->first();

        //fetch the if user exist in StudentProfile Table and prevent detching null if the user doe not have a profile yet
        //return a new StudentProfile instance
        $applicant = ChedApplicantProfile::where('user_id', Auth::user()->id)->first() ?? new ChedApplicantProfile();
        $is_applicant_exist = ChedApplicantProfile::where('user_id', Auth::user()->id)->first();


        // Read religions.json file
        $religions = [];
        $path = public_path('backend/assets/religion/religions.json'); // Ensure the path is correct
        if (File::exists($path)) {
            $religions = json_decode(File::get($path), true);
        }

        // Read nationality.json file
        $nationalities = [];
        $path_nationality = public_path('backend/assets/nationality/nationality.json'); // Ensure the path is correct
        if (File::exists($path_nationality)) {
            $nationalities = json_decode(File::get($path_nationality), true);
        }

        // Read tribes.json file
        $tribes = [];
        $path_tribe = public_path('backend/assets/tribe/tribes.json'); // Ensure the path is correct
        if (File::exists($path_tribe)) {
            $tribes = json_decode(File::get($path_tribe), true);
        }

        return view(
            'student.profile.ched-applicant-profile',
            compact(
                'cee_profile',
                'app_no',
                'result',
                'applicant',
                'is_applicant_exist',
                'religions',
                'nationalities',
                'tribes'
            )
        );
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
    public function store(ChedApplicantProfileRequest $request)
    {
        try {
            DB::beginTransaction();


            $data = $request->validated();

            // Log validated data (for debugging only — remove in production if it contains sensitive info)
            Log::info('CHED Applicant Profile - Validated Data:', $data);

            // Trim all string values in the validated data
            $data = array_map(function ($value) {
                return is_string($value) ? trim($value) : $value;
            }, $data);

            // Log user attempting to save, if applicable
            Log::info('Attempting to save CHED Applicant Profile', [
                'user_id' => $data['user_id'] ?? null,
                'app_no' => $data['app_no'] ?? null,
            ]);

            // Check if user_id exists and update or create
            ChedApplicantProfile::updateOrCreate(
                ['user_id' => $data['user_id']],
                $data
            );

            DB::commit();

            return redirect()->back()->with('success', 'USMCEE Applicant Profile saved! Please proceed to the next step.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log full exception trace
            Log::error('CHED Applicant Profile Saving Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data ?? [],
                'user' => Auth::user()?->id ?? 'guest'
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Something went wrong while saving the application. Please try again.'])
                ->withInput();
        }
    }

    //familybackgoundpage
    public function familybgIndex(ChedApplicantProfileRequest $request)
    {
        return view('student.profile.ched-applicant-profile-fam-bg');
    }

    public function publish(Request $request)
    {
        try {
            $userId = Auth::id();
            Log::info('Publish request initiated by user.', ['user_id' => $userId]);

            // Find the user's student profile
            $studentProfile = ChedApplicantProfile::where('user_id', $userId)->first();

            if (!$studentProfile) {
                Log::warning('Applicant profile not found.', ['user_id' => $userId]);
                return response()->json(['success' => false, 'message' => 'Applicant profile not found.'], 404);
            }

            // Update profile status to published (1)
            $studentProfile->update(['status' => '1']);
            Log::info('Profile published successfully.', ['user_id' => $userId]);

            return response()->json(['success' => true, 'message' => 'Applicant profile published successfully.']);
        } catch (\Exception $e) {
            Log::error('Error publishing profile.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
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
