<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {

        $recipes = [
            [
                'name' => 'Healthy Rich Salad',
                'img' => '/images/recipe/salad.jpg',
                'minutes' => 12,
                'rating' => 3,
                'ingredients' => 6,
                'content' => 'This healthy salad is packed with vibrant greens, nuts, and a zesty vinaigrette. Perfect for a light lunch or side dish. It’s easy, fast, and incredibly nutritious!',
            ],
            [
                'name' => 'Butter Chicken',
                'img' => '/images/recipe/butter-chicken-test.jpg',
                'minutes' => 15,
                'rating' => 4,
                'ingredients' => 4,
                'content' => 'Butter Chicken is a rich and creamy Indian dish made with tender chicken in a spiced tomato sauce. Serve it with naan or basmati rice for a satisfying meal.',
            ],
            [
                'name' => 'Eggs and Bacon',
                'img' => '/images/recipe/bacon-and-eggs.jpg',
                'minutes' => 10,
                'rating' => 2,
                'ingredients' => 8,
                'content' => 'A classic breakfast combo! Crispy bacon and perfectly cooked eggs served with toast or hash browns. Quick, simple, and satisfying.',
            ],
            [
                'name' => 'Kikas Special',
                'img' => '/images/recipe/kika-special.jpg',
                'minutes' => 60,
                'rating' => 5,
                'ingredients' => 9,
                'content' => 'Kika’s Special is a mystery blend of secret ingredients and cooking magic. Slow-cooked to perfection, this recipe is a family favorite with deep, layered flavors.',
            ],
        ];

        // Generate slugs dynamically
        foreach ($recipes as &$recipe) {
            $recipe['slug'] = Str::slug($recipe['name']);
        }

        Recipe::insert($recipes);
    }
}