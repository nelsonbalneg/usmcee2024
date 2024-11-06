<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'unique:' . User::class], // Ensure the phone is unique as well
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
        [
            'phone.unique' => 'The phone number is already in use. Please use a different number.',
            'email.unique' => 'The email address is already taken. Please use a different email.',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'sex' => $request->sex,
            'phone' => "{$request->code}{$request->phone}",
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

       // Auth::login($user);

       return redirect(route('register'))->with('success', 'Registration successful! Please log in.');

    }
}
