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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

    // public function printCOR(Request $request, $id)
    // {
    //     // Fetch student or fail
    //     $student = StundentProfile::findOrFail($id);

    //     // Validate required fields early
    //     if (empty($student->app_no) || empty($student->curriculum_id)) {
    //         abort(400, 'Incomplete student data.');
    //     }

    //     // Format full name safely
    //     $fullName = trim(
    //         "{$student->last_name}, {$student->first_name} " . ($student->middle_initial ?? '')
    //     );

    //     // Normalize gender
    //     $gender = match (strtoupper($student->gender ?? '')) {
    //         'M', 'MALE' => 'Male',
    //         'F', 'FEMALE' => 'Female',
    //         default => 'Male',
    //     };

    //     // Scalable campus → report mapping
    //     $reportMap = [
    //         1 => 'TempCert',
    //         3 => 'TempCert_KCC',
    //         // Add more campuses here
    //     ];

    //     $reportName = $reportMap[$student->campus_id] ?? 'TempCert';

    //     // Prepare payload
    //     $payload = [
    //         'Name' => $fullName ?: 'N/A',
    //         'AccountNumber' => (string) $student->app_no,
    //         'Gender' => $gender,
    //         'CurriculumID' => (string) $student->curriculum_id,
    //         'PrintedBy' => auth()->user()->name ?? 'System',
    //     ];

    //     try {
    //         $response = Http::timeout(120)
    //             ->retry(3, 2000)
    //             ->withQueryParameters([
    //                 'folder' => 'enrollment',
    //                 'reportName' => $reportName,
    //             ])
    //             ->post('http://172.16.0.41/api/app/reports/get-pdf-report', $payload);

    //         if ($response->failed()) {
    //             abort(500, 'Report API failed.');
    //         }

    //         // Decode response
    //         $rawBody = $response->body();
    //         $decoded = json_decode($rawBody, true);

    //         $base64 = is_string($decoded)
    //             ? $decoded
    //             : trim($rawBody, '"');

    //         $pdfContent = base64_decode($base64);

    //         // Validate PDF
    //         if (!$pdfContent || !str_starts_with($pdfContent, '%PDF')) {
    //             abort(500, 'Invalid PDF received.');
    //         }

    //         // Friendly filename
    //         $safeLastName = preg_replace('/[^A-Za-z0-9]/', '_', $student->last_name);
    //         $friendlyName = "COR_{$safeLastName}_{$student->app_no}.pdf";

    //         return response($pdfContent)
    //             ->header('Content-Type', 'application/pdf')
    //             ->header('Content-Disposition', "inline; filename=\"{$friendlyName}\"");

    //     } catch (\Exception $e) {
    //         abort(500, 'Something went wrong while generating the report.');
    //     }
    // }

    public function printCOR(Request $request, $id)
    {
        Log::info('PRINT COR: Request received', [
            'student_id' => $id,
            'requested_by' => auth()->id(),
        ]);

        // Fetch student or fail
        $student = StundentProfile::findOrFail($id);

        // Validate required fields early
        if (empty($student->app_no) || empty($student->curriculum_id)) {
            Log::warning('PRINT COR: Incomplete student data', [
                'student_id' => $student->id,
                'app_no' => $student->app_no,
                'curriculum_id' => $student->curriculum_id,
            ]);

            abort(400, 'Incomplete student data.');
        }

        // Format full name safely
        $fullName = trim(
            "{$student->last_name}, {$student->first_name} " . ($student->middle_initial ?? '')
        );

        // Normalize gender
        $gender = match (strtoupper($student->gender ?? '')) {
            'M', 'MALE' => 'Male',
            'F', 'FEMALE' => 'Female',
            default => 'Male',
        };

        // Scalable campus → report mapping
        $reportMap = [
            1 => 'TempCert',
            3 => 'TempCert_KCC',
        ];

        $reportName = $reportMap[$student->campus_id] ?? 'TempCert';

        // Prepare payload
        $payload = [
            'Name' => $fullName ?: 'N/A',
            'AccountNumber' => (string) $student->app_no,
            'Gender' => $gender,
            'CurriculumID' => (string) $student->curriculum_id,
            'PrintedBy' => auth()->user()->name ?? 'System',
        ];

        Log::info('PRINT COR: Sending request to Report API', [
            'student_id' => $student->id,
            'report_name' => $reportName,
            'payload_preview' => [
                'AccountNumber' => $payload['AccountNumber'],
                'CurriculumID' => $payload['CurriculumID'],
            ],
        ]);

        try {
            $response = Http::timeout(120)
                ->retry(3, 2000)
                ->withQueryParameters([
                    'folder' => 'enrollment',
                    'reportName' => $reportName,
                ])
                ->post('http://172.16.0.41/api/app/reports/get-pdf-report', $payload);

            if ($response->failed()) {
                Log::error('PRINT COR: Report API failed', [
                    'student_id' => $student->id,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                abort(500, 'Report API failed.');
            }

            Log::info('PRINT COR: Report API success', [
                'student_id' => $student->id,
                'status' => $response->status(),
            ]);

            // Decode response
            $rawBody = $response->body();
            $decoded = json_decode($rawBody, true);

            $base64 = is_string($decoded)
                ? $decoded
                : trim($rawBody, '"');

            Log::info('PRINT COR: Decoding base64 PDF', [
                'student_id' => $student->id,
                'base64_length' => strlen($base64),
            ]);

            $pdfContent = base64_decode($base64);

            // Validate PDF
            if (!$pdfContent || !str_starts_with($pdfContent, '%PDF')) {
                Log::error('PRINT COR: Invalid PDF received', [
                    'student_id' => $student->id,
                    'base64_sample' => substr($base64, 0, 100),
                ]);

                abort(500, 'Invalid PDF received.');
            }

            // Friendly filename
            $safeLastName = preg_replace('/[^A-Za-z0-9]/', '_', $student->last_name);
            $friendlyName = "COR_{$safeLastName}_{$student->app_no}.pdf";

            Log::info('PRINT COR: PDF generated successfully', [
                'student_id' => $student->id,
                'filename' => $friendlyName,
            ]);

            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', "inline; filename=\"{$friendlyName}\"");

        } catch (\Exception $e) {
            Log::critical('PRINT COR: Exception occurred', [
                'student_id' => $student->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(500, 'Something went wrong while generating the report.');
        }
    }
}
