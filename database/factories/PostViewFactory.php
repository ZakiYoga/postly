<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostView>
 */
class PostViewFactory extends Factory
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
            'user_id' => fake()->boolean(70) ? User::factory() : null, // 70% logged in users, 30% anonymous
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'viewed_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }

    /**
     * Indicate that the view is from an anonymous user.
     */
    public function anonymous(): static
    {
        return $this->state(fn(array $attributes) => [
            'user_id' => null,
        ]);
    }

    /**
     * Indicate that the view is from a logged-in user.
     */
    public function authenticated(): static
    {
        return $this->state(fn(array $attributes) => [
            'user_id' => User::factory(),
        ]);
    }

    /**
     * Indicate that the view is recent (within last 7 days).
     */
    public function recent(): static
    {
        return $this->state(fn(array $attributes) => [
            'viewed_at' => fake()->dateTimeBetween('-7 days', 'now'),
        ]);
    }

    /**
     * Indicate that the view is from today.
     */
    public function today(): static
    {
        return $this->state(fn(array $attributes) => [
            'viewed_at' => fake()->dateTimeBetween('today', 'now'),
        ]);
    }
}
