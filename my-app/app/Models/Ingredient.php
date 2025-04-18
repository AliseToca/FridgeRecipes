<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['name', 'ingredient_category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients', 'ingredients_id', 'recipes_id')
        ->withPivot('amount')
        ->withTimestamps();
    }

    public function fridges()
    {
        return $this->belongsToMany(Fridge::class, 'fridge_ingredients')
                    ->withPivot('amount', 'unit')
                    ->withTimestamps();
    }
}
