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
        'ip_address',
        'user_agent',
        'user_id'
    ];

    // Relation dengan Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relation dengan User (opsional jika user login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}