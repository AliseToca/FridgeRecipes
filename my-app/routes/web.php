<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

// Debug route to check authentication user
Route::get('/debug-auth', function () {
    return response()->json(Auth::user());
});

// Home route
Route::get('/', function () {
    return Inertia::render('HomeView', [
        'auth' => [
            'user' => Auth::user()
        ],
    ]);
})->name('home');

// Other routes
Route::get('/fridge', function () {
    return Inertia::render('Fridge');
})->name('fridge');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

// Profile routes with controller handling
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
