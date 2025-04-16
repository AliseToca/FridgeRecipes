<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $recipes = Recipe::all();

        $allIngredients = [];

        foreach ($recipes as $recipe) {
            $ingredients = json_decode($recipe->getOriginal('ingredients'), true);
            $allIngredients = array_merge($allIngredients, $ingredients ?? []);
        }

        $unique = collect($allIngredients)
            ->map(fn($i) => trim(strtolower($i)))
            ->unique();

        foreach ($unique as $name) {
            Ingredient::firstOrCreate(['name' => $name, 'ingredient_category_id' => 1]); // Dummy category for now
        }
    }
}