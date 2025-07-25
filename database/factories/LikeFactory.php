<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'user_id' => User::factory(),
            'reaction' => 'like',
        ];
    }

    /**
     * Indicate that the reaction is dislike (if needed in future).
     */
    // public function dislike(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'reaction' => 'dislike',
    //     ]);
    // }
}
