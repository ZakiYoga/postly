<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
    public function homepage(Request $request)
    {
        $allPosts = Post::with(['category', 'author'])
            ->where('visibility', 'public')
            ->withCount('comments')
            ->filter($request->only(['search', 'category', 'author']))
            ->latest()
            ->get(); // Menggunakan get() untuk mendapatkan collection

        // Filter untuk news slider (featured posts) - ambil 5 terbaru
        $news = $allPosts->take(5)->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'category' => $post->category->name ?? 'Uncategorized',
                'time_ago' => $post->created_at->diffForHumans(),
                'image' => $post->featured_image ?? '/images/article-1.png',
                'slug' => $post->slug,
                'excerpt' => $post->excerpt ?? substr(strip_tags($post->content), 0, 150) . '...'
            ];
        });

        // Filter untuk sidebar posts - ambil 3 setelah yang digunakan untuk slider
        $sidebarPosts = $allPosts->skip(5)->take(3);

        // Jika butuh pagination untuk halaman tertentu
        $paginatedPosts = $allPosts->forPage($request->get('page', 1), 9);

        return view(
            'front.homepage',
            [
                'title' => 'Homepage'
            ],
            compact('news', 'sidebarPosts', 'allPosts')
        );
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
        $posts = Post::with(['category'])
            ->where('visibility', 'public')
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

        $sidebarPosts = Post::with(['category'])
            ->where('visibility', 'public')
            ->latest()
            ->take(3)
            ->get();

        return view('front.postpage', [
            'title' => 'Single Post',
            'post' => $post,
            'comments' => $comments,
            'sidebarPosts' => $sidebarPosts,
        ]);
    }

    public function author(User $user)
    {
        $title = 'Author Posts';

        return view('front.authorpage', [
            'title' => $title,
        ]);
    }

    public function contact()
    {
        return view('front.contactpage', [
            'title' => 'Contact'
        ]);
    }
}
