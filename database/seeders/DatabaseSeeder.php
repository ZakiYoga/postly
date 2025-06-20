<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

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

        // Create posts using existing categories and users
        Post::factory(40)->recycle([
            Category::all(),
            User::all(),
        ])->create();

        // Create interactions after posts are created
        $this->call([
            LikeSeeder::class,
            CommentSeeder::class,
            PostViewSeeder::class,
        ]);
    }
}
