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
        'ingredients',
        'instructions',
    ];

    protected $casts = [
        'ingredients' => 'array', 
        'instructions' => 'array',  // ✅ Automatically decode JSON into array
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
