<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Recipe;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'recipes_id' => 'required|exists:recipes,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Comment::create([
            'content' => $validated['content'],
            'recipes_id' => $validated['recipes_id'],
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
        ]);
    
        // Redirect back to the recipe page by slug
        $recipe = Recipe::findOrFail($request->recipes_id);
        return redirect()->route('recipes.show', $recipe->slug);
    }
}
