<?php

namespace App\Http\Controllers\Student;

use App\Models\Room;
use App\Models\Term;
use App\Models\CeeSession;
use App\Models\PastCeeData;
use App\Models\Reservation;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ChedApplicantProfile;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class StudentCeeReserveController extends Controller
{
    public function index()
    {
        // Retrieve the current authenticated user details
        $studentdetails = Auth::user();
        $ched_applicant_Profile = ChedApplicantProfile::where('user_id', Auth::id())
            ->where('status', 1)
            ->first();

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
            !$studentdetails->photo ||
            !$ched_applicant_Profile
        ) {
            // Redirect to the dashboard if the profile is incomplete
            return redirect()->route('student.dashboard');
        }

        $firstname = Auth::user()->firstname;
        $lastname = Auth::user()->lastname;
        $birthdate = Auth::user()->birthdate;
        $userId = Auth::user()->id;

        $ceeSession = CeeSession::where('status', 'active')->first();

        $reservationCount = 0;

        if ($ceeSession) {
            // Count the reservations for the current user
            $reservationCount = Reservation::where('cee_session_id', $ceeSession->id)
                ->where('user_id', Auth::user()->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->count();
        }



        $reservation_details = Reservation::where('user_id', Auth::id())
            ->orderByRaw("CASE
                            WHEN status = 'confirmed' THEN 1
                            WHEN status = 'pending' THEN 2
                            WHEN status = 'cancelled' THEN 3
                            ELSE 3
                          END")
            ->orderBy('created_at', 'desc') // Get the latest reservation
            ->first();

        $cee_reservation_records = DB::table('reservations')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->where('reservations.user_id', $userId)
            ->select(
                'reservations.user_id',
                'reservations.app_no',
                'reservations.firstpriorty_desc',
                'reservations.secondpriority_desc',
                'reservations.thirdpriorty_desc',
                'reservations.campus_id',
                'reservations.campus_id_prio_prog_2',
                'reservations.campus_id_prio_prog_3',
                'reservations.is_repeat_exam',
                'reservations.status',
                'reservations.created_at',
                'reservations.cee_session_id',
                'rooms.room_name',
                'rooms.college_name',
                'rooms.exam_session',
                'rooms.campus',
                'rooms.time',
                'rooms.schedule',
                'cee_sessions.name as session_name'
            )
            ->orderBy('reservations.created_at', 'desc')
            ->get();

        //check if name exist in the past cee data session
        $isRetaker = PastCeeData::where('firstname', $firstname)
            ->where('lastname', $lastname)
            ->where('birthdate', $birthdate)
            ->exists();

        $siteSetting = SiteSetting::first();
        $endofreservation = $siteSetting ? $siteSetting->endreservation : null;

        $campusNames = Term::where('is_active', 1)->get();


        return view("student.reserve.reserve", compact('ceeSession', 'isRetaker', 'endofreservation', 'cee_reservation_records', 'reservation_details', 'campusNames', 'reservationCount'));
    }

    // In your controller
    public function checkForDuplicateRecords()
    {
        $user = Auth::user();

        // Find other users with the same firstname, lastname, and birthdate
        $duplicates = User::where('firstname', $user->firstname)
            ->where('lastname', $user->lastname)
            ->where('birthdate', $user->birthdate)
            ->where('id', '!=', $user->id) // Exclude the current user
            ->exists();

        return response()->json([
            'hasDuplicates' => $duplicates,
        ]);
    }


    public function getProgramsByTenant(Request $request)
    {

        $tenantId = $request->query('tenantId');

        if (!$tenantId) {
            return response()->json(['error' => 'Tenant ID is required'], 400);
        }

        try {
            // Make the HTTP request with a timeout of 10 seconds
            $response = Http::timeout(10)->get("http://172.16.0.60/academic/api/v2/Programs/list", [
                'tenantId' => $tenantId
            ]);

            if ($response->successful()) {
                $programs = collect($response->json());
                $filteredPrograms = $programs->filter(function ($program) {
                    return !str_contains($program['progName'], 'Master') && !str_contains($program['progName'], 'Doctor') && !str_contains($program['progName'], 'Default');
                })->values();

                return response()->json($filteredPrograms);
            }

            return response()->json(['error' => 'Unable to fetch programs'], 500);

        } catch (\Illuminate\Http\Client\RequestException $e) {
            return response()->view('errors.500', [], 500);
        }
    }

    public function getProgramByRealCampusId(Request $request)
    {
        $termId = $request->query('termId');
        $realCampusId = $request->query('realCampusId');

        // Define a unique cache key based on termId and realCampusId
        $cacheKey = "program_policies_{$termId}_{$realCampusId}";

        // Cache the response for 60 minutes
        $programs = Cache::remember($cacheKey, 60, function () use ($termId, $realCampusId) {

            $response = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/cee-list/term/{$termId}/realcampus/{$realCampusId}");

            if ($response->successful()) {
                return collect($response->json());
            } else {
                return null; // Return null if the request fails
            }
        });

        if ($programs) {
            return response()->json($programs, 200);
        } else {
            Log::warning('No programs found or failed to fetch', [
                'termId' => $termId,
                'realCampusId' => $realCampusId,
            ]);
            return response()->json(['error' => 'Failed to fetch programs'], 500);
        }
    }

    public function getRoomsByExamSession(Request $request)
    {
        $session = $request->input('ceesession');

        // Retrieve rooms based on session
        $rooms = Room::where('exam_session', $session)
            ->where('status', 'active')
            ->where('capacity', '>', 0)
            ->get(['id', 'room_name', 'capacity', 'college_name']);

        return response()->json($rooms);
    }


    public function getCampusList()
    {
        // $response = Http::get('http://172.16.0.60/academic/api/v1/Campus/list');

        // if ($response->successful()) {
        //     // Assuming the API returns a JSON response with a data array
        //     $campusList = $response->json();
        // } else {
        //     // Handle the error
        //     $campusList = [];
        // }
    }

    public function countActiveSlots(Request $request)
    {
        $campus = $request->input('campus');

        $activeSlots = DB::table('rooms')
            ->join('cee_sessions', 'rooms.cee_session_id', '=', 'cee_sessions.id') // Join cee_session table
            ->where('rooms.campus', $campus)
            ->where('cee_sessions.status', 'active') // Check if the session is active
            ->where('rooms.status', 'active')
            ->sum('rooms.capacity');

        return response()->json(['activeSlots' => $activeSlots]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'ceesession' => 'required|integer',
        //     'campus' => 'required|string|max:100',
        //     'firstprioprog' => 'required|string|max:100',

        //     'secondprioprog' => 'required|string|max:100',

        //     'thirdprioprog' => 'required|string|max:100',

        //     'ceeexamsession' => 'required|string|max:50',
        //     'room' => 'required|string|max:100',
        // ]);

        // //check if record exists
        // $isReserved = Reservation::where('user_id', Auth::user()->id)->exists();
        // if ($isReserved) {
        //     return redirect()->back()->with([
        //         'message' => 'You have reserved a slot already!',
        //         'status' => 'error'
        //     ]);
        // }

        // // Check room availability
        // $checkifzero = Room::where('exam_session', $request->room)
        //     ->where('status', 'active')
        //     ->where('capacity', '<=', 0)
        //     ->exists();

        // if ($checkifzero) {
        //     return redirect()->back()->with([
        //         'message' => 'We are sorry! No more slots are available for this room. Please select a different session or room.',
        //         'status' => 'error'
        //     ]);
        // } else {
        //     $userId = Auth::user()->id;
        //     $ceeSession = $request->ceesession;
        //     $lastRow = Reservation::find(Reservation::max('id'));
        //     $lastId = $lastRow ? $lastRow->id : 0; // If no rows, start with 0

        //     // Format the date
        //     $formattedDate = Carbon::parse($request->created_at)->format('Ymd');

        //     // Concatenate the formatted date with the last ID incremented by 1
        //     $appno = 'CEE-' . $formattedDate . $userId . $ceeSession . ($lastId + 1);

        //     $checkifzero = Room::where('id', $request->room)
        //         ->where('status', 'active')
        //         ->where('capacity', '<=', 0)
        //         ->exists();

        //     if ($checkifzero) {
        //         return redirect()->back()->with([
        //             'message' => 'We are sorry! No more slots are available for this room. Please select a different session or room.',
        //             'status' => 'error'
        //         ]);
        //     }

        //     $application = new Reservation();
        //     $application->cee_session_id = trim($ceeSession);
        //     $application->user_id = trim($userId);
        //     $application->app_no = trim($appno);
        //     $application->campus_id = trim($request->campus);
        //     $application->campus_id_prio_prog_2 = trim($request->campus2);
        //     $application->campus_id_prio_prog_3 = trim($request->campus3);
        //     $application->firstpriorty = trim($request->firstprioprog);
        //     $application->firstpriorty_desc = trim($request->firstprioprog_desc);
        //     $application->secondpriorty = trim($request->secondprioprog);
        //     $application->secondpriority_desc = trim($request->secondprioprog_desc);
        //     $application->thirdpriorty = trim($request->thirdprioprog);
        //     $application->thirdpriorty_desc = trim($request->thirdprioprog_desc);
        //     $application->exam_session = trim($request->ceeexamsession);
        //     $application->room_id = trim($request->room);
        //     $application->is_repeat_exam = trim($request->is_repeat_exam);
        //     $application->save();

        //     // Update room quantity
        //     $room = Room::findOrFail($request->room);
        //     $roomCap = $room->capacity;
        //     $newRoomcap = $roomCap - 1;
        //     $room->capacity = $newRoomcap;
        //     $room->save();
        // }

        // return redirect()->back()->with([
        //     'message' => 'Congratulations! USMCEE Slot reservation Successful.',
        //     'status' => 'success'
        // 'ceeexamsession' => 'required|string|max:50',
        // ]);

        $request->validate([
            'ceesession' => 'required|integer',
            'campus' => 'required|string|max:100',
            'firstprioprog' => 'required|string|max:100',
            'secondprioprog' => 'required|string|max:100',
            'thirdprioprog' => 'required|string|max:100',

        ]);

        // Check if user has already reserved a slot
        // if (Reservation::where('user_id', Auth::user()->id)->exists()) {
        //     return redirect()->back()->with([
        //         'message' => 'You have already reserved a slot!',
        //         'status' => 'error'
        //     ]);
        // }

        // Check if user has already reserved a confirmed slot
        // if (
        //     Reservation::where('user_id', Auth::id())
        //         ->where('status', 'confirmed')
        //         ->exists()
        // ) {
        //     return redirect()->route('student.reserve.index')->with([
        //         'message' => 'You have already reserved a confirmed slot!',
        //         'status' => 'error'
        //     ]);
        // }

        // Get the active CEE session
        $activeSession = CeeSession::where('status', 'active')->first();

        $userHasConfirmed = Reservation::where('user_id', Auth::id())
            ->where('cee_session_id', $activeSession->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($userHasConfirmed) {
            return redirect()->route('student.reserve.index')->with([
                'message' => 'You already have a confirmed reservation in the active session!',
                'status' => 'error'
            ]);
        }

        // Find an available room based on campus, cee examsession, and cee session
        $room = Room::where('campus', $request->venue_campus)
            // ->where('exam_session', $request->ceeexamsession)
            ->where('cee_session_id', $request->ceesession)
            ->where('status', 'active')
            ->where('capacity', '>', 0)
            ->orderBy('sequence_no', 'asc') // Prefer rooms with the most space
            ->first();



        if (!$room) {
            return redirect()->route('student.reserve.index')->with([
                'message' => 'We are sorry! No available rooms for this selection. Please choose a different examination venue.',
                'status' => 'error'
            ]);
        }

        //Get the room batch
        $exam_batch = $room->exam_session;

        // Generate Application Number
        $userId = Auth::user()->id;
        $ceeSession = $request->ceesession;
        $lastId = Reservation::max('id') ?? 0; // Get max ID, default to 0 if none exist
        $formattedDate = Carbon::now()->format('Ymd'); // Use current date
        $appno = 'CEE-' . $formattedDate . $userId . $ceeSession . ($lastId + 1);

        // Save reservation
        $application = new Reservation();
        $application->cee_session_id = trim($ceeSession);
        $application->user_id = trim($userId);
        $application->app_no = trim($appno);
        $application->campus_id = trim($request->campus);
        $application->campus_id_prio_prog_2 = trim($request->campus2 ?? '');
        $application->campus_id_prio_prog_3 = trim($request->campus3 ?? '');
        $application->firstpriorty = trim($request->firstprioprog);
        $application->firstpriorty_desc = trim($request->firstprioprog_desc ?? '');
        $application->secondpriorty = trim($request->secondprioprog);
        $application->secondpriority_desc = trim($request->secondprioprog_desc ?? '');
        $application->thirdpriorty = trim($request->thirdprioprog);
        $application->thirdpriorty_desc = trim($request->thirdprioprog_desc ?? '');

        $application->firstprogram_policy_id = trim($request->firstprogram_policy_id ?? '');
        $application->secondprogram_policy_id = trim($request->secondprogram_policy_id ?? '');
        $application->thirdprogram_policy_id = trim($request->thirdprogram_policy_id ?? '');

        // $application->exam_session = trim($request->ceeexamsession);
        $application->exam_session = trim($exam_batch);
        $application->room_id = $room->id; // Assign found room
        $application->is_repeat_exam = trim($request->is_repeat_exam ?? 0);
        $application->status = 'pending';
        $application->save();

        // Reduce room capacity
        $room->decrement('capacity');

        // return redirect()->back()->with([
        //     'message' => 'Congratulations! Your USMCEE Slot reservation was successful. Assigned Room: ' . $room->room_name,
        //     'status' => 'success'
        // ]);
        return redirect()->route('student.reserve.index')->with([
            'message' => 'Congratulations! Your USMCEE Slot reservation was successful. Assigned Room: ' . $room->room_name,
            'status' => 'success'
        ]);

    }

}
