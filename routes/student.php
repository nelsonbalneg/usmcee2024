<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ResultController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Student\CeeSlipController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentCeeReserveController;

Route::middleware(['check.maintenance'])->group(function () {
    Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

    Route::put('/test-update/{id}', [StudentProfileController::class, 'update']);
    Route::put('cee/update-photo/{id}', [StudentProfileController::class, 'uploadPhoto'])->name('cee.update-photo');
    Route::resource('profile', StudentProfileController::class);

    //route for reservation
    Route::get('cee/get-programs-by-campus', [StudentCeeReserveController::class, 'getProgramByRealCampusId'])->name('get-programs.campus');
    Route::post('cee/reserve/submit', [StudentCeeReserveController::class, 'store'])->name('reserve.store');
    Route::get('cee/rooms-by-session', [StudentCeeReserveController::class, 'getRoomsByExamSession'])->name('rooms.by-exam-session');
    Route::get('cee/campus-list', [StudentCeeReserveController::class, 'getCampusList'])->name('campus.get-list');
    Route::get('cee/reserve', [StudentCeeReserveController::class, 'index'])->name('reserve.index');

    Route::get('cee/schoolname', [StudentProfileController::class, 'school_name'])->name('school_list.index');

    Route::get('cee/checklrn', [StudentProfileController::class, 'getLrn'])->name('detectlrn.index');

    // Route::post('cee/upload-image', [StudentProfileController::class, 'upload']);
    Route::post('cee/upload-image', [StudentProfileController::class, 'upload'])->name('upload_image');

    Route::get('cee/upload-image-form', function () {
        return view('student.profile.upload'); // Accesses the upload.blade.php inside views/student/profile
    });

    //route for report
    Route::get('/cee/exam-slip', [CeeSlipController::class, 'generateceeExamSlip'])->name('cee.exam-slip');

    //route for CEE result
    Route::get('cee/result', [ResultController::class, 'index'])->name('cee.result');

    //route for checking duplicate records
    Route::get('/check-duplicate-records', [StudentCeeReserveController::class, 'checkForDuplicateRecords'])->name('check.duplicate.records');
});
