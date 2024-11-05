<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentCeeReserveController;

Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

Route::put('/test-update/{id}', [StudentProfileController::class, 'update']);
Route::resource('profile', StudentProfileController::class);

//route for reservation
Route::get('cee/get-programs-by-campus', [StudentCeeReserveController::class, 'getProgramByRealCampusId'])->name('get-programs.campus');
Route::post('cee/reserve/submit', [StudentCeeReserveController::class,'store'])->name('reserve.store');
Route::get('cee/rooms-by-session', [StudentCeeReserveController::class, 'getRoomsByExamSession'])->name('rooms.by-exam-session');
Route::get('cee/campus-list', [StudentCeeReserveController::class, 'getCampusList'])->name('campus.get-list');
Route::get('cee/reserve', [StudentCeeReserveController::class,'index'])->name('reserve.index');
