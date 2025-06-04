<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1, 5),
            'recipes_id' => Recipe::inRandomOrder()->first()->id,
            'user_id' => User::factory(),
        ];
    }
}
