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
        $title = 'Dashboard';
        $posts = Post::with(['category', 'author'])
            ->withCount(['comments', 'likes'])
            ->where('author_id', Auth::id())
            ->latest()
            ->get();

        return view('user.dashboard', compact('title', 'posts'));
    }

    public function archive()
    {
        $title = 'Archive';
        $archive = 'archive';
        return view('user.dashboard.archive', compact('title', 'archive'));
    }
    public function trash()
    {
        $title = 'Trash';
        $trash = 'trash';
        return view('user.dashboard.trash', compact('title', 'trash'));
    }
}
