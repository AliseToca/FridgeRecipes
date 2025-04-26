<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedRecipe;

class SavedRecipeController extends Controller
{
    public function toggle(Request $request)
    {
        $user = auth()->user();
        $recipeId = $request->input('recipe_id');

        // Check if already saved
        $saved = SavedRecipe::where('user_id', $user->id)
            ->where('recipes_id', $recipeId)
            ->exists(); // <- only check if exists, not fetch full model

        if ($saved) {
            // If exists, delete (unsave) manually
            SavedRecipe::where('user_id', $user->id)
                ->where('recipes_id', $recipeId)
                ->delete();

            return response()->json(['status' => 'unsaved']);
        } else {
            // If not, create (save)
            SavedRecipe::create([
                'user_id' => $user->id,
                'recipes_id' => $recipeId,
            ]);

            return response()->json(['status' => 'saved']);
        }
    }
}
