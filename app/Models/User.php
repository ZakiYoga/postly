<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravolt\Avatar\Facade as Avatar;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::url($this->avatar);
        }

        return Avatar::create($this->name)->toBase64();
    }

    // Relation dengan Post
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    // Relation dengan Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relation dengan Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Relation dengan PostView
    public function views()
    {
        return $this->hasMany(PostView::class);
    }

    // Method untuk like/unlike post
    public function toggleLike(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists()
            ? $this->likes()->where('post_id', $post->id)->delete()
            : $this->likes()->create(['post_id' => $post->id]);
    }
}