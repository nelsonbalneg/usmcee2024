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
                'phone' => ['required', 'string', 'max:12', 'unique:users,phone,' . Auth::id()],
                'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
                'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:5120']

            ],
            [
                'phone.unique' => 'The phone number is already in use. Please use a different number.',
                'email.unique' => 'The email address is already taken. Please use a different email.',
            ]
        );

        $user = User::findOrFail($id);

        $imagePath = $this->updateImage($request,'photo','uploads', $user->photo);

        // // Handle the photo upload if a file was submitted
        // if ($request->hasFile('photo')) {
        //     // Delete old photo if it exists
        //     if ($user->photo && Storage::exists('public/' . $user->photo)) {
        //         Storage::delete('public/' . $user->photo);
        //     }

        //     // Store new photo and save path without 'public/' prefix
        //     $photo = $request->file('photo');
        //     $photoName = uniqid() . '_' . $photo->getClientOriginalName();
        //     $path = $photo->storeAs('public/uploads', $photoName);
        //     $user->photo = 'uploads/' . $photoName;
        // }
        // else
        // {

        // }


        //user variable
        $user->lrn = $request->lrn;
        $user->photo = empty(!$imagePath) ?  $imagePath : $user->photo;
        $user->track = $request->track;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->middlename = $request->middlename;
        $user->suffix = $request->suffix;
        $user->birthdate = $request->birthdate;
        $user->sex = $request->sex;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->schoolid = $request->schoolid;
        $user->shs_school = $request->shs_school;
        $user->school_address = $request->school_address;
        $user->region = $request->region_text;
        $user->province = $request->province_text;
        $user->city = $request->city_text;
        $user->brgy = $request->barangay_text;
        $user->street = $request->street;
        $user->zipcode = $request->zipcode;

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
