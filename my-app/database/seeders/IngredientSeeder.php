<?php

namespace Database\Seeders;


use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            ['name' => 'lettuce', 'ingredient_category_id' => 1],         // Vegetables
            ['name' => 'tomato', 'ingredient_category_id' => 1],
            ['name' => 'cucumber', 'ingredient_category_id' => 1],
            ['name' => 'avocado', 'ingredient_category_id' => 2],         // Fruits
            ['name' => 'walnuts', 'ingredient_category_id' => 5],         // Nuts & Seeds
            ['name' => 'feta', 'ingredient_category_id' => 3],            // Dairy

            ['name' => 'chicken', 'ingredient_category_id' => 4],         // Meat
            ['name' => 'butter', 'ingredient_category_id' => 3],          // Dairy
            ['name' => 'tomato puree', 'ingredient_category_id' => 6],    // Spices & Sauces
            ['name' => 'cream', 'ingredient_category_id' => 3],           // Dairy

            ['name' => 'secret Ingredient 1', 'ingredient_category_id' => 7], // Other
            ['name' => 'secret Ingredient 2', 'ingredient_category_id' => 7],
            ['name' => 'love', 'ingredient_category_id' => 7],
            ['name' => 'time', 'ingredient_category_id' => 7],
            ['name' => 'skill', 'ingredient_category_id' => 7],
            ['name' => 'magic', 'ingredient_category_id' => 7],
            ['name' => 'flavor', 'ingredient_category_id' => 7],
            ['name' => 'joy', 'ingredient_category_id' => 7],
            ['name' => 'mystery', 'ingredient_category_id' => 7],
        ];

        Ingredient::insert($ingredients);
    }
}