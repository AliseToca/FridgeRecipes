<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeIngredientSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'healthy-rich-salad' => [
                ['lettuce', 1, 'head'],
                ['tomato', 2, 'whole'],
                ['cucumber', 1, 'whole'],
                ['avocado', 1, 'whole'],
                ['walnuts', 50, 'grams'],
                ['feta', 100, 'grams'],
            ],
            'butter-chicken' => [
                ['Chicken', 500, 'grams'],
                ['Butter', 100, 'grams'],
                ['Tomato Puree', 200, 'grams'],
                ['Cream', 150, 'ml'],
            ],
            'kikas-special' => [
                ['Secret Ingredient 1', 1, 'tbsp'],
                ['Secret Ingredient 2', 1, 'tbsp'],
                ['Love', 1, 'pinch'],
                ['Time', 1, 'hour'],
                ['Skill', 1, 'unit'],
                ['Magic', 1, 'dust'],
                ['Flavor', 1, 'burst'],
                ['Joy', 1, 'smile'],
                ['Mystery', 1, 'spoonful'],
            ],
        ];

        foreach ($data as $slug => $ingredientData) {
            $recipe = Recipe::where('slug', $slug)->first();

            foreach ($ingredientData as $ingredientInfo) {
                [$name, $amount, $unit] = $ingredientInfo;
                $ingredient = Ingredient::where('name', $name)->first();

                if ($recipe && $ingredient) {
                    DB::table('recipe_ingredients')->insert([
                        'recipes_id' => $recipe->id,
                        'ingredients_id' => $ingredient->id,
                        'amount' => $amount,
                        'unit' => $unit, // If you want to store unit as well
                    ]);
                }
            }
        }
    }
}
