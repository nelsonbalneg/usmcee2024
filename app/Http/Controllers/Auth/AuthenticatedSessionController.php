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
        // Validate reCAPTCHA response
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');

        dd(env('RECAPTCHA_SITE_KEY'));

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
        ]);

        $body = $response->json();

        if (!$body['success']) {
            return back()->withErrors(['captcha' => 'Please complete the CAPTCHA']);
        }

        // Authenticate the user
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect based on user role
        if ($request->user()->role == 'admin') {
            return redirect()->intended('admin/dashboard');
        } else if ($request->user()->role == 'utdc') {
            return redirect()->intended('utdc/dashboard');
        } else if ($request->user()->role == 'student') {
            return redirect()->intended('student/dashboard');
        }

        return redirect()->intended(route('dashboard', absolute: false));
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
