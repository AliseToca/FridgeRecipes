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
                ['chicken', 500, 'grams'],
                ['butter', 100, 'grams'],
                ['tomato puree', 200, 'grams'],
                ['rice', 200, 'grams'],
                ['cream', 150, 'ml'],
            ],
            // New recipes ingredients
            'classic-spaghetti-bolognese' => [
                ['spaghetti', 200, 'grams'],
                ['ground beef', 300, 'grams'],
                ['onion', 1, 'whole'],
                ['garlic', 2, 'cloves'],
                ['tomato puree', 200, 'grams'],
                ['oregano', 1, 'tsp'],
                ['basil', 1, 'tsp'],
                ['parmesan cheese', 50, 'grams'],
            ],
            'creamy-mushroom-risotto' => [
                ['rice', 200, 'grams'],
                ['vegetable broth', 500, 'ml'],
                ['mushrooms', 200, 'grams'],
                ['onion', 1, 'whole'],
                ['garlic', 2, 'cloves'],
                ['parmesan cheese', 50, 'grams'],
                ['cream', 100, 'ml'],
            ],
            'vegetarian-stir-fry' => [
                ['broccoli', 200, 'grams'],
                ['bell pepper', 2, 'whole'],
                ['carrot', 1, 'whole'],
                ['garlic', 2, 'cloves'],
                ['soy sauce', 2, 'tbsp'],
                ['sesame oil', 1, 'tbsp'],
                ['honey', 1, 'tbsp'],
                ['ginger', 1, 'inch'],
            ],
            'baked-salmon-with-veggies' => [
                ['salmon', 2, 'fillets'],
                ['carrot', 2, 'whole'],
                ['zucchini', 2, 'whole'],
                ['bell pepper', 2, 'whole'],
                ['olive oil', 2, 'tbsp'],
                ['salt', 1, 'tsp'],
                ['black pepper', 1, 'tsp'],
            ],
            'avocado-toast-with-egg' => [
                ['bread', 2, 'slices'],
                ['avocado', 1, 'whole'],
                ['egg', 1, 'whole'],
                ['lemon', 1, 'slice'],
                ['salt', 1, 'pinch'],
                ['pepper', 1, 'pinch'],
            ],
            'spicy-chickpea-curry' => [
                ['chickpeas', 400, 'grams'],
                ['tomato puree', 200, 'grams'],
                ['coconut milk', 200, 'ml'],
                ['onion', 1, 'whole'],
                ['garlic', 2, 'cloves'],
                ['ginger', 1, 'inch'],
                ['cumin', 1, 'tsp'],
                ['paprika', 1, 'tsp'],
                ['turmeric', 1, 'tsp'],
            ],
            'grilled-chicken-caesar-salad' => [
                ['chicken', 1, 'whole'],
                ['lettuce', 2, 'heads'],
                ['croutons', 50, 'grams'],
                ['caesar dressing', 50, 'ml'],
                ['parmesan cheese', 50, 'grams'],
            ],
            'stuffed-bell-peppers' => [
                ['bell peppers', 4, 'whole'],
                ['ground beef', 200, 'grams'],
                ['rice', 100, 'grams'],
                ['tomato puree', 100, 'grams'],
                ['onion', 1, 'whole'],
                ['garlic', 2, 'cloves'],
                ['oregano', 1, 'tsp'],
            ],
            'peanut-butter-banana-smoothie' => [
                ['banana', 1, 'whole'],
                ['peanut butter', 2, 'tbsp'],
                ['milk', 250, 'ml'],
                ['ice', 1, 'cup'],
            ],
            'tomato-basil-soup' => [
                ['tomato', 6, 'whole'],
                ['vegetable broth', 500, 'ml'],
                ['onion', 1, 'whole'],
                ['garlic', 2, 'cloves'],
                ['basil', 1, 'tbsp'],
                ['salt', 1, 'tsp'],
            ],
            'creamy-mushrooms-with-potatoes' =>[
                ['potatoes', 300, 'grams'],
                ['mushrooms', 200, 'grams'],
                ['onion', 1, 'whole'],
                ['milk', 100, 'ml'],
                ['cheese spread', 100, 'grams'],
                ['salt', 1, 'tsp'],
                ['black pepper', 0.5, 'tsp'],
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
                        'unit' => $unit,
                    ]);
                }
            }
        }
    }
}
