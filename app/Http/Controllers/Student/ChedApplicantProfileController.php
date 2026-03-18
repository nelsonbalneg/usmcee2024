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

            // Trim all string values in the validated data
            $data = array_map(function ($value) {
                return is_string($value) ? trim($value) : $value;
            }, $data);

            // Check if user_id exists and update or create
            ChedApplicantProfile::updateOrCreate(
                ['user_id' => $data['user_id']],
                $data
            );

            DB::commit();

            return redirect()->route('student.ched-applicant-profile.index')->with('success', 'Your USMCEE Applicant Profile has been saved as a draft. Please take a moment to review all the details and ensure that the information you entered is accurate. If you find any errors, you may click the Update Information button to make the necessary corrections. Once you have verified that all details are correct, click the Submit and Publish button to finalize and submit your profile.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('student.ched-applicant-profile.index')
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

            // Find the user's student profile
            $studentProfile = ChedApplicantProfile::where('user_id', $userId)->first();

            if (!$studentProfile) {
                return response()->json(['success' => false, 'message' => 'Applicant profile not found.'], 404);
            }

            // Update profile status to published (1)
            $studentProfile->update(['status' => '1']);
            return response()->json(['success' => true, 'message' => 'Applicant profile published successfully.']);
        } catch (\Exception $e) {
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
