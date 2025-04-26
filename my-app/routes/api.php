<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FridgeController;
use App\Http\Controllers\SavedRecipeController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/fridges/ingredient', [FridgeController::class, 'addIngredientToFridge']);
Route::delete('/fridges/{fridgeId}/ingredient/{ingredientId}', [FridgeController::class, 'remove']);

Route::get('/fridges/{fridgeId}/ingredients', [FridgeController::class, 'getIngredients']);
// Route::post('/saved-recipes/toggle', [SavedRecipeController::class, 'toggle']);
