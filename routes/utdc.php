<?php

use App\Http\Controllers\Backend\UtdcController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [UtdcController::class, 'dashboard'])->name('dashboard');
