<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['name', 'ingredient_category_id'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients', 'ingredients_id', 'recipes_id')
        ->withPivot('amount')
        ->withTimestamps();
    }

// Ingredient.php
    public function fridges()
    {
        return $this->belongsToMany(Fridge::class, 'fridge_ingredients', 'ingredients_id', 'fridges_id')
                    ->withPivot('amount', 'unit'); // Add any other pivot fields you need
    }


    // Ingredient.php
    public function ingredientCategory()
    {
        return $this->belongsTo(Category::class, 'ingredient_category_id');
    }

}
