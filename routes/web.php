<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\VaccineController;
use App\Http\Controllers\Web\VaccineRegistrationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [VaccineRegistrationController::class, 'index'])->name('register');
Route::post('/register', [VaccineRegistrationController::class, 'store']);
Route::get('/vaccine/check-status', [HomeController::class, 'index'])->name('vaccine.check-status');
Route::post('/vaccine/check-status', [VaccineController::class, 'checkStatus']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

