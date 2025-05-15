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
        $posts = Post::where('author_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        $postCount = Post::where('author_id', Auth::id())->count();
        return view('user.dashboard', compact('posts', 'postCount'));
    }

    public function drafts()
    {
        $drafts = 'draft';
        return view('user.dashboard.drafts', compact('drafts'));
    }
    public function trash()
    {
        $trash = 'trash';
        return view('user.dashboard.trash', compact('trash'));
    }
}
