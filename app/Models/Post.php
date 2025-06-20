<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'author_id',
        'slug',
        'cover_image',
        'unsplash_image_url',
        'body',
        'category_id',
        'visibility',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $withCount = ['likes', 'comments', 'views'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function views()
    {
        return $this->hasMany(PostView::class);
    }

    public function getCommentsCountAttribute(): int
    {
        return $this->attributes['comments_count'] ?? $this->comments()->count();
    }

    public function getLikesCountAttribute(): int
    {
        return $this->attributes['likes_count'] ?? $this->likes()->count();
    }
    public function getViewCountAttribute(): int
    {
        return $this->attributes['views_count'] ?? $this->views()->count();
    }

    public function getRecentViewCountAttribute(): int
    {
        return $this->views()->recent()->count();
    }

    public function getTodayViewCountAttribute(): int
    {
        return $this->views()->today()->count();
    }

    public function isLikedByUser(?User $user = null): bool
    {
        if (!$user) {
            return false;
        }

        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')
            ->withTimestamps();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {
            $query->whereHas('author', function ($query) use ($author) {
                $query->where('username', $author);
            });
        });
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())
            ->where('visibility', 'public');
    }

    // Scope untuk post populer berdasarkan likes
    public function scopePopular($query, $days = 30)
    {
        return $query->withCount(['likes' => function ($query) use ($days) {
            $query->where('created_at', '>=', now()->subDays($days));
        }])
            ->orderBy('likes_count', 'desc');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
