<?php

namespace App\Http\Controllers\Student;

use setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\StundentProfile;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use setasign\Fpdi\PdfParser\StreamReader;

class StudentCORController extends Controller
{
    public function showReportView(Request $request)
    {
        // Log the incoming request
        Log::info('showReportView method called', ['request' => $request->all()]);

        // Perform the same logic to fetch the report, as shown earlier
        $response = $this->viewPdfReport($request);
        $responseData = $response->getData();

        // Check if the response was successful
        if ($responseData->success) {
            // Log::info('PDF report fetched successfully', [
            //     'pdf_url' => $responseData->pdf_url,
            //     'download_url' => $responseData->download_url
            // ]);

            return view('student.prereg.cor.cor', [
                'pdfUrl' => $responseData->pdf_url,
                'downloadUrl' => $responseData->download_url,
            ]);
        }

        // Log the failure if unable to fetch the report
        Log::error('Failed to fetch the report', ['error_message' => 'Unable to fetch the report.']);

        // Handle errors and return response
        return redirect()->route('student.prereg.index')->with('error', 'Something went wrong while saving.');
    }

    public function downloadCOR()
    {
        $user_id = Auth::id();

        // Get the active student profile
        $studentProfile = StundentProfile::join(
            'cee_sessions',
            'cee_sessions.id',
            '=',
            'stundent_profiles.preregistration_id'
        )
            ->where('stundent_profiles.user_id', $user_id)
            ->where('cee_sessions.status', 'active')
            ->select(
                'stundent_profiles.reg_no',
                'stundent_profiles.campusName'
            )
            ->first();

        if (!$studentProfile) {
            Log::warning('No active registration found for user ID: ' . $user_id);

            return response()->json([
                'message' => 'No active registration found.',
            ], 404);
        }

        $regID = $studentProfile->reg_no;
        $campusName = $studentProfile->campusName;

        Log::info('Downloading COR - User ID: ' . $user_id . ', RegID: ' . $regID . ', Campus: ' . $campusName);

        $apiUrl = 'http://172.16.0.41/api/app/reports/get-pdf-report';

        if ($campusName == 'USM Kidapawan City Campus') {
            $queryParams = [
                'folder' => 'enrollment',
                'reportName' => 'COR_KCC',
            ];
        } else {
            $queryParams = [
                'folder' => 'enrollment',
                'reportName' => 'COR',
            ];
        }

        Log::info('Sending API request to: ' . $apiUrl . '?' . http_build_query($queryParams));

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest',
        ])->post($apiUrl . '?' . http_build_query($queryParams), [
                    'RegID' => $regID,
                ]);

        Log::info('API Response Status: ' . $response->status());

        if ($response->successful()) {
            $pdfContent = base64_decode($response->body());

            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="COR-' . $regID . '.pdf"');
        }

        Log::error('Failed to fetch COR. Status: ' . $response->status() . ' Body: ' . $response->body());

        return response()->json([
            'message' => 'Failed to fetch Certificate of Registration.',
            'status' => $response->status(),
        ], $response->status());
    }


    public function downloadCOR2(Request $request)
    {
        $user_id = Auth::user()->id;
        $regID = StundentProfile::where('user_id', $user_id)
            ->select('reg_no')->first();

        $url = 'http://172.16.0.41/api/app/reports/get-pdf-report?folder=enrollment&reportName=COR';

        // Build the JSON string manually and encode it
        $jsonString = json_encode([
            // 'RegID' => $regID
            'RegID' => $regID->reg_no,

        ]);

        $payload = [
            'parameters' => $jsonString // This is the critical part
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest',
            'accept' => 'text/plain',
        ])->post($url, $payload);

        if ($response->failed()) {
            return response()->json([
                'error' => 'API request failed',
                'status' => $response->status(),
                'message' => $response->body()
            ], 400);
        }

        $base64Pdf = $response->body();
        $pdfData = base64_decode($base64Pdf);

        if ($pdfData === false) {
            return response()->json(['error' => 'Failed to decode PDF data'], 500);
        }

        $filename = 'COR-' . $regID . '-' . strtoupper(uniqid()) . '.pdf';

        return Response::make($pdfData, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function viewPdfReport(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $studentProfile = StundentProfile::where('user_id', $user_id)
                ->select('reg_no')->first();

            if (!$studentProfile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student profile not found for the current user',
                ], 404);
            }

            $regId = $studentProfile->reg_no;
            $folder = $request->query('folder', 'enrollment');
            $reportName = $request->query('reportName', 'COR');
            $filename = $reportName . '_' . $regId . '.pdf';

            $url = 'http://172.16.0.41/api/app/reports/get-pdf-report?folder=enrollment&reportName=COR';

            $response = Http::withHeaders([
                'Accept' => 'text/plain',
                'Content-Type' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
            ])->post($url, [
                        'RegID' => $regId
                    ]);

            if (!$response->successful()) {
                Log::error('API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch PDF from API',
                    'error' => $response->json() ?? $response->body(),
                ], $response->status());
            }

            $base64PdfData = $response->body();
            $pdfData = base64_decode($base64PdfData);

            if (!$pdfData) {
                return response()->json(['success' => false, 'message' => 'Failed to decode PDF data'], 500);
            }

            // 1) Ensure the directory exists:
            $reportsDir = storage_path('app/public/reports');
            if (!is_dir($reportsDir)) {
                mkdir($reportsDir, 0755, true);
            }

            // 2) Write the file:
            $filePath = $reportsDir . DIRECTORY_SEPARATOR . $filename;
            file_put_contents($filePath, $pdfData);

            // Return the URLs
            return response()->json([
                'success' => true,
                'pdf_url' => asset('storage/reports/' . $filename),
                'download_url' => route('student.download-pdf', ['filename' => $filename]),
            ]);
        } catch (\Exception $e) {
            Log::error('Exception in viewPdfReport', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the PDF',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // public function viewPdfReport(Request $request)
    // {
    //     try {
    //         $user_id = Auth::user()->id;
    //         $studentProfile = StundentProfile::where('user_id', $user_id)
    //             ->select('reg_no')->first();

    //         if (!$studentProfile) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Student profile not found for the current user',
    //             ], 404);
    //         }

    //         $regId = $studentProfile->reg_no;
    //         $folder = $request->query('folder', 'enrollment');
    //         $reportName = $request->query('reportName', 'COR');
    //         $filename = $reportName . '_' . $regId . '.pdf';

    //         $apiUrl = config('services.pdf_api.url') . '/api/app/reports/get-pdf-report';
    //         $apiUrl .= '?folder=' . urlencode($folder) . '&reportName=' . urlencode($reportName);

    //         $response = Http::withHeaders([
    //             'Accept' => 'text/plain',
    //             'Content-Type' => 'application/json',
    //             'X-Requested-With' => 'XMLHttpRequest',
    //         ])->post($apiUrl, [
    //                     'RegID' => $regId
    //                 ]);

    //         if (!$response->successful()) {
    //             Log::error('API Error', [
    //                 'status' => $response->status(),
    //                 'body' => $response->body()
    //             ]);

    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Failed to fetch PDF from API',
    //                 'error' => $response->json() ?? $response->body(),
    //             ], $response->status());
    //         }

    //         $base64PdfData = $response->body();
    //         $pdfData = base64_decode($base64PdfData);

    //         if (!$pdfData) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Failed to decode PDF data',
    //             ], 500);
    //         }

    //         return response($pdfData)
    //             ->header('Content-Type', 'application/pdf')
    //             ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

    //     } catch (\Exception $e) {
    //         Log::error('Exception in viewPdfReport', [
    //             'message' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while processing the PDF',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }


    // }

    public function generateDtrReport()
    {
        // Static data for demonstration
        $employeeId = '16-03101';  // Hardcoded EmployeeID
        $startDate = Carbon::parse('April 1, 2025')->format('m/d/Y');
        $endDate = Carbon::parse('April 30, 2025')->format('m/d/Y');

        // API configuration
        $url = 'http://172.16.0.41/api/app/reports/get-pdf-report?folder=hr&reportName=dtr-new';

        try {
            // Make API request with static data
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($url, [
                    'EmployeeID' => $employeeId,
                    'StartDate' => $startDate,
                    'EndDate' => $endDate,
                ]);

            if (!$response->successful()) {
                throw new \Exception('API request failed with status: ' . $response->status());
            }

            // Process PDF response
            $base64Pdf = $response->json();
            $pdfData = base64_decode($base64Pdf);

            if ($pdfData === false) {
                throw new \Exception('Failed to decode PDF data');
            }

            // Generate filename
            $filename = sprintf('%s-%s.pdf', $employeeId, strtoupper(uniqid()));

            // Stream PDF response
            return response()->streamDownload(
                function () use ($pdfData) {
                    echo $pdfData;
                },
                $filename,
                ['Content-Type' => 'application/pdf']
            );

        } catch (\Exception $e) {
            // For production, you might want to log this error
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
