<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Recipe;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AllRecipesController;
use App\Http\Controllers\SavedRecipeController;
use App\Http\Controllers\FridgeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UsersController;


// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//AllRecipesView
Route::get('/recipes', [AllRecipesController::class, 'index'])->name('recipes');

// RecipeView
Route::get('/recipes/{slug}', [RecipeController::class, 'show'])->name('recipes.show');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Saved recipes
    Route::post('/saved-recipes/toggle', [SavedRecipeController::class, 'toggle']);

    // Fridge
    Route::get('/fridges/{fridgeId}/ingredients', [FridgeController::class, 'getIngredients'])->name('fridges.ingredients');
    Route::post('/fridges/ingredient', [FridgeController::class, 'addIngredient'])->name('fridges.addIngredient');
    Route::delete('/fridges/{fridgeId}/ingredient/{ingredientId}', [FridgeController::class, 'remove'])->name('fridges.removeIngredient');

    // Comments
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{user}', [UsersController::class, 'destroy']);


});

Route::get('/check-username', function (Request $request) {
    $taken = User::where('username', $request->username)
        ->where('id', '!=', auth()->id())
        ->exists();
    return response()->json(['taken' => $taken]);
})->middleware('auth');

require __DIR__.'/auth.php';
