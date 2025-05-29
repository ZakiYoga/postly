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
        $postLimit = 3;
        $posts = Post::where('author_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take($postLimit)
            ->get();
        $postCount = Post::where('author_id', Auth::id())->count();

        return view('user.dashboard', compact('posts', 'postCount', 'postLimit'));
    }

    public function private()
    {
        $private = 'private';
        return view('user.dashboard.private', compact('private'));
    }
    public function trash()
    {
        $trash = 'trash';
        return view('user.dashboard.trash', compact('trash'));
    }
}
