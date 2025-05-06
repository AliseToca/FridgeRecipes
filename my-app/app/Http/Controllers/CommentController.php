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

        $recipe = Recipe::findOrFail($validated['recipes_id']);
        $recipe->updateRating(); 

        return redirect()->route('recipes.show', $recipe->slug);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $recipeId = $comment->recipes_id; 
        $comment->delete();


        $recipe = Recipe::find($recipeId);
        $recipe->updateRating();

        return redirect()->back(303);
    }
}
