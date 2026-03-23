<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentProfileRequest;
use App\Models\CeeSession;
use App\Models\ChedApplicantProfile;
use App\Models\Reservation;
use App\Models\Result;
use App\Models\StundentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class StudentApplicantProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $cee_profile = User::where('id', Auth::user()->id)->first();
    //     $app_no = Reservation::where('user_id', Auth::user()->id)
    //         ->where('status', 'confirmed')->first();

    //     //check if there is a result
    //     $result = Result::where('user_id', Auth::user()->id)->where('status', 'posted')->first();


    //     // get the data from chedprofile
    //     $ched_profile = ChedApplicantProfile::where('user_id', Auth::user()->id)
    //         ->where('status', '1')->first();

    //     // Read religions.json file
    //     $religions = [];
    //     $path = public_path('backend/assets/religion/religions.json'); // Ensure the path is correct
    //     if (File::exists($path)) {
    //         $religions = json_decode(File::get($path), true);
    //     }

    //     // Read nationality.json file
    //     $nationalities = [];
    //     $path_nationality = public_path('backend/assets/nationality/nationality.json'); // Ensure the path is correct
    //     if (File::exists($path_nationality)) {
    //         $nationalities = json_decode(File::get($path_nationality), true);
    //     }

    //     // Read tribes.json file
    //     $tribes = [];
    //     $path_tribe = public_path('backend/assets/tribe/tribes.json'); // Ensure the path is correct
    //     if (File::exists($path_tribe)) {
    //         $tribes = json_decode(File::get($path_tribe), true);
    //     }

    //     //fetch the if user exist in StudentProfile Table and prevent detching null if the user doe not have a profile yet
    //     //return a new StudentProfile instance
    //     $applicant = StundentProfile::where('user_id', Auth::user()->id)->first() ?? new StundentProfile();
    //     $is_applicant_exist = StundentProfile::where('user_id', Auth::user()->id)->first();

    //     //resident address
    //     $applicant->res_region = $applicant->res_region ?? '';
    //     $applicant->res_province = $applicant->res_province ?? '';
    //     $applicant->res_towncity = $applicant->res_towncity ?? '';
    //     $applicant->res_barangay = $applicant->res_barangay ?? '';

    //     //permanent address
    //     $applicant->perm_address = $applicant->perm_address ?? '';
    //     $applicant->perm_address_province = $applicant->perm_address_province ?? '';
    //     $applicant->perm_address_towncity = $applicant->perm_address_towncity ?? '';
    //     $applicant->perm_address_barangay = $applicant->perm_address_barangay ?? '';

    //     //guardian address
    //     $applicant->guardian_address = $applicant->guardian_address ?? '';
    //     $applicant->guardian_address_province = $applicant->guardian_address_province ?? '';
    //     $applicant->guardian_address_towncity = $applicant->guardian_address_towncity ?? '';
    //     $applicant->guardian_address_barangay = $applicant->guardian_address_barangay ?? '';

    //     // dd($applicant);


    //     // return view('student.profile.applicant-profile', compact('cee_profile', 'religions', 'nationalities', 'tribes', 'app_no', 'applicant', 'is_applicant_exist', 'result'));
    //     return view('student.profile.applicant-profile-personal-info', compact('cee_profile', 'religions', 'nationalities', 'tribes', 'app_no', 'applicant', 'is_applicant_exist', 'result', 'ched_profile'));
    // }

    public function index()
    {
        $userId = Auth::id();

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()->back()->with('error', 'No active CEE session found.');
        }

        $cee_profile = User::where('id', $userId)->first();

        $app_no = Reservation::where('user_id', $userId)
            ->where('status', 'confirmed')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        // check if there is a result
        $result = Result::where('user_id', $userId)
            ->where('status', 'posted')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        // get the data from chedprofile
        $ched_profile = ChedApplicantProfile::where('user_id', $userId)
            ->where('status', '1')
            ->first();

        // Read religions.json file
        $religions = [];
        $path = public_path('backend/assets/religion/religions.json');
        if (File::exists($path)) {
            $religions = json_decode(File::get($path), true);
        }

        // Read nationality.json file
        $nationalities = [];
        $path_nationality = public_path('backend/assets/nationality/nationality.json');
        if (File::exists($path_nationality)) {
            $nationalities = json_decode(File::get($path_nationality), true);
        }

        // Read tribes.json file
        $tribes = [];
        $path_tribe = public_path('backend/assets/tribe/tribes.json');
        if (File::exists($path_tribe)) {
            $tribes = json_decode(File::get($path_tribe), true);
        }

        // fetch applicant only for active preregistration/session
        $applicant = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->first() ?? new StundentProfile();

        $is_applicant_exist = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->first();

        // resident address
        $applicant->res_region = $applicant->res_region ?? '';
        $applicant->res_province = $applicant->res_province ?? '';
        $applicant->res_towncity = $applicant->res_towncity ?? '';
        $applicant->res_barangay = $applicant->res_barangay ?? '';

        // permanent address
        $applicant->perm_address = $applicant->perm_address ?? '';
        $applicant->perm_address_province = $applicant->perm_address_province ?? '';
        $applicant->perm_address_towncity = $applicant->perm_address_towncity ?? '';
        $applicant->perm_address_barangay = $applicant->perm_address_barangay ?? '';

        // guardian address
        $applicant->guardian_address = $applicant->guardian_address ?? '';
        $applicant->guardian_address_province = $applicant->guardian_address_province ?? '';
        $applicant->guardian_address_towncity = $applicant->guardian_address_towncity ?? '';
        $applicant->guardian_address_barangay = $applicant->guardian_address_barangay ?? '';

        return view('student.profile.applicant-profile-personal-info', compact(
            'cee_profile',
            'religions',
            'nationalities',
            'tribes',
            'app_no',
            'applicant',
            'is_applicant_exist',
            'result',
            'ched_profile'
        ));
    }

    public function showStep1()
    {
        $userId = Auth::user()->id;

        $cee_active_session = CeeSession::where('status', 'active')->first();

        $cee_profile = User::where('id', $userId)->first();

        // $app_no = Reservation::where('user_id', $userId)
        //     ->where('status', 'confirmed')->first();

        $app_no = Reservation::where('user_id', $userId)
            ->where('status', 'confirmed')
            ->where('cee_session_id', $cee_active_session->id)
            ->first();

        $studentdetails = User::where("id", $userId)->first();

        //check if there is a result
        $result = Result::where('user_id', $userId)->where('status', 'posted')
        ->where('cee_session_id', $cee_active_session->id)
        ->first();

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

        $applicant = StundentProfile::where('user_id', $userId)->where('app_no', $app_no->app_no)->first() ?? new StundentProfile();
        $is_applicant_exist = StundentProfile::where('user_id', $userId)->where('app_no', $app_no->app_no)->first();

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

        //fetch the Sitesettings
        $site_settings = DB::table('site_settings')->first();

        return view("student.profile.step1", compact(
            'cee_profile',
            'religions',
            'nationalities',
            'tribes',
            'app_no',
            'is_applicant_exist',
            'result',
            'applicant',
            'cee_active_session',
            'site_settings'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // public function postStep1(Request $request)
    // {

    //     $userId = Auth::user()->id;

    //     $cee_session = CeeSession::where('status', 'active')->first();

    //     $validated = $request->validate([

    //         'app_no' => [
    //             'required',
    //             Rule::unique('stundent_profiles', 'app_no')->ignore($userId, 'user_id') // Ignore the current user's email
    //         ],
    //         'user_id' => [
    //             'required',
    //             Rule::unique('stundent_profiles', 'user_id')->ignore($userId, 'user_id') // Ignore the current user's email
    //         ],
    //         'email' => [
    //             'required',
    //             Rule::unique('stundent_profiles', 'email')->ignore($userId, 'user_id') // Ignore the current user's email
    //         ],

    //         'student_type' => 'required|integer',
    //         'freshmen_type' => 'required|integer',
    //         'student_no' => 'nullable|string|max:15',
    //         'campus_id' => 'nullable|integer',
    //         'prog_id' => 'nullable|integer',
    //         'major_disc_id' => 'nullable|integer',
    //         'year_level_id' => 'nullable|integer',
    //         'last_name' => 'required|string|max:50',
    //         'middle_name' => 'nullable|string|max:50',
    //         'first_name' => 'required|string|max:50',
    //         'middle_initial' => 'nullable|string|max:5',
    //         'ext_name' => 'nullable|string|max:10',
    //         'date_of_birth' => 'required|date',
    //         'place_of_birth' => 'required|string|max:200',
    //         'civil_status_id' => 'required|integer',
    //         'religion_id' => 'required|integer',
    //         'gender' => 'required|string|in:Male,Female,Other',
    //         'nationality_id' => 'required|integer',
    //         'mobile_no' => 'required|string|max:20',
    //         'health_id' => 'nullable|integer',
    //         'height' => 'required|numeric',
    //         'weight' => 'required|numeric',
    //         'blood_type' => 'required|string|max:3',

    //         'no_of_brothers' => 'required|integer',
    //         'no_of_sisters' => 'required|integer',
    //         'is_illegitimate_child' => 'required|boolean',
    //         'tribe_id' => 'required|integer',

    //         'ip_member' => 'required|boolean',
    //         'ip_member_tribe' => 'nullable|string|max:50',

    //         'pwd_member' => 'required|boolean',
    //         'pwd_member_id' => 'nullable|string|max:50',
    //         'pwd_category' => 'nullable|string|max:50',
    //         'solo_parent' => 'required|boolean',
    //         'solo_parent_id' => 'nullable|string|max:50',

    //         // Residence Address
    //         'res_address' => 'nullable|string|max:255',
    //         'res_street' => 'required|string|max:100',
    //         'barangay_text-res' => 'required|string|max:100',
    //         'city_text-res' => 'required|string|max:100',
    //         'res_zipcode' => 'nullable|integer',
    //         'province_text-res' => 'required|string|max:100',
    //         'region_text-res' => 'required|string|max:100',

    //         // Permanent Address
    //         'perm_address' => 'nullable|string|max:100',
    //         'perm_street' => 'required|string|max:100',
    //         'barangay_text-perm' => 'required|string|max:100',
    //         'city_text-perm' => 'required|string|max:100',
    //         'perm_zipcode' => 'required|integer',
    //         'province_text-perm' => 'required|string|max:60',
    //         'region_text-perm' => 'required|string|max:60',

    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         // Clean string data
    //         $data = array_map(fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value, $validated);

    //         $data['middle_initial'] = $request->input('middle_name')
    //             ? strtoupper(substr($request->input('middle_name'), 0, 1)) . '.'
    //             : null;

    //         $data['res_region'] = $data['region_text-res'];
    //         $data['res_province'] = $data['province_text-res'];
    //         $data['res_towncity'] = $data['city_text-res'];
    //         $data['res_barangay'] = $data['barangay_text-res'];

    //         $data['res_address'] = implode(', ', array_filter([
    //             $request->input('res_street'),
    //             $request->input('barangay_text-res'),
    //             $request->input('city_text-res'),
    //             $request->input('province_text-res'),
    //             $request->input('res_zipcode')
    //         ]));

    //         $data['perm_region'] = $data['region_text-perm'];
    //         $data['perm_province'] = $data['province_text-perm'];
    //         $data['perm_towncity'] = $data['city_text-perm'];
    //         $data['perm_barangay'] = $data['barangay_text-perm'];

    //         $data['perm_address'] = implode(', ', array_filter([
    //             $request->input('perm_street'),
    //             $request->input('barangay_text-perm'),
    //             $request->input('city_text-perm'),
    //             $request->input('province_text-perm'),
    //             $request->input('perm_zipcode')
    //         ]));

    //         $data['applicant_profile_status'] = 0;
    //         $data['current_step'] = 1;
    //         $data['preregistration_id'] = $cee_session?->id;
    //         Log::info('Final data to be saved for user ' . $userId, $data);

    //         // Save the profile
    //         $studentProfile = StundentProfile::updateOrCreate(
    //             [
    //                 'user_id' => $userId,
    //                 'app_no' => $request->input('app_no')
    //             ],
    //             $data
    //         );

    //         DB::commit();

    //         return redirect()->route('student.applicant-profile.step2.show')->with('student_profile_id', $studentProfile->id);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Error saving personal info: ' . $e->getMessage());
    //         return redirect()->route('student.applicant-profile.step1.show')->with('error', 'Something went wrong while saving.');
    //     }
    // }

    public function postStep1(Request $request)
    {
        $userId = Auth::user()->id;
        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()
                ->route('student.applicant-profile.step1.show')
                ->with('error', 'No active CEE session found.');
        }

        $currentProfile = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->first();

        $validated = $request->validate([
            'app_no' => [
                'required',
                Rule::unique('stundent_profiles', 'app_no')
                    ->where(fn($query) => $query->where('preregistration_id', $cee_session->id))
                    ->ignore(optional($currentProfile)->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('stundent_profiles', 'email')
                    ->where(fn($query) => $query->where('preregistration_id', $cee_session->id))
                    ->ignore(optional($currentProfile)->id),
            ],

            'student_type' => 'required|integer',
            'freshmen_type' => 'required|integer',
            'student_no' => 'nullable|string|max:15',
            'campus_id' => 'nullable|integer',
            'prog_id' => 'nullable|integer',
            'major_disc_id' => 'nullable|integer',
            'year_level_id' => 'nullable|integer',
            'last_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'first_name' => 'required|string|max:50',
            'middle_initial' => 'nullable|string|max:5',
            'ext_name' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:200',
            'civil_status_id' => 'required|integer',
            'religion_id' => 'required|integer',
            'gender' => 'required|string|in:Male,Female,Other',
            'nationality_id' => 'required|integer',
            'mobile_no' => 'required|string|max:20',
            'health_id' => 'nullable|integer',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'blood_type' => 'required|string|max:3',

            'no_of_brothers' => 'required|integer',
            'no_of_sisters' => 'required|integer',
            'is_illegitimate_child' => 'required|boolean',
            'tribe_id' => 'required|integer',

            'ip_member' => 'required|boolean',
            'ip_member_tribe' => 'nullable|string|max:50',

            'pwd_member' => 'required|boolean',
            'pwd_member_id' => 'nullable|string|max:50',
            'pwd_category' => 'nullable|string|max:50',
            'solo_parent' => 'required|boolean',
            'solo_parent_id' => 'nullable|string|max:50',

            // Residence Address
            'res_address' => 'nullable|string|max:255',
            'res_street' => 'required|string|max:100',
            'barangay_text-res' => 'required|string|max:100',
            'city_text-res' => 'required|string|max:100',
            'res_zipcode' => 'nullable|integer',
            'province_text-res' => 'required|string|max:100',
            'region_text-res' => 'required|string|max:100',

            // Permanent Address
            'perm_address' => 'nullable|string|max:100',
            'perm_street' => 'required|string|max:100',
            'barangay_text-perm' => 'required|string|max:100',
            'city_text-perm' => 'required|string|max:100',
            'perm_zipcode' => 'required|integer',
            'province_text-perm' => 'required|string|max:60',
            'region_text-perm' => 'required|string|max:60',
        ]);

        DB::beginTransaction();

        try {
            $data = array_map(function ($value) {
                return is_string($value)
                    ? trim(preg_replace('/\s+/', ' ', $value))
                    : $value;
            }, $validated);

            $data['user_id'] = $userId;
            $data['preregistration_id'] = $cee_session->id;

            $data['middle_initial'] = $request->filled('middle_name')
                ? strtoupper(substr(trim($request->input('middle_name')), 0, 1)) . '.'
                : null;

            $data['res_region'] = $request->input('region_text-res');
            $data['res_province'] = $request->input('province_text-res');
            $data['res_towncity'] = $request->input('city_text-res');
            $data['res_barangay'] = $request->input('barangay_text-res');

            $data['res_address'] = implode(', ', array_filter([
                $request->input('res_street'),
                $request->input('barangay_text-res'),
                $request->input('city_text-res'),
                $request->input('province_text-res'),
                $request->input('res_zipcode'),
            ]));

            $data['perm_region'] = $request->input('region_text-perm');
            $data['perm_province'] = $request->input('province_text-perm');
            $data['perm_towncity'] = $request->input('city_text-perm');
            $data['perm_barangay'] = $request->input('barangay_text-perm');

            $data['perm_address'] = implode(', ', array_filter([
                $request->input('perm_street'),
                $request->input('barangay_text-perm'),
                $request->input('city_text-perm'),
                $request->input('province_text-perm'),
                $request->input('perm_zipcode'),
            ]));

            $data['applicant_profile_status'] = 0;
            $data['current_step'] = 1;

            Log::info('Final data to be saved for user ' . $userId, $data);

            $studentProfile = StundentProfile::updateOrCreate(
                [
                    'user_id' => $userId,
                    'preregistration_id' => $cee_session->id,
                ],
                $data
            );

            DB::commit();

            return redirect()
                ->route('student.applicant-profile.step2.show')
                ->with('student_profile_id', $studentProfile->id);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error saving personal info: ' . $e->getMessage(), [
                'user_id' => $userId,
                'preregistration_id' => $cee_session->id ?? null,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('student.applicant-profile.step1.show')
                ->withInput()
                ->with('error', 'Something went wrong while saving.');
        }
    }
    //step 2 Address Info
    // public function showStep2()
    // {
    //     $app_no = Reservation::where('user_id', Auth::user()->id)
    //         ->where('status', 'confirmed')->first();

    //     //check if there is a result
    //     $result = Result::where('user_id', Auth::user()->id)->where('status', 'posted')->first();

    //     $cee_profile = User::where('id', Auth::user()->id)->first();

    //     $applicant = StundentProfile::where('user_id', Auth::user()->id)->first() ?? new StundentProfile();
    //     $is_applicant_exist = StundentProfile::where('user_id', Auth::user()->id)->first();

    //     //guardian address
    //     $applicant->guardian_address = $applicant->guardian_address ?? '';
    //     $applicant->guardian_address_province = $applicant->guardian_address_province ?? '';
    //     $applicant->guardian_address_towncity = $applicant->guardian_address_towncity ?? '';
    //     $applicant->guardian_address_barangay = $applicant->guardian_address_barangay ?? '';

    //     return view('student.profile.step2', compact('app_no', 'result', 'cee_profile', 'applicant', 'is_applicant_exist'));
    // }

    public function showStep2()
    {
        $userId = Auth::user()->id;

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()
                ->route('student.applicant-profile.step1.show')
                ->with('error', 'No active CEE session found.');
        }

        $app_no = Reservation::where('user_id', $userId)
            ->where('status', 'confirmed')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        // If results are also term-based, include cee_session_id filter.
        $result = Result::where('user_id', $userId)
            ->where('status', 'posted')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        $cee_profile = User::find($userId);

        $applicant = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->first() ?? new StundentProfile();

        $is_applicant_exist = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->exists();

        // Guardian address defaults
        $applicant->guardian_address = $applicant->guardian_address ?? '';
        $applicant->guardian_province = $applicant->guardian_province ?? '';
        $applicant->guardian_towncity = $applicant->guardian_towncity ?? '';
        $applicant->guardian_barangay = $applicant->guardian_barangay ?? '';

        return view('student.profile.step2', compact(
            'app_no',
            'result',
            'cee_profile',
            'applicant',
            'cee_session',
            'is_applicant_exist'
        ));
    }

    // public function postStep2(Request $request)
    // {
    //     $userId = Auth::user()->id;

    //     $validated = $request->validate([
    //         'father' => 'nullable|string|max:50',
    //         'father_birth_date' => 'nullable',
    //         'father_educ_attain' => 'nullable|string|max:100',
    //         'father_occupation' => 'nullable|string|max:50',
    //         'father_company' => 'nullable|string|max:100',
    //         'father_company_address' => 'nullable|string|max:200',
    //         'father_tel_no' => 'nullable|string|max:20',
    //         'father_email' => 'nullable|string|max:50',
    //         'father_income_from' => 'nullable|string',

    //         'mother' => 'nullable|string|max:50',
    //         'mother_birth_date' => 'nullable',
    //         'mother_educ_attain' => 'nullable|string|max:100',
    //         'mother_occupation' => 'nullable|string|max:50',
    //         'mother_company' => 'nullable|string|max:100',
    //         'mother_company_address' => 'nullable|string|max:200',
    //         'mother_tel_no' => 'nullable|string|max:20',
    //         'mother_email' => 'nullable|string|max:50',
    //         'mother_income_from' => 'nullable|string',

    //         'father_income_to' => 'nullable|string',
    //         'mother_income_to' => 'nullable|string',

    //         // Guardian Information
    //         'guardian' => 'required|string|max:100',
    //         'guardian_relationship' => 'required|string|max:100',
    //         'guardian_occupation' => 'nullable|string|max:100',
    //         'guardian_company' => 'nullable|string|max:100',
    //         'guardian_telno' => 'nullable|string|max:100',
    //         'guardian_email' => 'nullable|string|max:100',

    //         'guardian_address' => 'nullable|string|max:100',
    //         'guardian_street' => 'required|string|max:100',
    //         'barangay_text-guardian' => 'required|string|max:100',
    //         'city_text-guardian' => 'required|string|max:100',
    //         'province_text-guardian' => 'required|string|max:100',
    //         'region_text-guardian' => 'required|string|max:100',
    //         'guardian_zipcode' => 'nullable|integer'
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         // Clean string data
    //         $data = array_map(fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value, $validated);

    //         $data['guardian_region'] = $data['region_text-guardian'];
    //         $data['guardian_province'] = $data['province_text-guardian'];
    //         $data['guardian_towncity'] = $data['city_text-guardian'];
    //         $data['guardian_barangay'] = $data['barangay_text-guardian'];

    //         // Concatenate and remove extra spaces
    //         $data['guardian_address'] = implode(', ', array_filter([
    //             $request->input('guardian_street'),
    //             $request->input('barangay_text-guardian'),
    //             $request->input('city_text-guardian'),
    //             $request->input('province_text-guardian'),
    //             $request->input('guardian_zipcode')
    //         ]));

    //         // Set current_step
    //         $data['current_step'] = 2;


    //         Log::info('Final data to be saved for user ' . $userId, $data);

    //         // Save the profile
    //         StundentProfile::updateOrCreate(
    //             ['user_id' => $userId],
    //             $data
    //         );

    //         DB::commit();

    //         return redirect()->route('student.applicant-profile.step3.show');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Error saving personal info: ' . $e->getMessage());
    //         return redirect()->route('student.applicant-profile.step2.show')->with('error', 'Something went wrong while saving.');
    //     }
    // }

    // public function postStep2(Request $request)
    // {
    //     $userId = Auth::user()->id;
    //     $cee_session = CeeSession::where('status', 'active')->first();

    //     if (!$cee_session) {
    //         return redirect()
    //             ->route('student.applicant-profile.step2.show')
    //             ->with('error', 'No active CEE session found.');
    //     }

    //     $validated = $request->validate([
    //         'father' => 'nullable|string|max:50',
    //         'father_birth_date' => 'nullable|date',
    //         'father_educ_attain' => 'nullable|string|max:100',
    //         'father_occupation' => 'nullable|string|max:50',
    //         'father_company' => 'nullable|string|max:100',
    //         'father_company_address' => 'nullable|string|max:200',
    //         'father_tel_no' => 'nullable|string|max:20',
    //         'father_email' => 'nullable|string|max:50',
    //         'father_income_from' => 'nullable|string',

    //         'mother' => 'nullable|string|max:50',
    //         'mother_birth_date' => 'nullable|date',
    //         'mother_educ_attain' => 'nullable|string|max:100',
    //         'mother_occupation' => 'nullable|string|max:50',
    //         'mother_company' => 'nullable|string|max:100',
    //         'mother_company_address' => 'nullable|string|max:200',
    //         'mother_tel_no' => 'nullable|string|max:20',
    //         'mother_email' => 'nullable|string|max:50',
    //         'mother_income_from' => 'nullable|string',

    //         'father_income_to' => 'nullable|string',
    //         'mother_income_to' => 'nullable|string',

    //         // Guardian Information
    //         'guardian' => 'required|string|max:100',
    //         'guardian_relationship' => 'required|string|max:100',
    //         'guardian_occupation' => 'nullable|string|max:100',
    //         'guardian_company' => 'nullable|string|max:100',
    //         'guardian_telno' => 'nullable|string|max:100',
    //         'guardian_email' => 'nullable|string|max:100',

    //         'guardian_address' => 'nullable|string|max:100',
    //         'guardian_street' => 'required|string|max:100',
    //         'barangay_text-guardian' => 'required|string|max:100',
    //         'city_text-guardian' => 'required|string|max:100',
    //         'province_text-guardian' => 'required|string|max:100',
    //         'region_text-guardian' => 'required|string|max:100',
    //         'guardian_zipcode' => 'nullable|integer',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $data = array_map(
    //             fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value,
    //             $validated
    //         );

    //         $data['guardian_region'] = $request->input('region_text-guardian');
    //         $data['guardian_province'] = $request->input('province_text-guardian');
    //         $data['guardian_towncity'] = $request->input('city_text-guardian');
    //         $data['guardian_barangay'] = $request->input('barangay_text-guardian');

    //         $data['guardian_address'] = implode(', ', array_filter([
    //             $request->input('guardian_street'),
    //             $request->input('barangay_text-guardian'),
    //             $request->input('city_text-guardian'),
    //             $request->input('province_text-guardian'),
    //             $request->input('guardian_zipcode'),
    //         ]));

    //         $data['current_step'] = 2;
    //         $data['user_id'] = $userId;
    //         $data['preregistration_id'] = $cee_session->id;

    //         Log::info('Final data to be saved for user ' . $userId, $data);

    //         $studentProfile = StundentProfile::updateOrCreate(
    //             [
    //                 'user_id' => $userId,
    //                 'preregistration_id' => $cee_session->id,
    //             ],
    //             $data
    //         );

    //         DB::commit();

    //         return redirect()
    //             ->route('student.applicant-profile.step3.show')
    //             ->with('student_profile_id', $studentProfile->id);

    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         Log::error('Error saving personal info: ' . $e->getMessage(), [
    //             'user_id' => $userId,
    //             'preregistration_id' => $cee_session->id ?? null,
    //             'trace' => $e->getTraceAsString(),
    //         ]);

    //         return redirect()
    //             ->route('student.applicant-profile.step2.show')
    //             ->withInput()
    //             ->with('error', 'Something went wrong while saving.');
    //     }
    // }

    public function postStep2(Request $request)
    {
        $userId = Auth::id();
        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()
                ->route('student.applicant-profile.step2.show')
                ->with('error', 'No active CEE session found.');
        }

        $validator = Validator::make($request->all(), [
            'father' => 'nullable|string|max:50',
            'father_birth_date' => 'nullable|date',
            'father_educ_attain' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:50',
            'father_company' => 'nullable|string|max:100',
            'father_company_address' => 'nullable|string|max:200',
            'father_tel_no' => 'nullable|string|max:20',
            'father_email' => 'nullable|string|max:50',

            'father_income_from' => 'nullable|string',
            'father_income_to' => 'nullable|string',

            'mother' => 'nullable|string|max:50',
            'mother_birth_date' => 'nullable|date',
            'mother_educ_attain' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:50',
            'mother_company' => 'nullable|string|max:100',
            'mother_company_address' => 'nullable|string|max:200',
            'mother_tel_no' => 'nullable|string|max:20',
            'mother_email' => 'nullable|string|max:50',

            'mother_income_from' => 'nullable|string',
            'mother_income_to' => 'nullable|string',

            'guardian' => 'required|string|max:100',
            'guardian_relationship' => 'required|string|max:100',
            'guardian_occupation' => 'nullable|string|max:100',
            'guardian_company' => 'nullable|string|max:100',
            'guardian_telno' => 'nullable|string|max:100',
            'guardian_email' => 'nullable|string|max:100',

            'guardian_address' => 'nullable|string|max:100',
            'guardian_street' => 'required|string|max:100',
            'barangay_text-guardian' => 'required|string|max:100',
            'city_text-guardian' => 'required|string|max:100',
            'province_text-guardian' => 'required|string|max:100',
            'region_text-guardian' => 'required|string|max:100',
            'guardian_zipcode' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('student.applicant-profile.step2.show')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $validated = $validator->validated();

            $data = array_map(
                fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value,
                $validated
            );

            $data['guardian_region'] = $request->input('region_text-guardian');
            $data['guardian_province'] = $request->input('province_text-guardian');
            $data['guardian_towncity'] = $request->input('city_text-guardian');
            $data['guardian_barangay'] = $request->input('barangay_text-guardian');

            $data['guardian_address'] = implode(', ', array_filter([
                $request->input('guardian_street'),
                $request->input('barangay_text-guardian'),
                $request->input('city_text-guardian'),
                $request->input('province_text-guardian'),
                $request->input('guardian_zipcode'),
            ]));

            $data['current_step'] = 2;
            $data['user_id'] = $userId;
            $data['preregistration_id'] = $cee_session->id;

            Log::info('Final data to be saved for user ' . $userId, $data);

            $studentProfile = StundentProfile::updateOrCreate(
                [
                    'user_id' => $userId,
                    'preregistration_id' => $cee_session->id,
                ],
                $data
            );

            DB::commit();

            return redirect()
                ->route('student.applicant-profile.step3.show')
                ->with('student_profile_id', $studentProfile->id);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error saving personal info: ' . $e->getMessage(), [
                'user_id' => $userId,
                'preregistration_id' => $cee_session->id ?? null,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('student.applicant-profile.step2.show')
                ->withInput()
                ->with('error', 'Something went wrong while saving.');
        }
    }

    // public function showStep3()
    // {
    //     $app_no = Reservation::where('user_id', Auth::user()->id)
    //         ->where('status', 'confirmed')->first();

    //     //check if there is a result
    //     $result = Result::where('user_id', Auth::user()->id)->where('status', 'posted')->first();

    //     $cee_profile = User::where('id', Auth::user()->id)->first();

    //     $applicant = StundentProfile::where('user_id', Auth::user()->id)->first() ?? new StundentProfile();
    //     $is_applicant_exist = StundentProfile::where('user_id', Auth::user()->id)->first();

    //     return view('student.profile.step3', compact('app_no', 'result', 'cee_profile', 'applicant', 'is_applicant_exist'));
    // }

    public function showStep3()
    {
        $userId = Auth::user()->id;

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()
                ->route('student.applicant-profile.step1.show')
                ->with('error', 'No active CEE session found.');
        }

        $app_no = Reservation::where('user_id', $userId)
            ->where('status', 'confirmed')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        $result = Result::where('user_id', $userId)
            ->where('status', 'posted')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        $cee_profile = User::find($userId);

        $applicant = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->first() ?? new StundentProfile();

        $is_applicant_exist = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->exists();

        return view('student.profile.step3', compact(
            'app_no',
            'result',
            'cee_profile',
            'applicant',
            'is_applicant_exist',
            'cee_session'
        ));
    }

    // public function postStep3(Request $request)
    // {
    //     $userId = Auth::user()->id;

    //     $validated = $request->validate([
    //         'elem_school' => 'required|string|max:100',
    //         'elem_address' => 'required|string|max:100',
    //         'elem_incldates' => 'required|string|max:60',
    //         'hs_school' => 'required|string|max:100',
    //         'hs_address' => 'required|string|max:100',
    //         'hs_incldates' => 'required|string|max:60',
    //         'vocational' => 'nullable|string|max:100',
    //         'vocational_address' => 'nullable|string|max:100',
    //         'vocational_degree' => 'nullable|string|max:100',
    //         'vocational_incldates' => 'nullable|string|max:60',
    //         'shs_school' => 'required|string|max:100',
    //         'shs_address' => 'required|string|max:100',
    //         'shs_incldates' => 'required|string|max:60',
    //         'college_school' => 'required|string|max:100',
    //         'college_address' => 'required|string|max:100',
    //         'college_degree' => 'required|string|max:100',
    //         'college_incldates' => 'required|string|max:60',
    //         'student_picture' => 'nullable|file',
    //         'elem_award_honor' => 'nullable|string|max:1000',
    //         'hs_award_honor' => 'nullable|string|max:1000',
    //         'shs_award_honor' => 'nullable|string|max:1000',
    //     ]);



    //     DB::beginTransaction();

    //     try {
    //         // Clean string data
    //         $data = array_map(fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value, $validated);

    //         // Set current_step
    //         $data['current_step'] = 3;

    //         // Save the profile
    //         $studentProfile = StundentProfile::updateOrCreate(
    //             ['user_id' => $userId],
    //             $data
    //         );

    //         DB::commit();

    //         return redirect()->route('student.applicant-profile.step4.show')->with('student_profile_id', $studentProfile->id);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Error Educational Background info: ' . $e->getMessage());
    //         return redirect()->route('student.applicant-profile.step3.show')->with('error', 'Something went wrong while saving.');
    //     }
    // }

    public function postStep3(Request $request)
    {
        $userId = Auth::user()->id;

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()
                ->route('student.applicant-profile.step3.show')
                ->with('error', 'No active CEE session found.');
        }

        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'elem_school' => 'required|string|max:100',
                'elem_address' => 'required|string|max:1000',
                'elem_incldates' => 'required|string|max:60',

                'hs_school' => 'required|string|max:100',
                'hs_address' => 'required|string|max:1000',
                'hs_incldates' => 'required|string|max:60',

                'vocational' => 'nullable|string|max:100',
                'vocational_address' => 'nullable|string|max:1000',
                'vocational_degree' => 'nullable|string|max:100',
                'vocational_incldates' => 'nullable|string|max:60',

                'shs_school' => 'required|string|max:100',
                'shs_address' => 'required|string|max:100',
                'shs_incldates' => 'required|string|max:60',

                'college_school' => 'required|string|max:100',
                'college_address' => 'required|string|max:100',
                'college_degree' => 'required|string|max:100',
                'college_incldates' => 'required|string|max:60',

                'student_picture' => 'nullable|file',
                'elem_award_honor' => 'nullable|string|max:1000',
                'hs_award_honor' => 'nullable|string|max:1000',
                'shs_award_honor' => 'nullable|string|max:1000',
            ]);

            $data = array_map(
                fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value,
                $validated
            );

            $data['user_id'] = $userId;
            $data['preregistration_id'] = $cee_session->id;
            $data['current_step'] = 3;

            $studentProfile = StundentProfile::updateOrCreate(
                [
                    'user_id' => $userId,
                    'preregistration_id' => $cee_session->id,
                ],
                $data
            );

            DB::commit();

            return redirect()
                ->route('student.applicant-profile.step4.show')
                ->with('student_profile_id', $studentProfile->id);

        } catch (ValidationException $e) {
            DB::rollBack();

            return redirect()
                ->route('student.applicant-profile.step3.show')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error Educational Background info: ' . $e->getMessage(), [
                'user_id' => $userId,
                'preregistration_id' => $cee_session->id ?? null,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('student.applicant-profile.step3.show')
                ->withInput()
                ->with('error', 'Something went wrong while saving.');
        }
    }

    public function showStep4()
    {
        $userId = Auth::id();

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()
                ->route('student.applicant-profile.step1.show')
                ->with('error', 'No active CEE session found.');
        }

        $app_no = Reservation::where('user_id', $userId)
            ->where('status', 'confirmed')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        $result = Result::where('user_id', $userId)
            ->where('status', 'posted')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        $cee_profile = User::find($userId);

        $applicant = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->first() ?? new StundentProfile();

        $is_applicant_exist = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->exists();

        return view('student.profile.step4', compact(
            'app_no',
            'result',
            'cee_profile',
            'applicant',
            'is_applicant_exist',
            'cee_session'
        ));
    }

    public function postStep4(Request $request)
    {
        $userId = Auth::id();

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()
                ->route('student.applicant-profile.step4.show')
                ->with('error', 'No active CEE session found.');
        }

        $validated = $request->validate([
            'emergency_contact' => 'required|string|max:100',
            'emergency_address' => 'required|string|max:100',
            'emergency_mobileno' => 'required|string|max:60',
            'emergency_telno' => 'nullable|string|max:60',
        ]);

        DB::beginTransaction();

        try {
            $data = array_map(
                fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value,
                $validated
            );

            $data['user_id'] = $userId;
            $data['preregistration_id'] = $cee_session->id;
            $data['current_step'] = 4;

            $studentProfile = StundentProfile::updateOrCreate(
                [
                    'user_id' => $userId,
                    'preregistration_id' => $cee_session->id,
                ],
                $data
            );

            DB::commit();

            return redirect()
                ->route('student.applicant-profile.step5.show')
                ->with('student_profile_id', $studentProfile->id);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error Emergency Contact info: ' . $e->getMessage(), [
                'user_id' => $userId,
                'preregistration_id' => $cee_session->id ?? null,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('student.applicant-profile.step4.show')
                ->withInput()
                ->with('error', 'Something went wrong while saving.');
        }
    }

    public function showStep5()
    {
        $userId = Auth::id();

        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()
                ->route('student.applicant-profile.step1.show')
                ->with('error', 'No active CEE session found.');
        }

        $app_no = Reservation::where('user_id', $userId)
            ->where('status', 'confirmed')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        $result = Result::where('user_id', $userId)
            ->where('status', 'posted')
            ->where('cee_session_id', $cee_session->id)
            ->first();

        $cee_profile = User::find($userId);

        $applicant = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->first() ?? new StundentProfile();

        $is_applicant_exist = StundentProfile::where('user_id', $userId)
            ->where('preregistration_id', $cee_session->id)
            ->exists();

        return view('student.profile.step5', compact(
            'app_no',
            'result',
            'cee_profile',
            'applicant',
            'is_applicant_exist',
            'cee_session'
        ));
    }

    // public function store(StoreStudentProfileRequest $request)
    // {
    //     try {
    //         // Add debugging to see what's happening
    //         Log::info('Starting profile creation');
    //         Log::info('Request data:', $request->all());

    //         DB::beginTransaction();
    //         Log::info('Transaction started');

    //         $userId = Auth::user()->id;
    //         Log::info('User ID: ' . $userId);

    //         // Validate data first to catch any issues
    //         $validator = Validator::make($request->all(), (new StoreStudentProfileRequest)->rules());
    //         if ($validator->fails()) {
    //             Log::error('Validation failed: ', $validator->errors()->toArray());
    //             DB::rollBack();
    //             return redirect()->back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }
    //         Log::info('Validation passed');

    //         // Use validated request data
    //         $data = array_map(fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value, $request->validated());
    //         Log::info('Data transformed');

    //         $data['blood_type'] = trim($data['blood_type']); // Ensure no extra spaces in blood_type

    //         // Extract first letter of middle name and append a dot (if middle name exists)
    //         $data['middle_initial'] = $request->input('middle_name')
    //             ? strtoupper(substr($request->input('middle_name'), 0, 1)) . '.'
    //             : null;

    //         $data['res_region'] = $data['region_text-res'];
    //         $data['res_province'] = $data['province_text-res'];
    //         $data['res_towncity'] = $data['city_text-res'];
    //         $data['res_barangay'] = $data['barangay_text-res'];

    //         // Concatenate and remove extra spaces
    //         $data['res_address'] = implode(', ', array_filter([
    //             $request->input('res_street'),
    //             $request->input('barangay_text-res'),
    //             $request->input('city_text-res'),
    //             $request->input('province_text-res'),
    //             $request->input('res_zipcode')
    //         ]));

    //         $data['perm_region'] = $data['region_text-perm'];
    //         $data['perm_province'] = $data['province_text-perm'];
    //         $data['perm_towncity'] = $data['city_text-perm'];
    //         $data['perm_barangay'] = $data['barangay_text-perm'];

    //         // Concatenate and remove extra spaces
    //         $data['perm_address'] = implode(', ', array_filter([
    //             $request->input('perm_street'),
    //             $request->input('barangay_text-perm'),
    //             $request->input('city_text-perm'),
    //             $request->input('province_text-perm'),
    //             $request->input('perm_zipcode')
    //         ]));

    //         // Concatenate and remove extra spaces
    //         $data['guardian_address'] = implode(', ', array_filter([
    //             $request->input('guardian_street'),
    //             $request->input('barangay_text-guardian'),
    //             $request->input('city_text-guardian'),
    //             $request->input('province_text-guardian'),
    //             $request->input('guardian_zipcode')
    //         ]));

    //         $data['guardian_region'] = $data['region_text-guardian'];
    //         $data['guardian_province'] = $data['province_text-guardian'];
    //         $data['guardian_towncity'] = $data['city_text-guardian'];
    //         $data['guardian_barangay'] = $data['barangay_text-guardian'];

    //         $data['user_id'] = $userId;  // Set user_id directly

    //         Log::info('Attempting to create profile');
    //         Log::info('Data for creation:', $data);

    //         try {

    //             $profile = StundentProfile::updateOrCreate(
    //                 ['user_id' => $userId],
    //                 $data
    //             );

    //             Log::info('Profile created with ID: ' . $profile->id);
    //         } catch (\Exception $e) {
    //             Log::error('Error during profile creation: ' . $e->getMessage());
    //             Log::error($e->getTraceAsString());
    //             throw $e;
    //         }

    //         DB::commit();
    //         Log::info('Transaction committed');

    //         return redirect()->back()->with('success', 'Applicant profile saved successfully!');

    //     } catch (ValidationException $e) {
    //         DB::rollBack();
    //         Log::error('Validation exception: ' . $e->getMessage());
    //         Log::error($e->validator->errors());

    //         return redirect()->back()
    //             ->withErrors($e->validator)
    //             ->withInput();
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Exception: ' . $e->getMessage());
    //         Log::error($e->getTraceAsString());

    //         return redirect()->back()
    //             ->with('error', 'Error creating profile: ' . $e->getMessage())
    //             ->withInput();
    //     }
    // }

    public function store(StoreStudentProfileRequest $request)
    {
        $cee_session = CeeSession::where('status', 'active')->first();

        if (!$cee_session) {
            return redirect()->back()
                ->with('error', 'No active CEE session found.')
                ->withInput();
        }

        try {
            Log::info('Starting profile creation');
            Log::info('Request data:', $request->all());

            DB::beginTransaction();
            Log::info('Transaction started');

            $userId = Auth::id();
            Log::info('User ID: ' . $userId);

            $validator = Validator::make($request->all(), (new StoreStudentProfileRequest)->rules());

            if ($validator->fails()) {
                Log::error('Validation failed: ', $validator->errors()->toArray());
                DB::rollBack();

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            Log::info('Validation passed');

            $data = array_map(
                fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value,
                $request->validated()
            );

            Log::info('Data transformed');

            if (isset($data['blood_type'])) {
                $data['blood_type'] = trim($data['blood_type']);
            }

            $data['middle_initial'] = $request->input('middle_name')
                ? strtoupper(substr(trim($request->input('middle_name')), 0, 1)) . '.'
                : null;

            $data['res_region'] = $data['region_text-res'] ?? null;
            $data['res_province'] = $data['province_text-res'] ?? null;
            $data['res_towncity'] = $data['city_text-res'] ?? null;
            $data['res_barangay'] = $data['barangay_text-res'] ?? null;

            $data['res_address'] = implode(', ', array_filter([
                $request->input('res_street'),
                $request->input('barangay_text-res'),
                $request->input('city_text-res'),
                $request->input('province_text-res'),
                $request->input('res_zipcode'),
            ]));

            $data['perm_region'] = $data['region_text-perm'] ?? null;
            $data['perm_province'] = $data['province_text-perm'] ?? null;
            $data['perm_towncity'] = $data['city_text-perm'] ?? null;
            $data['perm_barangay'] = $data['barangay_text-perm'] ?? null;

            $data['perm_address'] = implode(', ', array_filter([
                $request->input('perm_street'),
                $request->input('barangay_text-perm'),
                $request->input('city_text-perm'),
                $request->input('province_text-perm'),
                $request->input('perm_zipcode'),
            ]));

            $data['guardian_address'] = implode(', ', array_filter([
                $request->input('guardian_street'),
                $request->input('barangay_text-guardian'),
                $request->input('city_text-guardian'),
                $request->input('province_text-guardian'),
                $request->input('guardian_zipcode'),
            ]));

            $data['guardian_region'] = $data['region_text-guardian'] ?? null;
            $data['guardian_province'] = $data['province_text-guardian'] ?? null;
            $data['guardian_towncity'] = $data['city_text-guardian'] ?? null;
            $data['guardian_barangay'] = $data['barangay_text-guardian'] ?? null;

            $data['user_id'] = $userId;
            $data['preregistration_id'] = $cee_session->id;

            Log::info('Attempting to create/update profile');
            Log::info('Data for creation:', $data);

            try {
                $profile = StundentProfile::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'preregistration_id' => $cee_session->id,
                    ],
                    $data
                );

                Log::info('Profile saved with ID: ' . $profile->id);
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

            $cee_session = CeeSession::where('status', 'active')->first();

            if (!$cee_session) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active CEE session found.'
                ], 404);
            }

            $studentProfile = StundentProfile::where('user_id', $userId)
                ->where('preregistration_id', $cee_session->id)
                ->first();

            if (!$studentProfile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student profile not found.'
                ], 404);
            }

            $studentProfile->update([
                'applicant_profile_status' => 1,
                'current_step' => 5,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Student profile published successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error publishing student profile: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveNSTPPreference(Request $request)
    {
        try {
            $userId = Auth::id();

            $cee_session = CeeSession::where('status', 'active')->first();

            if (!$cee_session) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active CEE session found.'
                ], 404);
            }

            $validated = $request->validate([
                'nstp' => 'required|string|max:50',
            ]);

            $studentProfile = StundentProfile::where('user_id', $userId)
                ->where('preregistration_id', $cee_session->id)
                ->first();

            if (!$studentProfile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student profile not found.'
                ], 404);
            }

            $studentProfile->update([
                'is_answered_nstp' => 1,
                'nstp' => trim($validated['nstp']),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your NSTP preference has been saved successfully!'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error saving NSTP preference: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
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
