<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;


class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        Recipe::insert([
            [
                'name' => 'Healthy Rich Salad',
                'slug' => 'healthy-rich-salad',
                'img' => '/images/recipe/salad.jpg',
                'minutes' => 12,
                'rating' => 3,
                'ingredients' => 6,
            ],
            [
                'name' => 'Butter Chicken',
                'slug' => 'butter-chicken',
                'img' => '/images/recipe/butter-chicken-test.jpg',
                'minutes' => 15,
                'rating' => 4,
                'ingredients' => 4,
            ],
            [
                'name' => 'Eggs and Bacon',
                'slug' => 'eggs-and-bacon',
                'img' => '/images/recipe/bacon-and-eggs.jpg',
                'minutes' => 10,
                'rating' => 2,
                'ingredients' => 8,
            ],
            [
                'name' => 'Kikas Special',
                'slug' => 'kikas-special',
                'img' => '/images/recipe/kika-special.jpg',
                'minutes' => 60,
                'rating' => 5,
                'ingredients' => 9,
            ],
        ]);
    }
}