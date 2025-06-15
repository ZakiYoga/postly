<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
    public function homepage()
    {
        $posts = Post::where('visibility', 'public')
            ->latest()
            ->take(3)
            ->get();

        return view('front.homepage', [
            'title' => 'Homepage',
            'posts' => $posts,
        ]);
    }

    public function about()
    {
        return view('front.aboutpage', [
            'title' => 'About',
            'about' => 'Website blog sederhana ...'
        ]);
    }

    public function index(Request $request)
    {
        $posts = Post::with(['category'])->where('visibility', 'public')
            ->withCount('comments')
            ->filter($request->only(['search', 'category', 'author']))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('front.postspage', [
            'title' => 'Blog',
            'heading' => 'Discover Nice Articles Here',
            'description' => 'Welcome to our blog, a friendly space where we share stories and knowledge. Feel free to browse through our articles and find something that resonates with you.',
            'posts' => $posts,
            'count' => $posts->total(),
            'currentSearch' => $request->search,
            'currentAuthor' => $request->author,
            'currentCategory' => $request->category,
        ]);
    }

    public function show(Post $post)
    {
        $comments = $post->comments()
            ->with([
                'user',
                'replies' => function ($query) {
                    $query->with('user')
                        ->approved()
                        ->orderBy('created_at', 'asc');
                }
            ])
            ->whereNull('parent_id')
            ->approved()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('front.postpage', [
            'title' => 'Single Post',
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function author(User $user)
    {
        $posts = Post::where('visibility', 'public')
            ->where('user_id', $user->id)
            ->with(['category', 'author'])
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('front.postspage', [
            'title' => 'Article by ' . $user->name,
            'heading' => 'Posts by ' . $user->name,
            'description' => 'Found ' . $posts->total() . ' article(s) by ' . $user->name,
            'posts' => $posts,
            'count' => $posts->total(),
            'currentAuthor' => $user->username,
            'currentCategory' => null,
            'currentSearch' => null
        ]);
    }

    public function contact()
    {
        return view('front.contactpage', [
            'title' => 'Contact'
        ]);
    }
}
