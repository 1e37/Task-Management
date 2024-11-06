<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// });


// Default route
Route::get('/', function () {
    // index.blade.php
    return view('index');
});

// Apply Middleware to filter HTTP Requsts that enter the application

// Dashboard routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Update the dashboard view path to match our structure
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Project routes

Route::middleware(['auth', 'verified'])->group(function () {
// Route to show the project creation form
Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create');

// Route to store the project and task
Route::post('/projects', [ProjectsController::class, 'store'])->name('projects.store');});

})
;

// Add a Group of Middleware to check with
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
