<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostViewService
{
    protected $resetHours = 12;

    public function trackView(Post $post, Request $request): bool
    {
        $userId = Auth::id();
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();

        // Buat unique key untuk cache
        $cacheKey = $this->getCacheKey($post->id, $userId, $ipAddress);

        // Cek apakah sudah ada view dalam 12 jam terakhir
        if (Cache::has($cacheKey)) {
            return false; // Sudah ada view recent, skip
        }

        // Cek di database untuk double check
        if ($this->hasRecentView($post->id, $userId, $ipAddress)) {
            return false;
        }

        // Record view baru
        $this->recordView($post, $userId, $ipAddress, $userAgent);

        // Set cache untuk 12 jam
        Cache::put($cacheKey, true, now()->addHours($this->resetHours));

        // Update view count di post (optional, untuk performance)
        $this->updatePostViewCount($post);

        return true;
    }

    protected function getCacheKey(int $postId, ?int $userId, string $ipAddress): string
    {
        $identifier = $userId ? "user_{$userId}" : "ip_{$ipAddress}";
        return "post_view_{$postId}_{$identifier}";
    }

    protected function hasRecentView(int $postId, ?int $userId, string $ipAddress): bool
    {
        $query = PostView::where('post_id', $postId)
            ->where('viewed_at', '>=', now()->subHours($this->resetHours));

        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('ip_address', $ipAddress)
                ->whereNull('user_id');
        }

        return $query->exists();
    }

    protected function recordView(Post $post, ?int $userId, string $ipAddress, ?string $userAgent): void
    {
        PostView::create([
            'post_id' => $post->id,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'viewed_at' => now()
        ]);
    }

    protected function updatePostViewCount(Post $post): void
    {
        // Update cache count untuk performance
        $cacheKey = "post_view_count_{$post->id}";
        $count = Cache::remember($cacheKey, 3600, function () use ($post) {
            return PostView::where('post_id', $post->id)->count();
        });

        // Optional: Update field view_count di tabel posts jika ada
        // $post->increment('view_count');
    }

    public function getPostViewCount(Post $post): int
    {
        $cacheKey = "post_view_count_{$post->id}";

        return Cache::remember($cacheKey, 3600, function () use ($post) {
            return PostView::where('post_id', $post->id)->count();
        });
    }

    public function getMostViewedPosts(int $limit = 10, int $days = 30): \Illuminate\Database\Eloquent\Collection
    {
        $cacheKey = "most_viewed_posts_{$limit}_{$days}";

        return Cache::remember($cacheKey, 1800, function () use ($limit, $days) {
            return DB::table('posts')
                ->join('post_views', 'posts.id', '=', 'post_views.post_id')
                ->where('post_views.viewed_at', '>=', now()->subDays($days))
                ->select('posts.*', DB::raw('COUNT(post_views.id) as view_count'))
                ->groupBy('posts.id')
                ->orderByDesc('view_count')
                ->limit($limit)
                ->get();
        });
    }

    public function getTrendingPosts(int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        $cacheKey = "trending_posts_{$limit}";

        return Cache::remember($cacheKey, 900, function () use ($limit) {
            return DB::table('posts')
                ->join('post_views', 'posts.id', '=', 'post_views.post_id')
                ->where('post_views.viewed_at', '>=', now()->subHours(24))
                ->select('posts.*', DB::raw('COUNT(post_views.id) as view_count'))
                ->groupBy('posts.id')
                ->orderByDesc('view_count')
                ->limit($limit)
                ->get();
        });
    }

    // Clean up old views (untuk dijadwalkan via cron)
    public function cleanupOldViews(int $daysToKeep = 90): int
    {
        return PostView::where('viewed_at', '<', now()->subDays($daysToKeep))->delete();
    }
}
