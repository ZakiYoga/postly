<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();

        foreach ($posts as $post) {
            // Each post gets 1-8 comments
            $commentCount = rand(1, 8);

            // Create main comments
            $comments = Comment::factory()
                ->count($commentCount)
                ->recycle([$post, $users])
                ->create();

            // Add replies to some comments (30% chance)
            foreach ($comments as $comment) {
                if (fake()->boolean(30)) {
                    $replyCount = rand(1, 3);

                    Comment::factory()
                        ->count($replyCount)
                        ->reply($comment)
                        ->recycle($users)
                        ->create();
                }
            }
        }

        $this->command->info('Comment seeder completed successfully!');
    }
}
