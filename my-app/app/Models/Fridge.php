<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fridge extends Model
{

    protected $fillable = ['name', 'user_id'];
    

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'fridge_ingredients', 'fridges_id', 'ingredients_id')
                    ->withPivot('amount', 'unit'); // Add any other pivot fields you need
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
