<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Fridge;
use App\Models\Category;
use Illuminate\Http\Request;

class FridgeController extends Controller
{
    public function getIngredients($fridgeId)
    {
        $fridge = Fridge::with(['ingredients.ingredientCategory'])->findOrFail($fridgeId);
    
        $allCategories = Category::orderBy('id')->get();
    
        return response()->json([
            'ingredients' => $fridge->ingredients->map(function ($ingredient) {
                return [
                    'id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'amount' => $ingredient->pivot->amount ?? null,
                    'category' => $ingredient->ingredientCategory ? [
                        'id' => $ingredient->ingredientCategory->id,
                        'name' => $ingredient->ingredientCategory->name,
                    ] : null,
                ];
            }),
            'categories' => $allCategories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }),
        ]);
    }
    

    public function addIngredientToFridge(Request $request)
    {
        $request->validate([
            'ingredients_name' => 'required|string|max:255',
            'fridges_id' => 'required|exists:fridges,id',
            'amount' => 'nullable|numeric|min:0',
        ]);

        // Normalize input (e.g., remove extra spaces, lowercase)
        $ingredientsName = trim(strtolower($request->ingredients_name));

        // 1. Find or create the ingredient
        $ingredient = Ingredient::firstOrCreate(
            ['name' => $ingredientsName],
            ['ingredient_category_id' => 1] // use default category
        );

        // 2. Get fridge
        $fridges = Fridge::find($request->fridges_id);

        $amount = $request->input('amount');

        // 3. Attach to pivot table if not already attached
        if (!$fridges->ingredients()->where('ingredients_id', $ingredient->id)->exists()) {
            $fridges->ingredients()->attach($ingredient->id, [
                'amount' => $amount, // default or customize
                'unit' => null,
            ]);
        }

        return response()->json([
            'message' => 'Ingredient added to fridge.',
            'ingredient' => $ingredient,
        ]);
    }

    public function remove($fridgeId, $ingredientId)
    {
        // Find the fridge and ingredient based on the IDs
        $fridge = Fridge::find($fridgeId);
        $ingredient = Ingredient::find($ingredientId);

        // Check if either the fridge or ingredient was not found
        if (!$fridge || !$ingredient) {
            return response()->json(['message' => 'Fridge or Ingredient not found'], 404);
        }

        // Check if the ingredient exists in the fridge's relationship
        if (!$fridge->ingredients()->where('ingredients_id', $ingredient->id)->exists()) {
            return response()->json(['message' => 'Ingredient not found in this fridge.'], 404);
        }

        // Detach the ingredient from the fridge
        $fridge->ingredients()->detach($ingredient->id);

        return response()->json(['message' => 'Ingredient removed successfully.']);
    }


}