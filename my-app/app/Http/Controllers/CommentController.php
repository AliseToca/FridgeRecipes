<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Recipe;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'recipes_id' => 'required|exists:recipes,id',
        ]);
    
        Comment::create([
            'content' => $request->content,
            'recipes_id' => $request->recipes_id,
            'user_id' => auth()->id(),
        ]);
    
        // Redirect back to the recipe page by slug
        $recipe = Recipe::findOrFail($request->recipes_id);
        return redirect()->route('recipes.show', $recipe->slug);
    }
}
