<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostView;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();

        foreach ($posts as $post) {
            // Each post gets 10-100 views
            $viewCount = rand(10, 100);

            PostView::factory()
                ->count($viewCount)
                ->recycle([$post, $users])
                ->create();

            // Add some recent views (last 7 days)
            $recentViews = rand(2, 15);
            PostView::factory()
                ->count($recentViews)
                ->recent()
                ->recycle([$post, $users])
                ->create();

            // Add some today's views
            $todayViews = rand(0, 5);
            if ($todayViews > 0) {
                PostView::factory()
                    ->count($todayViews)
                    ->today()
                    ->recycle([$post, $users])
                    ->create();
            }
        }

        $this->command->info('PostView seeder completed successfully!');
    }
}
