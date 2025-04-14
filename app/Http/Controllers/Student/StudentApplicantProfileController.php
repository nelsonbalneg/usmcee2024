<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Result;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\StundentProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ChedApplicantProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\StoreStudentProfileRequest;

class StudentApplicantProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cee_profile = User::where('id', Auth::user()->id)->first();
        $app_no = Reservation::where('user_id', Auth::user()->id)
            ->where('status', 'confirmed')->first();

        //check if there is a result
        $result = Result::where('user_id', Auth::user()->id)->where('status', 'posted')->first();


        // get the data from chedprofile
        $ched_profile = ChedApplicantProfile::where('user_id', Auth::user()->id)
            ->where('status', '1')->first();

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

        //fetch the if user exist in StudentProfile Table and prevent detching null if the user doe not have a profile yet
        //return a new StudentProfile instance
        $applicant = StundentProfile::where('user_id', Auth::user()->id)->first() ?? new StundentProfile();
        $is_applicant_exist = StundentProfile::where('user_id', Auth::user()->id)->first();

        //resident address
        $applicant->res_region = $applicant->res_region ?? '';
        $applicant->res_province = $applicant->res_province ?? '';
        $applicant->res_towncity = $applicant->res_towncity ?? '';
        $applicant->res_barangay = $applicant->res_barangay ?? '';

        //permanent address
        $applicant->perm_address = $applicant->perm_address ?? '';
        $applicant->perm_address_province = $applicant->perm_address_province ?? '';
        $applicant->perm_address_towncity = $applicant->perm_address_towncity ?? '';
        $applicant->perm_address_barangay = $applicant->perm_address_barangay ?? '';

        //guardian address
        $applicant->guardian_address = $applicant->guardian_address ?? '';
        $applicant->guardian_address_province = $applicant->guardian_address_province ?? '';
        $applicant->guardian_address_towncity = $applicant->guardian_address_towncity ?? '';
        $applicant->guardian_address_barangay = $applicant->guardian_address_barangay ?? '';

        // dd($applicant);


        return view('student.profile.applicant-profile', compact('cee_profile', 'religions', 'nationalities', 'tribes', 'app_no', 'applicant', 'is_applicant_exist', 'result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(StoreStudentProfileRequest $request)
    {
        try {
            // Add debugging to see what's happening
            Log::info('Starting profile creation');
            Log::info('Request data:', $request->all());

            DB::beginTransaction();
            Log::info('Transaction started');

            $userId = Auth::user()->id;
            Log::info('User ID: ' . $userId);

            // Validate data first to catch any issues
            $validator = Validator::make($request->all(), (new StoreStudentProfileRequest)->rules());
            if ($validator->fails()) {
                Log::error('Validation failed: ', $validator->errors()->toArray());
                DB::rollBack();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            Log::info('Validation passed');

            // Use validated request data
            $data = array_map(fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value, $request->validated());
            Log::info('Data transformed');

            $data['blood_type'] = trim($data['blood_type']); // Ensure no extra spaces in blood_type

            // Extract first letter of middle name and append a dot (if middle name exists)
            $data['middle_initial'] = $request->input('middle_name')
                ? strtoupper(substr($request->input('middle_name'), 0, 1)) . '.'
                : null;

            $data['res_region'] = $data['region_text-res'];
            $data['res_province'] = $data['province_text-res'];
            $data['res_towncity'] = $data['city_text-res'];
            $data['res_barangay'] = $data['barangay_text-res'];

            // Concatenate and remove extra spaces
            $data['res_address'] = implode(', ', array_filter([
                $request->input('res_street'),
                $request->input('barangay_text-res'),
                $request->input('city_text-res'),
                $request->input('province_text-res'),
                $request->input('res_zipcode')
            ]));

            $data['perm_region'] = $data['region_text-perm'];
            $data['perm_province'] = $data['province_text-perm'];
            $data['perm_towncity'] = $data['city_text-perm'];
            $data['perm_barangay'] = $data['barangay_text-perm'];

            // Concatenate and remove extra spaces
            $data['perm_address'] = implode(', ', array_filter([
                $request->input('perm_street'),
                $request->input('barangay_text-perm'),
                $request->input('city_text-perm'),
                $request->input('province_text-perm'),
                $request->input('perm_zipcode')
            ]));

            // Concatenate and remove extra spaces
            $data['guardian_address'] = implode(', ', array_filter([
                $request->input('guardian_street'),
                $request->input('barangay_text-guardian'),
                $request->input('city_text-guardian'),
                $request->input('province_text-guardian'),
                $request->input('guardian_zipcode')
            ]));

            $data['guardian_region'] = $data['region_text-guardian'];
            $data['guardian_province'] = $data['province_text-guardian'];
            $data['guardian_towncity'] = $data['city_text-guardian'];
            $data['guardian_barangay'] = $data['barangay_text-guardian'];

            $data['user_id'] = $userId;  // Set user_id directly

            Log::info('Attempting to create profile');
            Log::info('Data for creation:', $data);

            try {

                $profile = StundentProfile::updateOrCreate(
                    ['user_id' => $userId],
                    $data
                );

                Log::info('Profile created with ID: ' . $profile->id);
            } catch (\Exception $e) {
                Log::error('Error during profile creation: ' . $e->getMessage());
                Log::error($e->getTraceAsString());
                throw $e;
            }

            DB::commit();
            Log::info('Transaction committed');

            return redirect()->back()->with('success', 'Applicant profile saved successfully!');

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('Validation exception: ' . $e->getMessage());
            Log::error($e->validator->errors());

            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Exception: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Error creating profile: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function publish(Request $request)
    {
        try {
            $userId = Auth::id();

            // Find the user's student profile
            $studentProfile = StundentProfile::where('user_id', $userId)->first();

            if (!$studentProfile) {
                return response()->json(['success' => false, 'message' => 'Student profile not found.'], 404);
            }

            // Update profile status to published (1)
            $studentProfile->update(['applicant_profile_status' => 1]);

            return response()->json(['success' => true, 'message' => 'Student profile published successfully.']);
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
