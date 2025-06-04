<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Fridge Recipes',
            'username' => 'FridgeRecipes',
            'email' => 'fridgeRecipes@gmail.com',
        ]);

        $this->call([
            RecipeSeeder::class,
            FridgeSeeder::class,
            IngredientCategorySeeder::class,
            IngredientSeeder::class,
            RecipeIngredientSeeder::class,
            CategorySeeder::class,
            RecipeCategorySeeder::class,
        ]);

        Comment::factory()->count(100)->create();
        Recipe::all()->each(fn ($recipe) => $recipe->updateRating());
    }
}
