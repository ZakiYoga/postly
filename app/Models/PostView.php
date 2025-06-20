<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    /** @use HasFactory<\Database\Factories\PostViewFactory> */
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'ip_address',
        'user_agent',
        'viewed_at'
    ];

    protected $casts = [
        'viewed_at' => 'datetime'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope for view 12 hours
    public function scopeRecent($query, $hours = 12)
    {
        return $query->where('viewed_at', '>=', now()->subHours($hours));
    }

    // Scope today
    public function scopeToday($query)
    {
        return $query->whereDate('viewed_at', today());
    }
}
