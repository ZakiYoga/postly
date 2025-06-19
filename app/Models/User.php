<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\ResetPasswordNotification;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Intervention\Image\Encoders\PngEncoder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;

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
        'google_id',
        'email_verified_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            if (empty($user->avatar)) {
                $user->generateAvatar();
            }
        });
    }

    public function generateAvatar()
    {
        $avatar = Avatar::create($this->username)->getImageObject();

        $filename = 'avatars/' . 'laravolt' . $this->id . time() . '.png';
        Storage::disk('public')->put($filename, $avatar->encode(new PngEncoder()));

        $this->update(['avatar' => $filename]);
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : Avatar::create($this->username)->toBase64();
    }

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

    /**
     * Send the password reset notification.
     */
    public function sendPasswordResetNotification($token): void
    {
        Log::info('=== Starting password reset notification ===');
        Log::info('User email: ' . $this->email);
        Log::info('Token: ' . $token);

        try {
            $this->notify(new ResetPasswordNotification($token));
            Log::info('Password reset notification sent successfully');
        } catch (\Exception $e) {
            Log::error('Failed to send password reset notification: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
        }

        Log::info('=== End password reset notification ===');
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