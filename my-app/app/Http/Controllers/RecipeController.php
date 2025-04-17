<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function show($slug)
    {
        $recipe = Recipe::with([
            'ingredients' => fn($q) => $q->withPivot('amount', 'unit'),
            'user',
        ])->where('slug', $slug)->firstOrFail();
    
        return Inertia::render('Recipe', [
            'recipe' => $recipe,
        ]);
    }
}
