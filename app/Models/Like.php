<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /** @use HasFactory<\Database\Factories\LikeFactory> */
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'is_liked',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relation dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}