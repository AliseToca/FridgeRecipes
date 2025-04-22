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
            ['name' => 'Other'],
            ['name' => 'Vegetables'],
            ['name' => 'Fruits'],
            ['name' => 'Dairy'],
            ['name' => 'Meat'],
            ['name' => 'Seafood'],
            ['name' => 'Nuts'],
            ['name' => 'Seeds'],
            ['name' => 'Spices'],
            ['name' => 'Sauces'],
            ['name' => 'Grains'],
            ['name' => 'Legumes'],
        ];

        Category::insert($ingredient_category);
    }
}
