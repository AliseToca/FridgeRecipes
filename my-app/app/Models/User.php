<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRole;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'role' => UserRole::class,
    ];
    // Optional helper
    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'bio',
        'profile_image',
        'role',
    ];
    
    protected $visible = [
        'id',
        'name',
        'profile_image',
        'username',
        'role',
        'email',
        'formatted_created_at',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['formatted_created_at'];
    
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d M Y');
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

    public function fridge()
    {
        return $this->hasOne(Fridge::class);
    }

    public function savedRecipes()
    {
        return $this->belongsToMany(Recipe::class, 'saved_recipes', 'user_id', 'recipes_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

}
