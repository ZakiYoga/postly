<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();

        foreach ($posts as $post) {
            // Each post gets 1-15 likes randomly
            $likeCount = rand(1, 15);
            $randomUsers = $users->random(min($likeCount, $users->count()));

            foreach ($randomUsers as $user) {
                // Use factory with recycle to avoid creating new posts/users
                Like::factory()
                    ->recycle([$post, $user])
                    ->create();
            }
        }

        $this->command->info('Like seeder completed successfully!');
    }
}
