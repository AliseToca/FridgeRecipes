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
                'user_id' => 1,
                'name' => 'Healthy Rich Salad',
                'img' => '/images/recipe/salad.jpg',
                'bio' => 'This healthy salad is packed with vibrant greens, nuts, and a zesty vinaigrette. Perfect for a light lunch or side dish. It’s easy, fast, and incredibly nutritious!',
                'cookMinutes' => 12,
                'rating' => 3,
                'ingredients' => json_encode(['lettuce', 'tomato', 'cucumber', 'avocado', 'walnuts', 'feta']),
                'instructions' => json_encode([
                    'Chop the lettuce and tomatoes.',
                    'Slice the avocado and cucumber.',
                    'Toss everything together in a large bowl.',
                    'Top with feta and walnuts, then drizzle with vinaigrette.',
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Butter Chicken',
                'img' => '/images/recipe/butter-chicken-test.jpg',
                'bio' => 'Butter Chicken is a rich and creamy Indian dish made with tender chicken in a spiced tomato sauce. Serve it with naan or basmati rice for a satisfying meal',
                'cookMinutes' => 15,
                'rating' => 4,
                'ingredients' =>json_encode(['Chicken', 'Butter', 'Tomato Puree', 'Cream']),
                'instructions' => json_encode([
                    'Marinate chicken in yogurt and spices.',
                    'Cook chicken until browned.',
                    'Add tomato puree and simmer.',
                    'Stir in cream and serve with rice or naan.'
                ]),
            ],
            [
                'user_id' => 1,
                'name' => 'Kikas Special',
                'img' => '/images/recipe/kika-special.jpg',
                'bio' => 'Kika’s Special is a mystery blend of secret ingredients and cooking magic. Slow-cooked to perfection, this recipe is a family favorite with deep, layered flavors',
                'cookMinutes' => 60,
                'rating' => 5,
                'ingredients' => json_encode(['Secret Ingredient 1', 'Secret Ingredient 2', 'Love', 'Time', 'Skill', 'Magic', 'Flavor', 'Joy', 'Mystery']),
                'instructions' => json_encode([
                    'Prepare all mystery ingredients carefully.',
                    'Cook slowly over low heat.',
                    'Add love and patience.',
                    'Garnish with joy and serve warm.'
                ]),
            ],
        ];
    
        foreach ($recipes as &$recipe) {
            $recipe['slug'] = Str::slug($recipe['name']);
        }
    
        Recipe::insert($recipes);
    }
    
}