<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Http\Controllers\HomeController;




// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//Recipe
Route::get('/recipes/{slug}', function ($slug) {
    $recipe = Recipe::where('slug', $slug)->firstOrFail();

    return Inertia::render('Recipe', [
        'recipe' => $recipe
    ]);
})->name('recipes.show');

// Other 
Route::get('/fridge', function () {
    return Inertia::render('Fridge');
})->name('fridge');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');


// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
