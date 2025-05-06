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
            ['id' => 1,  'name' => 'Fresh Produce'],
            ['id' => 2,  'name' => 'Meat & Seafood'],
            ['id' => 3,  'name' => 'Dairy & Eggs'],
            ['id' => 4,  'name' => 'Bakery'],
            ['id' => 5,  'name' => 'Pantry (Dry Goods)'],
            ['id' => 6,  'name' => 'Oils, Sauces & Condiments'],
            ['id' => 7,  'name' => 'Spices & Seasonings'],
        ];

        Category::insert($ingredient_category);
    }
}
