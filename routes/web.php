<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerawatController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * Gateway to determine redirect path after login based on User Role.
 */
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('Nurse')) {
        return redirect()->route('perawat.dashboard');
    } elseif (auth()->user()->hasRole('Supervisor')) {
        return redirect()->route('supervisor.dashboard');
    }
    return abort(403);
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Routes for Nurse Role.
 * Includes Dashboard, Patient Registration, and Data Storage.
 */
Route::middleware(['auth'])->group(function () {
    // Main Dashboard for Nurse
    Route::get('/perawat/dashboard', [PerawatController::class, 'index'])->name('perawat.dashboard');
    
    // Feature: Add New Patient (Research Subject)
    Route::get('/perawat/patient/add', [PerawatController::class, 'create'])->name('perawat.patient.add');
    
    // Action: Store Patient Data to Database
    Route::post('/perawat/patient/store', [PerawatController::class, 'store'])->name('perawat.patient.store');
});

/**
 * Routes for Supervisor Role.
 * Includes Monitoring and Reviewing Nurse Activities.
 */
Route::middleware(['auth'])->group(function () {
    // Main Dashboard for Supervisor
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'index'])->name('supervisor.dashboard');
});

/**
 * Default Profile Routes from Laravel Breeze.
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';