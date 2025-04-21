<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Specify the table name if it differs from the default 'categories'
    protected $table = 'ingredient_category'; // if your table name is 'ingredient_category_table'
    
    // Optionally, if the model has no timestamps (e.g., created_at, updated_at)
    public $timestamps = false;

    // Optionally, you can specify which columns are fillable
    protected $fillable = ['name'];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class, 'ingredient_category_id');
    }

}
