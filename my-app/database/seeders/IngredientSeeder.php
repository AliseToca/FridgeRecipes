<?php

namespace Database\Seeders;


use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            // ['name' => 'lettuce', 'ingredient_category_id' => 2],         // Vegetables
            // ['name' => 'tomato', 'ingredient_category_id' => 2],
            // ['name' => 'cucumber', 'ingredient_category_id' => 2],
            // ['name' => 'avocado', 'ingredient_category_id' => 3],         // Fruits
            // ['name' => 'walnuts', 'ingredient_category_id' => 6],         // Nuts & Seeds
            // ['name' => 'feta', 'ingredient_category_id' => 4],            // Dairy

            // ['name' => 'chicken', 'ingredient_category_id' => 5],         // Meat
            // ['name' => 'butter', 'ingredient_category_id' => 4],          // Dairy
            // ['name' => 'tomato puree', 'ingredient_category_id' => 7],    // Spices & Sauces
            // ['name' => 'cream', 'ingredient_category_id' => 4],           // Dairy

            // Other
            ['name' => 'secret Ingredient 1', 'ingredient_category_id' => 1],
            ['name' => 'secret Ingredient 2', 'ingredient_category_id' => 1],
            ['name' => 'love', 'ingredient_category_id' => 1],
            ['name' => 'time', 'ingredient_category_id' => 1],
            ['name' => 'skill', 'ingredient_category_id' => 1],
            ['name' => 'magic', 'ingredient_category_id' => 1],
            ['name' => 'flavor', 'ingredient_category_id' => 1],
            ['name' => 'joy', 'ingredient_category_id' => 1],
            ['name' => 'mystery', 'ingredient_category_id' => 1],

            // Vegetables
            ['name' => 'lettuce', 'ingredient_category_id' => 2],
            ['name' => 'tomato', 'ingredient_category_id' => 2],
            ['name' => 'cucumber', 'ingredient_category_id' => 2],
            ['name' => 'avocado', 'ingredient_category_id' => 2],
            ['name' => 'carrot', 'ingredient_category_id' => 2],
            ['name' => 'spinach', 'ingredient_category_id' => 2],
            ['name' => 'mushrooms', 'ingredient_category_id' => 2],
            ['name' => 'onion', 'ingredient_category_id' => 2],
            ['name' => 'garlic', 'ingredient_category_id' => 2],
            ['name' => 'bell pepper', 'ingredient_category_id' => 2],
            ['name' => 'zucchini', 'ingredient_category_id' => 2],

            // Fruits
            ['name' => 'banana', 'ingredient_category_id' => 3],
            ['name' => 'apple', 'ingredient_category_id' => 3],
            ['name' => 'orange', 'ingredient_category_id' => 3],
            ['name' => 'blueberries', 'ingredient_category_id' => 3],
            ['name' => 'strawberry', 'ingredient_category_id' => 3],
            ['name' => 'pineapple', 'ingredient_category_id' => 3],
            ['name' => 'grapes', 'ingredient_category_id' => 3],
            ['name' => 'kiwi', 'ingredient_category_id' => 3],
            ['name' => 'mango', 'ingredient_category_id' => 3],

            // Dairy
            ['name' => 'cheddar cheese', 'ingredient_category_id' => 4],
            ['name' => 'cream', 'ingredient_category_id' => 4],
            ['name' => 'butter', 'ingredient_category_id' => 4],
            ['name' => 'feta cheese', 'ingredient_category_id' => 4],
            ['name' => 'milk', 'ingredient_category_id' => 4],
            ['name' => 'yogurt', 'ingredient_category_id' => 4],
            ['name' => 'mozzarella', 'ingredient_category_id' => 4],

            // Meat
            ['name' => 'chicken', 'ingredient_category_id' => 5],
            ['name' => 'beef', 'ingredient_category_id' => 5],
            ['name' => 'pork', 'ingredient_category_id' => 5],
            ['name' => 'bacon', 'ingredient_category_id' => 5],
            ['name' => 'salmon', 'ingredient_category_id' => 5],
            ['name' => 'turkey', 'ingredient_category_id' => 5],

            // Seafood
            ['name' => 'shrimp', 'ingredient_category_id' => 6],
            ['name' => 'tuna', 'ingredient_category_id' => 6],

            // Nuts
            ['name' => 'almonds', 'ingredient_category_id' => 7],
            ['name' => 'walnuts', 'ingredient_category_id' => 7],
            ['name' => 'peanut butter', 'ingredient_category_id' => 7],
            ['name' => 'cashews', 'ingredient_category_id' => 7],

            // Seeds
            ['name' => 'chia seeds', 'ingredient_category_id' => 8],
            ['name' => 'sunflower seeds', 'ingredient_category_id' => 8],
            ['name' => 'pumpkin seeds', 'ingredient_category_id' => 8],

            // Spices
            // ['name' => 'garlic', 'ingredient_category_id' => 9],
            ['name' => 'basil', 'ingredient_category_id' => 9],
            ['name' => 'cumin', 'ingredient_category_id' => 9],
            ['name' => 'oregano', 'ingredient_category_id' => 9],
            ['name' => 'black pepper', 'ingredient_category_id' => 9],
            ['name' => 'paprika', 'ingredient_category_id' => 9],
            ['name' => 'turmeric', 'ingredient_category_id' => 9],
            ['name' => 'ginger', 'ingredient_category_id' => 9],
            ['name' => 'cinnamon', 'ingredient_category_id' => 9],

            // Sauces
            ['name' => 'soy sauce', 'ingredient_category_id' => 10],
            ['name' => 'olive oil', 'ingredient_category_id' => 10],
            ['name' => 'coconut milk', 'ingredient_category_id' => 10],
            ['name' => 'tomato puree', 'ingredient_category_id' => 10],
            ['name' => 'vinegar', 'ingredient_category_id' => 10],
            ['name' => 'hot sauce', 'ingredient_category_id' => 10],
            ['name' => 'barbecue sauce', 'ingredient_category_id' => 10],
            ['name' => 'sriracha', 'ingredient_category_id' => 10],
            ['name' => 'teriyaki sauce', 'ingredient_category_id' => 10],

            // Grains
            ['name' => 'rice', 'ingredient_category_id' => 11],
            ['name' => 'pasta', 'ingredient_category_id' => 11],
            ['name' => 'quinoa', 'ingredient_category_id' => 11],
            ['name' => 'bread', 'ingredient_category_id' => 11],
            ['name' => 'oats', 'ingredient_category_id' => 11],

            // Legumes
            ['name' => 'chickpeas', 'ingredient_category_id' => 12],
            ['name' => 'lentils', 'ingredient_category_id' => 12],
            ['name' => 'black beans', 'ingredient_category_id' => 12],
            ['name' => 'kidney beans', 'ingredient_category_id' => 12],
            ['name' => 'tofu', 'ingredient_category_id' => 12],
        ];

        Ingredient::insert($ingredients);
    }
}