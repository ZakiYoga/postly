<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create categories and users first
        $this->call([
            CategorySeeder::class,
            UserSeeder::class
        ]);

        // Get all categories and users for recycling
        $categories = Category::all();
        $users = User::all();

        if ($categories->isEmpty() || $users->isEmpty()) {
            $this->command->error('Categories or Users not found. Make sure CategorySeeder and UserSeeder run successfully.');
            return;
        }

        $this->command->info('Creating posts with Unsplash images...');
        $this->command->info('Total categories: ' . $categories->count());
        $this->command->info('Total users: ' . $users->count());

        // Create posts with progress bar
        $progressBar = $this->command->getOutput()->createProgressBar(40);
        $progressBar->start();

        $successCount = 0;
        $failCount = 0;

        for ($i = 0; $i < 40; $i++) {
            $category = $categories->random();
            $user = $users->random();

            try {
                // Generate Unsplash image based on category
                $unsplashImageUrl = $this->generateUnsplashImage($category->name);

                Post::factory()->create([
                    'category_id' => $category->id,
                    'author_id' => $user->id,
                    'unsplash_image_url' => $unsplashImageUrl
                ]);

                if ($unsplashImageUrl) {
                    $successCount++;
                } else {
                    $failCount++;
                }
            } catch (\Exception $e) {
                $this->command->error("Error creating post: " . $e->getMessage());
                $failCount++;
            }

            $progressBar->advance();

            // Small delay to avoid hitting API rate limits
            usleep(200000); // 0.2 second delay
        }

        $progressBar->finish();
        $this->command->newLine();
        $this->command->info("Posts created successfully!");
        $this->command->info("Images fetched successfully: {$successCount}");
        $this->command->info("Images failed to fetch: {$failCount}");

        // Create interactions after posts are created
        $this->call([
            LikeSeeder::class,
            CommentSeeder::class,
            PostViewSeeder::class,
        ]);
    }

    /**
     * Generate Unsplash image URL based on category name
     */
    private function generateUnsplashImage(string $categoryName): ?string
    {
        try {
            // Debug: Check if access key exists
            $accessKey = config('services.unsplash.access_key');
            if (!$accessKey) {
                $this->command->error('Unsplash access key not found in config');
                return null;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Client-ID ' . $accessKey
            ])
                ->timeout(15)
                ->retry(2, 1000)
                ->get('https://api.unsplash.com/photos/random', [
                    'query' => $categoryName,
                    'orientation' => 'landscape',
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $imageUrl = $data['urls']['regular'] ?? null;

                if ($imageUrl) {
                    $this->command->info("✓ Image for '{$categoryName}'");
                    return $imageUrl;
                }
            } else {
                $this->command->warn("✗ API Error for '{$categoryName}': " . $response->status());
                // Log response for debugging
                Log::warning("Unsplash API Error", [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'category' => $categoryName
                ]);
            }

            return null;
        } catch (\Exception $e) {
            $this->command->error("✗ Exception for '{$categoryName}': " . $e->getMessage());
            Log::error('Unsplash fetch error', [
                'category' => $categoryName,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
}
