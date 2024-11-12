<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\StudentCeeReserveController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationDetailsController;
use App\Http\Middleware\DetectWebView;


// Route::get('/', function () {
//     return view('auth.login');
// })->middleware('guest'); // Apply 'guest' middleware here

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest', DetectWebView::class]);

// Route::get('/', function () {
//     // return view('info');
//     return view('auth.login');
// });

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user) {
        // Check the user's role and redirect accordingly
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'utdc' => redirect()->route('utdc.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            default => redirect()->route('dashboard.default'),
        };
    }
    return redirect()->route('login');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// API-like Route Group
Route::prefix('api')
    ->middleware(['csrf.except.api'])
    ->group(function () {
        Route::get('programs', [StudentCeeReserveController::class, 'getProgramsByTenant']);
    });


Route::get('reservation/{id}/{app_no}', [ReservationController::class, 'getReservationByIdAndAppNo']);
// In routes/web.php
Route::post('reservation-details', [ReservationDetailsController::class, 'store']);


Route::get('/webview-instruction', function () {
    return view('webview.instruction');
})->name('webview.instruction');

require __DIR__ . '/auth.php';


