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
            'comments.user',
            'categories' // 👈 Add this line
        ])->where('slug', $slug)->first();

        if (!$recipe) {
            abort(404);
        }

        return Inertia::render('RecipeView', [
            'recipe' => $recipe,
            'auth' => [
                'user' => auth()->user(),
            ],
        ]);
        
    }
}
