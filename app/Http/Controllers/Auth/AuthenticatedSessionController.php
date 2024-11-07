<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Pail\ValueObjects\Origin\Http;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();
        // if ($request->user()->role == 'admin') {
        //     return redirect()->intended('admin/dashboard');
        // } else if ($request->user()->role == 'utdc') {
        //     return redirect()->intended('utdc/dashboard');
        // }
        //  else if ($request->user()->role == 'student') {
        //      return redirect()->intended('student/dashboard');
        //  }
        // return redirect()->intended(route('dashboard', absolute: false));
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Check if the "remember me" option was checked

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if ($request->user()->role == 'admin') {
                return redirect()->intended('admin/dashboard');
            } else if ($request->user()->role == 'utdc') {
                return redirect()->intended('utdc/dashboard');
            } else if ($request->user()->role == 'student') {
                return redirect()->intended('student/dashboard');
            }
            return redirect()->intended(route('dashboard', absolute: false));
        }

        return redirect()->back()->withErrors(['email' => 'Login failed. Please check your credentials.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
