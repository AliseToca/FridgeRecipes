<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'rating', 'recipes_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipes_id');
    }
}
