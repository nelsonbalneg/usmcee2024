<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Http;


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
        // // Validate reCAPTCHA response with a custom error message
        // $request->validate([
        //     'g-recaptcha-response' => 'required',
        // ], [
        //     'g-recaptcha-response.required' => 'reCAPTCHA field is required.',
        // ]);

        // // Retrieve the reCAPTCHA token from the request
        // $recaptchaResponse = $request->input('g-recaptcha-response');
        // $secretKey = env('RECAPTCHA_SECRET_KEY'); // Your reCAPTCHA secret key

        // // Prepare the data to verify reCAPTCHA
        // $data = [
        //     'secret' => $secretKey,
        //     'response' => $recaptchaResponse,
        //     'remoteip' => $request->ip(),
        // ];

        // // Create the context for the HTTP request using file_get_contents
        // $options = [
        //     'http' => [
        //         'method' => 'POST',
        //         'header' => 'Content-type: application/x-www-form-urlencoded',
        //         'content' => http_build_query($data),
        //     ],
        // ];
        // $context = stream_context_create($options);

        // // Send the request to the reCAPTCHA verification endpoint
        // $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);

        // // Decode the JSON response from Google reCAPTCHA
        // $responseBody = json_decode($response);

        // // Log the reCAPTCHA response for debugging purposes
        // Log::info('reCAPTCHA response from Google', (array) $responseBody);

        // // Check if reCAPTCHA verification was successful
        // if (!$responseBody->success) {
        //     return redirect()->back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.']);
        // }

        // // Proceed with the usual login logic
        // $credentials = $request->only('email', 'password');
        // $remember = $request->has('remember');

        // if (Auth::attempt($credentials, $remember)) {
        //     $request->session()->regenerate();
        //     $role = $request->user()->role;

        //     // Redirect based on user role
        //     return match ($role) {
        //         'admin' => redirect()->intended('admin/dashboard'),
        //         'utdc' => redirect()->intended('utdc/dashboard'),
        //         'student' => redirect()->intended('student/dashboard'),
        //         default => redirect()->intended(route('student/dashboard', absolute: false)),
        //     };
        // }

        // // If login fails, redirect back with an error message
        // return redirect()->back()->withErrors(['email' => 'Login failed. Please check your credentials.']);

        // Validate reCAPTCHA response with a custom error message
        // $request->validate([
        //     'g-recaptcha-response' => 'required',
        // ], [
        //     'g-recaptcha-response.required' => 'reCAPTCHA field is required.',
        // ]);

        // // Retrieve the reCAPTCHA token from the request
        // $recaptchaResponse = $request->input('g-recaptcha-response');
        // $secretKey = env('RECAPTCHA_SECRET_KEY'); // Your reCAPTCHA secret key

        // // Prepare the data to verify reCAPTCHA
        // $data = [
        //     'secret' => $secretKey,
        //     'response' => $recaptchaResponse,
        //     'remoteip' => $request->ip(),
        // ];

        // // Create the context for the HTTP request using file_get_contents
        // $options = [
        //     'http' => [
        //         'method' => 'POST',
        //         'header' => 'Content-type: application/x-www-form-urlencoded',
        //         'content' => http_build_query($data),
        //     ],
        // ];
        // $context = stream_context_create($options);

        // // Send the request to the reCAPTCHA verification endpoint
        // $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);

        // // Decode the JSON response from Google reCAPTCHA
        // $responseBody = json_decode($response);

        // // Log the reCAPTCHA response for debugging purposes
        // Log::info('reCAPTCHA response from Google', (array) $responseBody);

        // // Check if reCAPTCHA verification was successful
        // if (!$responseBody->success) {
        //     return redirect()->back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.']);
        // }

        // // Proceed with the usual login logic
        // $credentials = $request->only('email', 'password');
        // $remember = $request->has('remember');

        // if (Auth::attempt($credentials, $remember)) {
        //     $request->session()->regenerate();
        //     $role = $request->user()->role;

        //     // Redirect based on user role
        //     return match ($role) {
        //         'admin' => redirect()->intended('admin/dashboard'),
        //         'utdc' => redirect()->intended('utdc/dashboard'),
        //         'student' => redirect()->intended('student/dashboard'),
        //         default => redirect()->intended(route('student/dashboard', absolute: false)),
        //     };
        // }

        // // If login fails, redirect back with an error message
        // return redirect()->back()->withErrors(['email' => 'Login failed. Please check your credentials.']);


        // Validate that the Turnstile response is present
        $request->validate([
            'cf-turnstile-response' => 'required',
        ], [
            'cf-turnstile-response.required' => 'Turnstile verification is required.',
        ]);

        // Retrieve the Turnstile response from the request
        $turnstileResponse = $request->input('cf-turnstile-response');
        $secretKey = env('TURNSTILE_SECRET_KEY'); // Your Turnstile secret key

        // Send the Turnstile response for verification
        $verifyResponse = Http::asForm()->post("https://challenges.cloudflare.com/turnstile/v0/siteverify", [
            'secret' => $secretKey,
            'response' => $turnstileResponse,
            'remoteip' => $request->ip(),
        ]);

        $result = $verifyResponse->json();

        // Log the Turnstile response for debugging
        Log::info('Turnstile response from Cloudflare', (array) $result);

        // Check if Turnstile verification was successful
        if (!$result['success']) {
            return redirect()->back()->withErrors(['turnstile' => 'Turnstile verification failed. Please try again.']);
        }

        // Proceed with the usual login logic
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $role = $request->user()->role;

            // Redirect based on user role
            return match ($role) {
                'admin' => redirect()->intended('admin/dashboard'),
                'utdc' => redirect()->intended('utdc/dashboard'),
                'student' => redirect()->intended('student/dashboard'),
                default => redirect()->intended(route('student/dashboard', absolute: false)),
            };
        }

        // If login fails, redirect back with an error message
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
