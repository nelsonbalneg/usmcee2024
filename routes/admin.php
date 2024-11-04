<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AdminController;


Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//route for users
Route::get('user/get-all-data',[UserController::class, 'getallUsers'] )->name('user.get-all-users');
Route::resource('user', UserController::class);
