<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\VaccineController;
use App\Http\Controllers\Web\VaccineRegistrationController;
use App\Http\Controllers\Web\Admin\VaccineController as AdminVaccineController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [VaccineRegistrationController::class, 'index'])->name('register');
Route::post('/register', [VaccineRegistrationController::class, 'store']);
Route::get('/vaccine/check-status', [HomeController::class, 'index'])->name('vaccine.check-status');
Route::post('/vaccine/check-status', [VaccineController::class, 'checkStatus']);

Route::get('/vaccine/list', [AdminVaccineController::class, 'index'])->name('vaccine.list');

