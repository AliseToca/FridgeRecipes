<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\SavedRecipe;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user()?->load('fridge.ingredients');
    
        // Get all saved recipe IDs for this user
        $savedRecipeIds = $user
            ? SavedRecipe::where('user_id', $user->id)->pluck('recipes_id')->toArray()
            : [];
    
        // Load recipes
        $recipes = Recipe::with('ingredients')
            ->get()
            ->map(function ($recipe) use ($savedRecipeIds) {
                // Add 'saved' attribute (true or false)
                $recipe->saved = in_array($recipe->id, $savedRecipeIds);
                return $recipe;
            });
    
        return Inertia::render('HomeView', [
            'recipes' => $recipes,
        ]);
    }
    
}
