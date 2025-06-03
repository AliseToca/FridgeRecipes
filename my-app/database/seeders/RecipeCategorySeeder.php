<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Category;

class RecipeCategorySeeder extends Seeder
{
    public function run(): void
    {
        $assignments = [
            'healthy-rich-salad' => ['vegetarian', 'gluten-free'],
            'butter-chicken' => ['gluten-free'],
            'classic-spaghetti-bolognese' => ['meat'],
            'creamy-mushroom-risotto' => ['vegetarian'],
            'vegetarian-stir-fry' => ['vegetarian', 'quick'],
            'baked-salmon-with-veggies' => ['healthy', 'low-carb'],
            'avocado-toast-with-egg' => ['vegetarian', 'breakfast'],
            'spicy-chickpea-curry' => ['vegetarian', 'vegan'],
            'grilled-chicken-caesar-salad' => ['protein-rich', 'low-carb'],
            'stuffed-bell-peppers' => ['gluten-free'],
            'peanut-butter-banana-smoothie' => ['vegetarian', 'breakfast'],
            'tomato-basil-soup' => ['vegetarian', 'gluten-free'],
            'creamy-mushrooms-with-potatoes' => ['vegetarian'],
        ];

        foreach ($assignments as $slug => $categoryNames) {
            $recipe = Recipe::where('slug', $slug)->first();

            if (!$recipe) continue;

            $categoryIds = Category::whereIn('name', $categoryNames)->pluck('id')->toArray();
            $recipe->categories()->sync($categoryIds);
        }
    }
}
