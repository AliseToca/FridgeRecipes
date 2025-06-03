<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            // 1. Fresh Produce
            ['name' => 'lettuce', 'ingredient_category_id' => 1],
            ['name' => 'tomato', 'ingredient_category_id' => 1],
            ['name' => 'cucumber', 'ingredient_category_id' => 1],
            ['name' => 'avocado', 'ingredient_category_id' => 1],
            ['name' => 'carrot', 'ingredient_category_id' => 1],
            ['name' => 'spinach', 'ingredient_category_id' => 1],
            ['name' => 'onion', 'ingredient_category_id' => 1],
            ['name' => 'bell pepper', 'ingredient_category_id' => 1],
            ['name' => 'pepper', 'ingredient_category_id' => 1],
            ['name' => 'zucchini', 'ingredient_category_id' => 1],
            ['name' => 'broccoli', 'ingredient_category_id' => 1],
            ['name' => 'mushrooms', 'ingredient_category_id' => 1],
            ['name' => 'banana', 'ingredient_category_id' => 1],
            ['name' => 'garlic', 'ingredient_category_id' => 1],
            ['name' => 'potatoes', 'ingredient_category_id' => 1],


            // 2. Meat & Seafood
            ['name' => 'chicken', 'ingredient_category_id' => 2],
            ['name' => 'chicken breast', 'ingredient_category_id' => 2],
            ['name' => 'beef', 'ingredient_category_id' => 2],
            ['name' => 'pork', 'ingredient_category_id' => 2],
            ['name' => 'bacon', 'ingredient_category_id' => 2],
            ['name' => 'salmon', 'ingredient_category_id' => 2],
            ['name' => 'shrimp', 'ingredient_category_id' => 2],
            ['name' => 'tuna', 'ingredient_category_id' => 2],
            ['name' => 'turkey', 'ingredient_category_id' => 2],
            ['name' => 'ground beef', 'ingredient_category_id' => 2],


            // 3. Dairy & Eggs
            ['name' => 'cheddar cheese', 'ingredient_category_id' => 3],
            ['name' => 'parmesan cheese', 'ingredient_category_id' => 3],
            ['name' => 'cream', 'ingredient_category_id' => 3],
            ['name' => 'butter', 'ingredient_category_id' => 3],
            ['name' => 'feta cheese', 'ingredient_category_id' => 3],
            ['name' => 'milk', 'ingredient_category_id' => 3],
            ['name' => 'yoghurt', 'ingredient_category_id' => 3],
            ['name' => 'mozzarella', 'ingredient_category_id' => 3],
            ['name' => 'sour cream', 'ingredient_category_id' => 3],
            ['name' => 'buttermilk', 'ingredient_category_id' => 3],
            ['name' => 'egg', 'ingredient_category_id' => 3],
            ['name' => 'coconut milk', 'ingredient_category_id' => 3],
            ['name' => 'cheese spread', 'ingredient_category_id' => 3],


            // 4. Bakery
            ['name' => 'bread', 'ingredient_category_id' => 4],
            ['name' => 'croissant', 'ingredient_category_id' => 4],
            ['name' => 'bagel', 'ingredient_category_id' => 4],
            ['name' => 'bun', 'ingredient_category_id' => 4],
            ['name' => 'pita', 'ingredient_category_id' => 4],
            ['name' => 'tortilla', 'ingredient_category_id' => 4],
            ['name' => 'brioche', 'ingredient_category_id' => 4],
            ['name' => 'croutons', 'ingredient_category_id' => 4],


            // 5. Pantry (Dry Goods)
            ['name' => 'rice', 'ingredient_category_id' => 5],
            ['name' => 'pasta', 'ingredient_category_id' => 5],
            ['name' => 'quinoa', 'ingredient_category_id' => 5],
            ['name' => 'oats', 'ingredient_category_id' => 5],
            ['name' => 'chickpeas', 'ingredient_category_id' => 5],
            ['name' => 'lentils', 'ingredient_category_id' => 5],
            ['name' => 'black beans', 'ingredient_category_id' => 5],
            ['name' => 'tofu', 'ingredient_category_id' => 5],
            ['name' => 'kidney beans', 'ingredient_category_id' => 5],
            ['name' => 'spaghetti', 'ingredient_category_id' => 5],


            // 6. Oils, Sauces & Condiments
            ['name' => 'olive oil', 'ingredient_category_id' => 6],
            ['name' => 'soy sauce', 'ingredient_category_id' => 6],
            ['name' => 'vinegar', 'ingredient_category_id' => 6],
            ['name' => 'hot sauce', 'ingredient_category_id' => 6],
            ['name' => 'tomato puree', 'ingredient_category_id' => 6],
            ['name' => 'barbecue sauce', 'ingredient_category_id' => 6],
            ['name' => 'mayonnaise', 'ingredient_category_id' => 6],
            ['name' => 'sriracha', 'ingredient_category_id' => 6],
            ['name' => 'teriyaki sauce', 'ingredient_category_id' => 6],
            ['name' => 'vegetable broth', 'ingredient_category_id' => 6],
            ['name' => 'caesar dressing', 'ingredient_category_id' => 6],
            ['name' => 'sesame oil', 'ingredient_category_id' => 6],
            ['name' => 'honey', 'ingredient_category_id' => 6],
            ['name' => 'ice', 'ingredient_category_id' => 6],
            ['name' => 'peanut butter', 'ingredient_category_id' => 6], //?????/


            // 7. Spices & Seasonings
            ['name' => 'salt', 'ingredient_category_id' => 7],
            ['name' => 'black pepper', 'ingredient_category_id' => 7],
            ['name' => 'paprika', 'ingredient_category_id' => 7],
            ['name' => 'cumin', 'ingredient_category_id' => 7],
            ['name' => 'oregano', 'ingredient_category_id' => 7],
            ['name' => 'basil', 'ingredient_category_id' => 7],
            ['name' => 'turmeric', 'ingredient_category_id' => 7],
            ['name' => 'cinnamon', 'ingredient_category_id' => 7],
            ['name' => 'ginger', 'ingredient_category_id' => 7],
        ];

        Ingredient::insert($ingredients);
    }
}
