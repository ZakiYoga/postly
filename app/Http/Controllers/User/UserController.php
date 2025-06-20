<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use Laravolt\Avatar\Avatar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'author'])
            ->withCount(['comments', 'likes'])
            ->where('author_id', Auth::id())
            ->latest()
            ->get();

        return view('user.dashboard', compact('posts'));
    }

    public function archive()
    {
        $archive = 'archive';
        return view('user.dashboard.archive', compact('archive'));
    }
    public function trash()
    {
        $trash = 'trash';
        return view('user.dashboard.trash', compact('trash'));
    }
}
