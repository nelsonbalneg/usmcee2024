<?php

namespace App\Http\Controllers\Student;

use Auth;
use File;
use App\Models\User;
use Illuminate\Http\Request;
use App\Trait\ImageUploadTrait;
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
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:12', 'unique:users,phone,' . $id],
                'email' => ['required', 'email', 'unique:users,email,' . $id],
                'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:5120'],
                'lrn' => ['required', 'string', 'size:12']

            ],
            [
                'phone.unique' => 'The phone number is already in use. Please use a different number.',
                'email.unique' => 'The email address is already taken. Please use a different email.',
                'lrn.size' => 'The LRN must be exactly 12 characters.',
            ]
        );

        $user = User::findOrFail($id);

        $user->lrn = trim($request->lrn);
        $user->track = trim($request->track);
        $user->firstname = trim($request->firstname);
        $user->lastname = trim($request->lastname);
        $user->middlename = trim($request->middlename);
        $user->suffix = trim($request->suffix);
        $user->birthdate = trim($request->birthdate);
        $user->sex = trim($request->sex);
        $user->phone = trim($request->phone);
        $user->email = trim($request->email);
        $user->schoolid = trim($request->schoolid);
        $user->shs_school = trim($request->shs_school);
        $user->school_address = trim($request->school_address);
        $user->region = trim($request->region_text);
        $user->province = trim($request->province_text);
        $user->city = trim($request->city_text);
        $user->brgy = trim($request->barangay_text);
        $user->street = trim($request->street);
        $user->zipcode = trim($request->zipcode);

        // Handle photo upload
        $imagePath = $this->updateImage($request, 'photo', 'uploads', $user->photo);
        $user->photo = empty(!$imagePath) ? $imagePath : $user->photo;

        $user->save();

        return redirect()->back()->with('message', 'Your Profile Details have been updated! You can now reserve a slot for USM CEE');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
