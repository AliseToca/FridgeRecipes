<?php

// app/Models/Recipe.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'img',
        'bio',
        'cookMinutes',
        'rating',
        'instructions',
    ];

    protected $casts = [
        'instructions' => 'array',  
    ];


    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients', 'recipes_id', 'ingredients_id')
                    ->withPivot('amount', 'unit');
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_recipes');
    }

    
}
