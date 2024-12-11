<?php

namespace App\Http\Controllers\Student;

use DB;
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Barryvdh\DomPDF\Facade\Pdf;


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
            // !$studentdetails->street ||
            !$studentdetails->zipcode ||
            !$studentdetails->photo
        ) {
            // Redirect to the dashboard if the profile is incomplete
            return redirect()->route('student.dashboard');
        }

        $app_no = Crypt::decryptString($request->app_no);

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

        // Generate QR code with app_no, firstname, and lastname
        $qrData = $cee_reservation->app_no . ',' . $cee_reservation->firstname . ' ';

        if (!empty($cee_reservation->middlename)) {
            $qrData .= $cee_reservation->middlename . ' ';
        }

        $qrData .= $cee_reservation->lastname;


        // Create the QR code
        $qrCode = new QrCode($qrData);

        // Create a PNG writer
        $writer = new PngWriter();

        // Generate the QR code image and encode it as a string
        $qrImage = $writer->write($qrCode)->getString();

        // Encode the QR code image to base64
        $base64QrCode = base64_encode($qrImage);

        // Pass the base64 QR code string to the view for inclusion in the PDF
        $pdf = PDF::loadView('student.cee-slip.exam-slip', compact('cee_reservation', 'base64QrCode'));

        // Stream the PDF instead of downloading it
        return $pdf->stream('usmcee-slip.pdf');
    }
}
