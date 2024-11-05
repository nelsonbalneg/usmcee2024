<?php

namespace App\Http\Controllers\Backend;

use App\Models\CeeSession;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function dashboard()
    {
        $checkEmptyFields = User::where(function ($query) {
            $query->whereNull('lrn')
                ->orWhere('lrn', '');
        })
            ->where('id', Auth::user()->id)
            ->where(function ($query) {
                $query->whereNull('birthdate')
                    ->orWhere('birthdate', '');
            })
            ->exists();

        if ($checkEmptyFields) {

            $studentdetails = User::where('id', Auth::user()->id)->first();
            $ceeActiveession = CeeSession::where('status', 'active')->first();

           return view("student.profile.profile", compact('studentdetails'))->with('alert', 'Please take time to complete your profile to be able to reserve a slot in USM-CEE 2025');
        } else {
            return view('student.dashboard');
        }
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
