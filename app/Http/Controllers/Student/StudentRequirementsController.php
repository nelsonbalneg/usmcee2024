<?php

namespace App\Http\Controllers\Student;

use App\Models\Requirements;
use Illuminate\Http\Request;
use App\Models\StundentProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        return view('student.requirements.requirements', compact('applicant'));
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
        $request->validate([
            'psa_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10048',
        ]);

        $filePaths = [];

        if ($request->hasFile('psa_files')) { // Use 'psa_files' instead of 'file'
            foreach ($request->file('psa_files') as $file) { // Same change here
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('psa', $filename);

                // Convert to required format (remove 'public/')
                $filePaths[] = 'document_path/' . $filename;
            }
        }

        //dd($request->all(), $request->file('psa_files'));

        // Save to DB
        Requirements::create([
            'psa' => json_encode($filePaths),
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Files uploaded successfully.');
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
