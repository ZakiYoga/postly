<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $posts = Post::where('author_id', Auth::id())->get();
        return view('user.dashboard', compact('posts'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function edit($id)
    {
        $post = Post::where('author_id', Auth::id())->findOrFail($id);
        return view('user.edit', compact('post'));
    }

    public function drafts()
    {
        $drafts = Post::where('author_id', Auth::id())->where('status', 'drafts')->get();
        return view('user.drafts', compact('drafts'));
    }

    public function trash()
    {
        // $trash = Post::where('author_id', Auth::id())->onlyTrashed()->get();
        return view('user.trash');
    }
}
