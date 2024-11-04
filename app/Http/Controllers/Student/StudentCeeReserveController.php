<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Models\Room;
use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class StudentCeeReserveController extends Controller
{
    public function index()
    {
        $response = Http::get('http://172.16.0.60/academic/api/v2/Campus/list');

        if ($response->successful()) {

            $campusList = collect($response->json())->filter(function ($campus) {
                return $campus['campusName'] !== 'USM-ULS';
            })->values()->all();
        } else {

            $campusList = [];
        }

        $ceeSession = CeeSession::where('status', 'active')->first();
        $application = Reservation::where('user_id',  Auth::user()->id)->exists();

        return view("student.reserve.reserve", compact('ceeSession', 'campusList','application'));
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

    public function getRoomsByExamSession(Request $request)
    {
        $session = $request->input('ceesession');

        // Retrieve rooms based on session
        $rooms = Room::where('exam_session', $session)->where('status', 'active')->get(['id', 'room_name', 'capacity', 'college_name']);

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

    public function store(Request $request)
    {
        $request->validate(
            [
                'ceesession' => 'required|integer',
                'campus' => 'required|string|max:100',
                'firstprioprog' => 'required|string|max:100',
                'firstpriomajor' => 'nullable|string|max:100',
                'secondprioprog' => 'nullable|string|max:100',
                'secondpriomajor' => 'nullable|string|max:100',
                'thirdprioprog' => 'nullable|string|max:100',
                'thirdpriomajor' => 'nullable|string|max:100',
                'ceeexamsession' => 'required|string|max:50',
                'room' => 'required|string|max:100',
            ]
        );

         $userId =  Auth::user()->id;
         $ceeSession = $request->ceesession;
         $lastRow = Reservation::find(Reservation::max('id'));
         $lastId = $lastRow ? $lastRow->id : 0; // If no rows, start with 0

         // Format the date
         $formattedDate = Carbon::parse($request->created_at)->format('Ymd');

         // Concatenate the formatted date with the last ID incremented by 1
         $appno = $formattedDate .$userId.$ceeSession.($lastId + 1);

        $application = new Reservation();
        $application->cee_session_id =  $ceeSession;
        $application->user_id = $userId;
        $application->app_no =  $appno;
        $application->campus_id = $request->campus;
        $application->firstpriorty = $request->firstprioprog;
        $application->firstpriortymajor = $request->firstpriomajor;
        $application->secondpriorty = $request->secondprioprog;
        $application->secondpriortymajor = $request->secondpriomajor;
        $application->thirdpriorty = $request->thirdprioprog;
        $application->thirdpriortymajor = $request->thirdpriomajor;
        $application->exam_session = $request->ceeexamsession;
        $application->room = $request->room;
        $application->save();

        //update room qty
        $room = Room::findOrFail($request->room)->first();
        $roomCap =  $room->capacity;
        $newRoomcap =  $roomCap -  $request->room;
        $room->capacity = $newRoomcap;
        $room->save();

        return redirect()->back()->with('message', 'Congratulations! USMCEE Slot reservation Successful.');

    }
}
