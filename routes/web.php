<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerawatController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\EducationController;
use Illuminate\Support\Facades\Route;

// Langsung memantulkan pengguna ke gerbang Login
Route::get('/', function () {
    return redirect()->route('login');
});

/**
 * Gateway to determine redirect path after login based on User Role.
 * This ensures Nurses and Supervisors land on their respective professional dashboards.
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
 * Handles patient registration and the Digital Lifestyle Card instrument.
 */
Route::middleware(['auth'])->group(function () {
    // Main Dashboard for Nurses
    Route::get('/perawat/dashboard', [PerawatController::class, 'index'])->name('perawat.dashboard');
    
    // Feature: Research Subject (Patient) Management
    Route::get('/perawat/patient/add', [PerawatController::class, 'create'])->name('perawat.patient.add');
    Route::post('/perawat/patient/store', [PerawatController::class, 'store'])->name('perawat.patient.store');

    // Feature: Digital Lifestyle Card Data Entry
    Route::get('/perawat/education/{patient_id}', [EducationController::class, 'create'])->name('perawat.education.create');
    Route::post('/perawat/education/store', [EducationController::class, 'store'])->name('perawat.education.store');
});

/**
 * Routes for Supervisor Role.
 * Focuses on clinical oversight and nurse performance evaluation.
 */
Route::middleware(['auth'])->group(function () {
    // Main Dashboard for Supervisors
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'index'])->name('supervisor.dashboard');

    // Feature: Clinical Review & Supervision Evaluation
    Route::get('/supervisor/review/{education_id}', [SupervisorController::class, 'review'])->name('supervisor.review');
    Route::post('/supervisor/review/store', [SupervisorController::class, 'storeReview'])->name('supervisor.review.store');
    
    // Feature: Supervision History Log
    Route::get('/supervisor/history', [SupervisorController::class, 'history'])->name('supervisor.history');

    // Feature: Update Status RTL
    Route::patch('/supervisor/rtl/{id}/update', [SupervisorController::class, 'updateRtl'])->name('supervisor.rtl.update');
    
    // Feature: Export Data Riset ke Excel/CSV
    Route::get('/supervisor/export', [SupervisorController::class, 'exportData'])->name('supervisor.export');
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