<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function fridge()
    {
        return $this->hasOne(Fridge::class);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            Fridge::create([
                'name' => $user->name . "'s Fridge",
                'user_id' => $user->id,
            ]);
        });
    }

    public function savedRecipes()
    {
        return $this->belongsToMany(SaavedRecipe::class, 'saved_recipes', 'user_id', 'recipes_id')->withTimestamps();
    }
    

}
