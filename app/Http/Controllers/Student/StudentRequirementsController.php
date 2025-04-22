<?php

namespace App\Http\Controllers\Student;

use App\Models\Reservation;
use App\Models\Requirements;
use Illuminate\Http\Request;
use App\Models\StundentProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentRequirementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applicant = StundentProfile::where('user_id', Auth::user()->id)
            ->select(
                'id',
                'user_id',
                'student_type',
                'freshmen_type',
                'applicant_profile_status'
            )
            ->first();

        //check if user id exists in Requirements table
        $requirements = Requirements::where('user_id', Auth::user()->id)->get();

        return view('student.requirements.requirements', compact('applicant', 'requirements'));
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

    public function store(Request $request)
    {
        $request->validate(
            [
                'psa_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
            ],
            [
                'psa_files.*.required' => 'Please upload a PSA file.',
                'psa_files.*.file' => 'The uploaded file must be a valid file.',
                'psa_files.*.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
                'psa_files.*.max' => 'Each file must not exceed 10 MB.',
            ]
        );

        $filePaths = [];

        if ($request->hasFile('psa_files')) {
            foreach ($request->file('psa_files') as $file) {
                // Get original filename and remove spaces
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // Replace spaces with underscores

                // Generate unique filename
                $filename = $originalName . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file
                $path = $file->storeAs('psa', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'doc/' . $filename;
            }
        }

        // Save file paths as JSON in database (modify based on your structure)
        Requirements::create([
            'user_id' => Auth::id(),
            'psa' => json_encode($filePaths),
        ]);

        return back()->with('success', 'PSA files uploaded successfully.');
    }

    public function storeGmc(Request $request)
    {
        $request->validate(
            [
                'gmc_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
            ],
            [
                'gmc_files.*.required' => 'Please upload a Good Moral Character file.',
                'gmc_files.*.file' => 'The uploaded file must be a valid file.',
                'gmc_files.*.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
                'gmc_files.*.max' => 'Each file must not exceed 10 MB.',
            ]
        );

        $filePaths = [];

        if ($request->hasFile('gmc_files')) {
            foreach ($request->file('gmc_files') as $file) {
                // Get original filename and remove spaces
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // Replace spaces with underscores

                // Generate unique filename
                $filename = $originalName . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file
                $path = $file->storeAs('gmc', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'doc/' . $filename;
            }
        }

        // Save file paths as JSON in database (modify based on your structure)
        Requirements::create([
            'user_id' => Auth::id(),
            'good_moral_char' => json_encode($filePaths),
        ]);

        return back()->with('success', 'GMC files uploaded successfully.');
    }

    public function storeCard(Request $request)
    {
        $request->validate(
            [
                'shs_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
            ],
            [
                'shs_files.*.required' => 'Please upload SHS Card file.',
                'shs_files.*.file' => 'The uploaded file must be a valid file.',
                'shs_files.*.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
                'shs_files.*.max' => 'Each file must not exceed 10 MB.',
            ]
        );

        $filePaths = [];

        if ($request->hasFile('shs_files')) {
            foreach ($request->file('shs_files') as $file) {
                // Get original filename and remove spaces
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // Replace spaces with underscores

                // Generate unique filename
                $filename = $originalName . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file
                $path = $file->storeAs('card', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'doc/' . $filename;
            }
        }

        // Save file paths as JSON in database (modify based on your structure)
        Requirements::create([
            'user_id' => Auth::id(),
            'shs_card' => json_encode($filePaths),
        ]);

        return back()->with('success', 'Card files uploaded successfully.');
    }

    public function storecertification(Request $request)
    {
        $request->validate(
            [
                'enrollment_certification.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
            ],
            [
                'enrollment_certification.*.required' => 'Please upload Enrollment Certification file.',
                'enrollment_certification.*.file' => 'The uploaded file must be a valid file.',
                'enrollment_certification.*.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
                'enrollment_certification.*.max' => 'Each file must not exceed 10 MB.',
            ]
        );

        $filePaths = [];

        if ($request->hasFile('enrollment_certification')) {
            foreach ($request->file('enrollment_certification') as $file) {
                // Get original filename and remove spaces
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // Replace spaces with underscores

                // Generate unique filename
                $filename = $originalName . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file
                $path = $file->storeAs('enrollment_certification', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'doc/' . $filename;
            }
        }

        // Save file paths as JSON in database (modify based on your structure)
        Requirements::create([
            'user_id' => Auth::id(),
            'enrolment_certification' => json_encode($filePaths),
        ]);

        return back()->with('success', 'Enrollment Certification files uploaded successfully.');
    }

    public function storeDismissal(Request $request)
    {
        $request->validate(
            [
                'honorable_dismisal_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
            ],
            [
                'honorable_dismisal_files.*.required' => 'Please upload Honorable Dismissal file.',
                'honorable_dismisal_files.*.file' => 'The uploaded file must be a valid file.',
                'honorable_dismisal_files.*.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
                'honorable_dismisal_files.*.max' => 'Each file must not exceed 10 MB.',
            ]
        );

        $filePaths = [];

        if ($request->hasFile('honorable_dismisal_files')) {
            foreach ($request->file('honorable_dismisal_files') as $file) {
                // Get original filename and remove spaces
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // Replace spaces with underscores

                // Generate unique filename
                $filename = $originalName . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file
                $path = $file->storeAs('honorable_dismisal', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'doc/' . $filename;
            }
        }

        // Save file paths as JSON in database (modify based on your structure)
        Requirements::create([
            'user_id' => Auth::id(),
            'honorable_dismisal' => json_encode($filePaths),
        ]);

        return back()->with('success', 'Honorable Dismissal files uploaded successfully.');
    }

    public function storeTOR(Request $request)
    {
        $request->validate(
            [
                'tor_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
            ],
            [
                'tor_files.*.required' => 'Please upload Honorable Dismissal file.',
                'tor_files.*.file' => 'The uploaded file must be a valid file.',
                'tor_files.*.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
                'tor_files.*.max' => 'Each file must not exceed 10 MB.',
            ]
        );

        $filePaths = [];

        if ($request->hasFile('tor_files')) {
            foreach ($request->file('tor_files') as $file) {
                // Get original filename and remove spaces
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // Replace spaces with underscores

                // Generate unique filename
                $filename = $originalName . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file
                $path = $file->storeAs('tor', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'doc/' . $filename;
            }
        }

        // Save file paths as JSON in database (modify based on your structure)
        Requirements::create([
            'user_id' => Auth::id(),
            'tor' => json_encode($filePaths),
        ]);

        return back()->with('success', 'Trancript of Records uploaded successfully.');
    }


    public function publishRequirements(Request $request)
    {
        try {
            $userId = Auth::id();

            // Update all records where user_id matches
            $updated = Requirements::where('user_id', $userId)->update(['req_status' => 1]);

            if ($updated === 0) {
                return response()->json(['success' => false, 'message' => 'No requirements found to update.'], 404);
            }

            return response()->json(['success' => true, 'message' => 'All applicant requirements published successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function additionalRequiremtIndex(Request $request)
    {
        $applicant = StundentProfile::where('user_id', Auth::user()->id)
            ->select(
                'id',
                'user_id',
                'student_type',
                'freshmen_type',
                'applicant_profile_status',
                'gender'
            )
            ->first();

        //check if user id exists in Requirements table
        $requirements = Requirements::where('user_id', Auth::user()->id)->get();

        //fetch also the program_policy_id from reservation
        $prog_policy_id = Reservation::where('user_id', Auth::user()->id)
            ->where('status', 'confirmed')
            ->first();

        return view('student.requirements.additional-requirements', compact('applicant', 'requirements', 'prog_policy_id'));
    }

    public function storeHepab(Request $request)
    {
        $request->validate(
            [
                'hepb_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
            ],
            [
                'hepb_files.*.required' => 'Please upload Hepa B Test Result file.',
                'hepb_files.*.file' => 'The uploaded file must be a valid file.',
                'hepb_files.*.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
                'hepb_files.*.max' => 'Each file must not exceed 10 MB.',
            ]
        );

        $filePaths = [];

        if ($request->hasFile('hepb_files')) {
            foreach ($request->file('hepb_files') as $file) {
                // Get original filename and remove spaces
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // Replace spaces with underscores

                // Generate unique filename
                $filename = $originalName . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file
                $path = $file->storeAs('hepa-b', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'doc/' . $filename;
            }
        }

        // Save file paths as JSON in database (modify based on your structure)
        Requirements::create([
            'user_id' => Auth::id(),
            'hepa_b_test' => json_encode($filePaths),
        ]);

        return back()->with('success', 'Hepa B Test Result uploaded successfully.');
    }

    public function storeChestXray(Request $request)
    {
        $request->validate(
            [
                'chestxray_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
            ],
            [
                'chestxray_files.*.required' => 'Please upload Chest X-Ray Test file.',
                'chestxray_files.*.file' => 'The uploaded file must be a valid file.',
                'chestxray_files.*.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
                'chestxray_files.*.max' => 'Each file must not exceed 10 MB.',
            ]
        );

        $filePaths = [];

        if ($request->hasFile('chestxray_files')) {
            foreach ($request->file('chestxray_files') as $file) {
                // Get original filename and remove spaces
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // Replace spaces with underscores

                // Generate unique filename
                $filename = $originalName . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file
                $path = $file->storeAs('chest-xray', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'doc/' . $filename;
            }
        }

        // Save file paths as JSON in database (modify based on your structure)
        Requirements::create([
            'user_id' => Auth::id(),
            'chest_x_ray' => json_encode($filePaths),
        ]);

        return back()->with('success', 'Chest X-Rays Result uploaded successfully.');
    }
    /**
     * Display the specified resource.
     *
     */

    public function storePrenancyTest(Request $request)
    {
        $request->validate(
            [
                'pregnancyTest_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
            ],
            [
                'pregnancyTest_files.*.required' => 'Please upload Prenancy Test Test Result file.',
                'pregnancyTest_files.*.file' => 'The uploaded file must be a valid file.',
                'pregnancyTest_files.*.mimes' => 'Only jpg, jpeg, png, and pdf files are allowed.',
                'pregnancyTest_files.*.max' => 'Each file must not exceed 10 MB.',
            ]
        );

        $filePaths = [];

        if ($request->hasFile('pregnancyTest_files')) {
            foreach ($request->file('pregnancyTest_files') as $file) {
                // Get original filename and remove spaces
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalName = str_replace(' ', '_', $originalName); // Replace spaces with underscores

                // Generate unique filename
                $filename = $originalName . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store the file
                $path = $file->storeAs('pregnancy-test', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'doc/' . $filename;
            }
        }

        // Save file paths as JSON in database (modify based on your structure)
        Requirements::create([
            'user_id' => Auth::id(),
            'preg_test' => json_encode($filePaths),
        ]);

        return back()->with('success', 'Pregnancy Test uploaded successfully.');
    }

    public function publishAdditionalRequirements(Request $request)
    {
        try {
            $userId = Auth::id();

            // Update all records where user_id matches
            $updated = Requirements::where('user_id', $userId)->update(['additional_req_status' => 1, 'req_status' => 1]);

            if ($updated === 0) {
                return response()->json(['success' => false, 'message' => 'No requirements found to update.'], 404);
            }

            return response()->json(['success' => true, 'message' => 'All applicant requirements published successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
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

    public function deleteRequirements($requirementId, $type)
    {
        $folderMap = [
            'hepa_b_test' => 'hepa-b',
            'chest_xray' => 'chest-xray',
            'pregnancy_test' => 'pregnancy-test',
            'psa' => 'psa',
            'gmc' => 'gmc',
            'card' => 'card',
            'certification' => 'enrollment_certification',
            'honorable-dismissal' => 'honorable_dismisal',
            'tor' => 'tor',
        ];

        if (!array_key_exists($type, $folderMap)) {
            return back()->with('error', 'Invalid requirement type.');
        }

        $requirement = Requirements::findOrFail($requirementId);

        $field = $requirement->{$type};
        $files = json_decode($field, true);

        if (is_array($files)) {
            foreach ($files as $file) {
                // Replace "doc/" with actual folder
                $relativePath = str_replace('doc/', $folderMap[$type] . '/', $file);

                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
            }
        }

        // Remove the field or delete the whole record
        $requirement->delete(); // or $requirement->update([$type => null]);

        return back()->with('success', ucfirst(str_replace('_', ' ', $type)) . ' requirement deleted successfully.');
    }
}
