<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedRecipe extends Model
{
    protected $table = 'saved_recipes';

    public $incrementing = false; // because no id
    protected $keyType = 'string'; // (not strictly necessary, but safe)

    protected $fillable = ['user_id', 'recipes_id'];
}

