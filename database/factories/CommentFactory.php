<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'content' => fake('id_ID')->paragraph(rand(1, 3)),
            'parent_id' => null,
            'is_approved' => fake()->boolean(90), // 90% approved
        ];
    }

    /**
     * Indicate that the comment is a reply to another comment.
     */
    public function reply(Comment $parentComment): static
    {
        return $this->state(fn(array $attributes) => [
            'post_id' => $parentComment->post_id,
            'parent_id' => $parentComment->id,
            'content' => fake('id_ID')->sentence(rand(5, 15)),
            'is_approved' => fake()->boolean(95), // 95% approved for replies
        ]);
    }

    /**
     * Indicate that the comment is not approved.
     */
    public function unapproved(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_approved' => false,
        ]);
    }

    /**
     * Indicate that the comment is approved.
     */
    public function approved(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_approved' => true,
        ]);
    }
}
