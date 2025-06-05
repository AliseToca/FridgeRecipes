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
            'butter-chicken' => ['gluten-free', 'meat'],
            'classic-spaghetti-bolognese' => ['meat'],
            'creamy-mushroom-risotto' => ['vegetarian'],
            'vegetarian-stir-fry' => ['vegetarian', 'quick'],
            'baked-salmon-with-veggies' => ['healthy', 'low-carb', 'meat'],
            'avocado-toast-with-egg' => ['vegetarian', 'breakfast','quick'],
            'spicy-chickpea-curry' => ['vegetarian', 'vegan'],
            'grilled-chicken-caesar-salad' => ['protein-rich', 'low-carb','meat'],
            'stuffed-bell-peppers' => ['gluten-free', 'meat'],
            'peanut-butter-banana-smoothie' => ['vegetarian', 'breakfast', 'quick'],
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
