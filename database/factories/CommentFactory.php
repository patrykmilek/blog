<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'post_id' => Post::factory(), // lub użyj istniejącego posta
            'user_id' => User::factory(), // lub użyj istniejącego użytkownika
            'comment' => $this->faker->sentence(),
        ];
    }
}
