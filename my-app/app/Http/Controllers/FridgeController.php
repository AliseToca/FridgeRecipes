<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Fridge;
use Illuminate\Http\Request;

class FridgeController extends Controller
{
    public function addIngredientToFridge(Request $request)
    {
        $request->validate([
            'ingredients_name' => 'required|string|max:255',
            'fridges_id' => 'required|exists:fridges,id',
        ]);

        // Normalize input (e.g., remove extra spaces, lowercase)
        $ingredientsName = trim(strtolower($request->ingredients_name));

        // 1. Find or create the ingredient
        $ingredient = Ingredient::firstOrCreate(
            ['name' => $ingredientsName],
            ['ingredient_category_id' => 1] // use default category or adjust as needed
        );

        // 2. Get fridge
        $fridges = Fridge::find($request->fridges_id);

        // 3. Attach to pivot table if not already attached
        if (!$fridges->ingredients()->where('ingredients_id', $ingredient->id)->exists()) {
            $fridges->ingredients()->attach($ingredient->id, [
                'amount' => 1, // default or customize
                'unit' => null,
            ]);
        }

        return response()->json([
            'message' => 'Ingredient added to fridge.',
            'ingredient' => $ingredient,
        ]);
    }
}