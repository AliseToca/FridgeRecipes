<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Recipe;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SavedRecipeController;
use App\Http\Controllers\FridgeController;
use App\Http\Controllers\CommentController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//Recipe
Route::get('/recipes/{slug}', function ($slug) {
    $recipe = \App\Models\Recipe::with([
        'ingredients' => fn($q) => $q->withPivot('amount'),
        'user',
        'comments.user' // 👈 this line loads the comments and their authors
    ])
    ->where('slug', $slug)
    ->firstOrFail();

    return Inertia::render('RecipeView', [
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
    // Route to view the profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    
    // Route to show the profile edit form (separate URL)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Route to update the profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Route to delete the profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//API MOVED HERE
Route::middleware(['auth'])->group(function () {
    Route::post('/saved-recipes/toggle', [SavedRecipeController::class, 'toggle']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/fridges/{fridgeId}/ingredients', [FridgeController::class, 'getIngredients'])->name('fridges.ingredients');
    Route::post('/fridges/ingredient', [FridgeController::class, 'addIngredient'])->name('fridges.addIngredient');
    Route::delete('/fridges/{fridgeId}/ingredient/{ingredientId}', [FridgeController::class, 'remove'])->name('fridges.removeIngredient');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

require __DIR__.'/auth.php';
