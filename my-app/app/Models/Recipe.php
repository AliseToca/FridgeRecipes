<?php

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
        return $this->belongsToMany(User::class, 'saved_recipes', 'recipes_id', 'user_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class, 'recipes_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_recipe');
    }

    public function updateRating()
    {
        $avg = $this->comments()->avg('rating'); 
        $this->rating = is_null($avg) ? 0 : round($avg, 2);
        $this->save();
    }
}
