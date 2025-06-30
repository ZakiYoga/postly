<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->sentence() . '-' . Str::random(5)),
            'body' => $this->faker->paragraph(10),
            'cover_image' => null,
            'unsplash_image_url' => null, // Will be set in DatabaseSeeder
            'category_id' => Category::factory(),
            'author_id' => User::factory(),
        ];
    }

    /**
     * Configure the model factory with Unsplash image
     */
    public function withUnsplashImage(?string $categoryName = null): static
    {
        return $this->state(function (array $attributes) use ($categoryName) {
            // Use provided category name or get random search term
            $searchTerm = $categoryName ?? $this->getRandomSearchTerm();

            return [
                'unsplash_image_url' => $this->fetchUnsplashImage($searchTerm)
            ];
        });
    }

    /**
     * Fetch image from Unsplash
     */
    private function fetchUnsplashImage(string $query): ?string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Client-ID ' . config('services.unsplash.access_key')
            ])
                ->timeout(15)
                ->retry(2, 1000) // Retry 2 times with 1 second delay
                ->get('https://api.unsplash.com/photos/random', [
                    'query' => $query,
                    'orientation' => 'landscape',
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['urls']['regular'] ?? null;
            }

            // Log the error for debugging
            Log::warning("Unsplash API failed: " . $response->status() . " - " . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error("Unsplash fetch error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get random search terms for variety
     */
    private function getRandomSearchTerm(): string
    {
        $terms = [
            'technology',
            'nature',
            'business',
            'travel',
            'food',
            'lifestyle',
            'education',
            'health',
            'science',
            'art',
            'sports',
            'music',
            'architecture',
            'photography',
            'fashion',
            'programming',
            'design',
            'startup',
            'innovation',
            'digital'
        ];

        return $this->faker->randomElement($terms);
    }
}
