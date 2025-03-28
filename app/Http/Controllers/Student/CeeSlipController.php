<?php

namespace App\Http\Controllers\Student;


use Endroid\QrCode\QrCode;

use Illuminate\Http\Request;
use Endroid\QrCode\Logo\Logo;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Support\Facades\Crypt;
use Endroid\QrCode\RoundBlockSizeMode;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\ErrorCorrectionLevel;



class CeeSlipController extends Controller
{
    public function generateceeExamSlip(Request $request)
    {
        // Retrieve the current authenticated user details
        $studentdetails = Auth::user();

        // Check if the student's profile is complete
        if (
            !$studentdetails->lrn ||
            !$studentdetails->schoolid ||
            !$studentdetails->birthdate ||
            !$studentdetails->shs_school ||
            !$studentdetails->school_address ||
            !$studentdetails->region ||
            !$studentdetails->province ||
            !$studentdetails->city ||
            !$studentdetails->brgy ||
            !$studentdetails->zipcode ||
            !$studentdetails->photo
        ) {
            return redirect()->route('student.dashboard');
        }

        // Decrypt application number
        $app_no = unserialize(Crypt::decryptString($request->app_no));

        // Fetch reservation details
        $cee_reservation = DB::table('reservations')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->where('reservations.app_no', $app_no)
            ->select(
                'reservations.user_id',
                'reservations.app_no',
                'reservations.firstpriorty_desc',
                'reservations.secondpriority_desc',
                'reservations.thirdpriorty_desc',
                'reservations.campus_id',
                'reservations.is_repeat_exam',
                'rooms.room_name',
                'rooms.college_name',
                'rooms.campus',
                'rooms.exam_session',
                'rooms.map_file',
                'rooms.time',
                'rooms.schedule',
                'users.firstname',
                'users.lastname',
                'users.middlename',
                'users.email',
                'users.suffix',
                'users.sex',
                'users.phone',
                'users.photo',
                'users.birthdate'
            )
            ->first();

        // Ensure we have valid reservation data
        if (!$cee_reservation) {
            return redirect()->route('student.dashboard')->with('error', 'Reservation not found.');
        }

        // Generate QR code with app_no, firstname, and lastname
        $qrData = $cee_reservation->app_no . ',' . $cee_reservation->firstname . ' ';

        if (!empty($cee_reservation->middlename)) {
            $qrData .= $cee_reservation->middlename . ' ';
        }

        $qrData .= $cee_reservation->lastname;

        $writer = new PngWriter();

        $qrCode = new QrCode(
            data: $qrData,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $result = $writer->write($qrCode);

        // Define file path for QR Code
        $qrFilePath = 'qrcodes/' . $cee_reservation->app_no . '.png';
        Storage::disk('public')->put($qrFilePath, $result->getString());

        $qrCodeUrl = storage_path('app/public/' . $qrFilePath);

        // Generate the PDF
        $pdf = PDF::loadView('student.cee-slip.exam-slip', compact('cee_reservation', 'qrCodeUrl'))
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        //return view('student.cee-slip.exam-slip', compact('cee_reservation', 'base64QrCode'));
        // Stream the PDF instead of downloading it
        return $pdf->download($cee_reservation->app_no . '-usmcee-slip.pdf');
    }
}
