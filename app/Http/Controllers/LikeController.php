<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login untuk memberikan like'
            ], 401);
        }

        $user = Auth::user();

        // Cek apakah user sudah like post ini
        $existingLike = $post->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            // Jika sudah like, hapus like (unlike)
            $existingLike->delete();
            $isLiked = false;
        } else {
            // Jika belum like, tambahkan like
            $post->likes()->create([
                'user_id' => $user->id,
                'reaction' => 'like'
            ]);
            $isLiked = true;
        }

        // Hitung ulang total likes
        $likesCount = $post->likes()->count();

        return response()->json([
            'success' => true,
            'is_liked' => $isLiked,
            'likes_count' => $likesCount,
            'message' => $isLiked ? 'Post berhasil dilike' : 'Like berhasil dihapus'
        ]);
    }
}
