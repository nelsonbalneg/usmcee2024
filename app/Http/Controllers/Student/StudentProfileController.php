<?php

namespace App\Http\Controllers\Student;

use Auth;
use File;
use App\Models\User;
use App\Models\SchoolName;
use Illuminate\Http\Request;
use App\Trait\ImageUploadTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentdetails = User::where("id", Auth::user()->id)->first();
        // Ensure empty strings for NULL values to avoid issues in JavaScript
        $studentdetails->region = $studentdetails->region ?? '';
        $studentdetails->province = $studentdetails->province ?? '';
        $studentdetails->city = $studentdetails->city ?? '';
        $studentdetails->brgy = $studentdetails->brgy ?? '';

        return view("student.profile.profile", compact('studentdetails'));
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
        //
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
        // validation
        $request->validate(
            [
                'lrn' => ['required', 'string', 'size:12', 'unique:users,lrn'],
                'track' => ['required', 'string', 'max:100'],
                'school_id' => ['required'],
                'school_name' => ['required'],
                'school_address' => ['required'],
                'region_text' => ['required'],
                'province_text' => ['required'],
                'city_text' => ['required'],
                'barangay_text' => ['required'],

            ],
            [
                'lrn.size' => 'The LRN must be exactly 12 characters.',
                'lrn.unique' => 'The LRN has already been taken.'
            ]
        );

        $user = User::findOrFail($id);

        $user->lrn = trim($request->lrn);
        $user->track = trim($request->track);
        $user->schoolid = trim($request->school_id);
        $user->shs_school = trim($request->school_name);
        $user->school_address = trim($request->school_address);
        $user->region = trim($request->region_text);
        $user->province = trim($request->province_text);
        $user->city = trim($request->city_text);
        $user->brgy = trim($request->barangay_text);
        $user->street = trim($request->street);
        $user->zipcode = trim($request->zipcode);

        // // Handle photo upload
        // $imagePath = $this->updateImage($request, 'photo', 'uploads', $user->photo);
        // $user->photo = empty(!$imagePath) ? $imagePath : $user->photo;

        $user->save();

        return redirect()->back()->with('message', 'Your profile has been successfully updated! To reserve a slot, please go to the RESERVATION menu.');
    }

    public function uploadPhoto(Request $request)
    {
        // validation
        $request->validate(
            [
                'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:5120'],

            ]
        );

        $user = User::findOrFail($request->id);

        // Handle photo upload
        $imagePath = $this->updateImage($request, 'photo', 'uploads', $user->photo);
        $user->photo = empty(!$imagePath) ? $imagePath : $user->photo;

        $user->save();

        return redirect()->back()->with('message', 'Your Profile Photo has been updated!');
    }

    public function school_name(Request $request): JsonResponse
    {
        // Check if 'schoolid' is provided in the request
        if ($request->has('schoolid')) {
            // Fetch records where 'schoolid' matches the provided value
            $schools = SchoolName::where('schoolid', $request->input('schoolid'))->get();
        } else {
            // Fetch all records if 'schoolid' is not provided
            $schools = SchoolName::all();
        }

        // Return the results in JSON format
        return response()->json($schools);
    }

    public function getLrn(Request $request): JsonResponse
    {
        if ($request->has('lrn')) {
            // Check if a record exists where 'lrn' matches the provided value
            $exists = User::where('lrn', $request->input('lrn'))->exists();

            return response()->json(['exists' => $exists]);
        }

        // If 'lrn' is not provided, return false by default
        return response()->json(['exists' => false]);
    }

    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tesseractPath = '/usr/bin/tesseract';
        if (!file_exists($tesseractPath)) {
            return response()->json([
                'success' => false,
                'error' => 'Tesseract executable not found at the specified path.',
            ]);
        }

        $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(sys_get_temp_dir(), basename($tempFilePath));

        $command = [$tesseractPath, $tempFilePath, 'stdout'];
        $descriptorSpec = [
            1 => ['pipe', 'w'], // stdout
            2 => ['pipe', 'w'], // stderr
        ];

        $process = proc_open($command, $descriptorSpec, $pipes);
        $output = '';
        
        try {
            if (is_resource($process)) {
                // Set a timeout (in seconds)
                $timeout = 60;
                $startTime = time();

                // Read output while checking the timeout
                while (!feof($pipes[1])) {
                    if (time() - $startTime > $timeout) {
                        proc_terminate($process); // Forcefully terminate if it times out
                        throw new Exception('Tesseract OCR process timed out.');
                    }
                    $output .= fread($pipes[1], 4096);
                }

                // Close pipes
                fclose($pipes[1]);
                fclose($pipes[2]);

                // Ensure the process exits
                proc_close($process);
            }
        } catch (Exception $e) {
            // Clean up in case of error
            if (is_resource($process)) {
                proc_terminate($process);
            }
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ]);
        } finally {
            // Clean up the temporary file
            if (file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }
        }

        $twelveDigitNumber = null;
        $sixDigitNumber = null;

        if (preg_match('/\b\d{12}\b/', $output, $twelveDigitMatch)) {
            $twelveDigitNumber = $twelveDigitMatch[0];
        }

        if (preg_match('/\b\d{6}\b/', $output, $sixDigitMatch)) {
            $sixDigitNumber = $sixDigitMatch[0];
        }

        if ($twelveDigitNumber || $sixDigitNumber) {
            return response()->json([
                'success' => true,
                'text' => $output,
                'twelve_digit_number' => $twelveDigitNumber,
                'six_digit_number' => $sixDigitNumber,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'No LRN found in the image.',
                'text' => $output,
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
