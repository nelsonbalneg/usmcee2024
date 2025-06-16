<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ResultController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Student\CeeSlipController;
use App\Http\Controllers\Student\ProgramController;
use App\Http\Controllers\Student\StudentCORController;
use App\Http\Controllers\Student\StudentPreregController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentCeeReserveController;
use App\Http\Controllers\Student\StudentRequirementsController;
use App\Http\Controllers\Student\ChedApplicantProfileController;
use App\Http\Controllers\Student\StudentApplicantProfileController;
use App\Http\Controllers\Student\StudentProgramConfirmationController;

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
    Route::get('cee/result-slip/{app_no}', [ResultController::class, 'generateceeResultSlip'])->name('cee.result-slip');
    Route::get('cee/result-message/{app_no}', [ResultController::class, 'viewResultMessageIndex'])->name('cee.result-message');
    Route::get('cee/result', [ResultController::class, 'index'])->name('cee.result');

    //route for checking duplicate records
    Route::get('count-active-slots', [StudentCeeReserveController::class, 'countActiveSlots'])->name('count-active-slots');
    Route::get('/check-duplicate-records', [StudentCeeReserveController::class, 'checkForDuplicateRecords'])->name('check.duplicate.records');

    //route for programs
    // Route::get('/programs/index', [ProgramController::class, 'index'])->name('programs.index');

    //routes for Preregitration
    Route::get('/pre-registration/dasboard', [StudentPreregController::class, 'index'])->name('prereg.index');

    //route for Student Profile
    Route::post('pre-registration/student-profile/nstp-preference', [StudentApplicantProfileController::class, 'saveNSTPPreference'])->name('applicant-profile.nstp-pref.save');
    Route::post('pre-registration/student-profile/publish', [StudentApplicantProfileController::class, 'publish'])->name('student-profile.publish');
    Route::get('pre-registration/student-profile/step1', [StudentApplicantProfileController::class, 'showStep1'])->name('applicant-profile.step1.show');
    Route::post('pre-registration/student-profile/step1', [StudentApplicantProfileController::class, 'postStep1'])->name('applicant-profile.step1.save');
    Route::get('pre-registration/student-profile/step2', [StudentApplicantProfileController::class, 'showStep2'])->name('applicant-profile.step2.show');
    Route::post('pre-registration/student-profile/step2', [StudentApplicantProfileController::class, 'postStep2'])->name('applicant-profile.step2.save');
    Route::get('pre-registration/student-profile/step3', [StudentApplicantProfileController::class, 'showStep3'])->name('applicant-profile.step3.show');
    Route::post('pre-registration/student-profile/step3', [StudentApplicantProfileController::class, 'postStep3'])->name('applicant-profile.step3.save');
    Route::get('pre-registration/student-profile/step4', [StudentApplicantProfileController::class, 'showStep4'])->name('applicant-profile.step4.show');
    Route::post('pre-registration/student-profile/step4', [StudentApplicantProfileController::class, 'postStep4'])->name('applicant-profile.step4.save');
    Route::get('pre-registration/student-profile/step5', [StudentApplicantProfileController::class, 'showStep5'])->name('applicant-profile.step5.show');
    Route::post('pre-registration/student-profile/step5', [StudentApplicantProfileController::class, 'postStep5'])->name('applicant-profile.step5.save');
    Route::resource('pre-registration/applicant-profile', StudentApplicantProfileController::class);

    //route for uploading of requirements
    //delete requirement route

    //batch2 uplpading or requirements
    Route::post('pre-registration/additional-applicant-requirements-2/hepab', [StudentRequirementsController::class, 'storeHepabBatch2'])->name('additional-applicant-requirements-2.hepab.store');
    Route::post('pre-registration/additional-applicant-requirements-2/chest-xray', [StudentRequirementsController::class, 'storeChestXrayBatch2'])->name('additional-applicant-requirements-2.chest-xray.store');
    Route::post('pre-registration/additional-applicant-requirements-2/pregnancy-test', [StudentRequirementsController::class, 'storePrenancyTestBatch2'])->name('additional-applicant-requirements-2.pregnancy-test.store');


    Route::delete('/pre-registration/applicant-requirements/delete/{requirement}/{type}', [StudentRequirementsController::class, 'deleteRequirements'])->name('applicant-requirements.delete');

    //unpost requirements
    Route::put('pre-registration/additional-applicant-requirements/unpost', [StudentRequirementsController::class, 'unpostRequirements'])->name('requirements.unpost');
    Route::put('pre-registration/additional-applicant-requirements/publish', [StudentRequirementsController::class, 'publishAdditionalRequirements'])->name('additional-requirements.publish');
    Route::post('pre-registration/additional-applicant-requirements/pregnancy-test', [StudentRequirementsController::class, 'storePrenancyTest'])->name('additional-applicant-requirements.pregnancy-test.store');
    Route::post('pre-registration/additional-applicant-requirements/chest-xray', [StudentRequirementsController::class, 'storeChestXray'])->name('additional-applicant-requirements.chest-xray.store');
    Route::post('pre-registration/additional-applicant-requirements/hepab', [StudentRequirementsController::class, 'storeHepab'])->name('additional-applicant-requirements.hepab.store');
    Route::get('pre-registration/additional-applicant-requirements', [StudentRequirementsController::class, 'additionalRequiremtIndex'])->name('add-requirements.index');
    Route::put('pre-registration/applicant-requirements/publish', [StudentRequirementsController::class, 'publishRequirements'])->name('requirements.publish');
    Route::post('pre-registration/applicant-requirements/gmc', [StudentRequirementsController::class, 'storeGmc'])->name('requirements.gmc.store');
    Route::post('pre-registration/applicant-requirements/certification', [StudentRequirementsController::class, 'storecertification'])->name('requirements.certification.store');
    Route::post('pre-registration/applicant-requirements/honorable-dismissal', [StudentRequirementsController::class, 'storeDismissal'])->name('requirements.honorable-dismissal.store');
    Route::post('pre-registration/applicant-requirements/tor', [StudentRequirementsController::class, 'storeTOR'])->name('requirements.tor.store');
    Route::post('pre-registration/applicant-requirements/card', [StudentRequirementsController::class, 'storeCard'])->name('requirements.card.store');
    Route::resource('pre-registration/applicant-requirements', StudentRequirementsController::class);


    //route for Program confirmations
    //route for ranking second batch
    Route::get('pre-registration/ranking/program-confirmation', [StudentProgramConfirmationController::class, 'programBatch2index'])->name('confirm-program-ranking.second-batch.index');
    Route::post('pre-registration/confirm-program-ranking', [StudentProgramConfirmationController::class, 'storeConfirmProgramBatch2'])->name('confirm-program-ranking.second-batch');
    Route::post('pre-registration/ranking', [StudentProgramConfirmationController::class, 'storeSelectProgramBatch2'])->name('ranking.second-batch');
    Route::post('pre-registration/program-confirmation', [StudentProgramConfirmationController::class, 'confirmProgram'])->name('program-confirmation.comfirm');
    Route::get('pre-registration/program-confirmation', [StudentProgramConfirmationController::class, 'index'])->name('program-confirmation.index');

    //route for USMCEE applicant Profile
    Route::post('cee/ched-applicant-profile/publish', [ChedApplicantProfileController::class, 'publish'])->name('cee.ched-applicant-profile.publish');
    Route::resource('cee/ched-applicant-profile', ChedApplicantProfileController::class);

    //route for downloading the COR
    Route::get('pre-registration/applicant/reports/cor/view', [StudentCORController::class, 'showReportView'])->name('prereg.cor-pdf.view');
    Route::get('pre-registration/applicant/cor', [StudentCORController::class, 'downloadCOR'])->name('download.cor');

     Route::get('pre-registration/applicant/view-report', [StudentCORController::class, 'showReportView'])->name('view-report');

    Route::get('/download-pdf/{filename}', function ($filename) {
        $filePath = storage_path('app/public/reports/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    })->name('download-pdf');

    //  Route::get('dtr/generate-report', [StudentCORController::class, 'generateDtrReport'])->name('generate-dtr.report');


});
