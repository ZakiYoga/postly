<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\PostView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class TrackPostViewJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $postId;
    protected $userId;
    protected $ipAddress;
    protected $userAgent;

    public function __construct(int $postId, ?int $userId, string $ipAddress, ?string $userAgent)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }

    public function handle()
    {
        // Buat unique key untuk cache
        $identifier = $this->userId ? "user_{$this->userId}" : "ip_{$this->ipAddress}";
        $cacheKey = "post_view_{$this->postId}_{$identifier}";

        // Cek cache terlebih dahulu
        if (Cache::has($cacheKey)) {
            return; // Skip jika sudah ada view recent
        }

        // Cek database untuk double validation
        $query = PostView::where('post_id', $this->postId)
            ->where('viewed_at', '>=', now()->subHours(12));

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        } else {
            $query->where('ip_address', $this->ipAddress)
                ->whereNull('user_id');
        }

        if ($query->exists()) {
            return; // Skip jika sudah ada view recent
        }

        // Record view baru
        PostView::create([
            'post_id' => $this->postId,
            'user_id' => $this->userId,
            'ip_address' => $this->ipAddress,
            'user_agent' => $this->userAgent,
            'viewed_at' => now()
        ]);

        // Set cache untuk 12 jam
        Cache::put($cacheKey, true, now()->addHours(12));

        // Clear related cache
        Cache::forget("post_view_count_{$this->postId}");
    }
}
