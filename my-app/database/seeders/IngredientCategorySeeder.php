<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class IngredientCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredient_category = [
            ['name' => 'Vegetables'],
            ['name' => 'Fruits'],
            ['name' => 'Dairy'],
            ['name' => 'Meat'],
            ['name' => 'Nuts & Seeds'],
            ['name' => 'Spices & Sauces'],
            ['name' => 'Other'],
        ];

        Category::insert($ingredient_category);
    }
}
