<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostViewService;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
    protected $postViewService;

    public function __construct(PostViewService $postViewService)
    {
        $this->postViewService = $postViewService;
    }

    public function homepage(Request $request)
    {
        $allPosts = Post::with(['category', 'author'])
            ->where('visibility', 'public')
            ->withCount('comments')
            ->filter($request->only(['search', 'category', 'author']))
            ->latest()
            ->get();

        // Most Viewed
        $mostViewedData = $this->postViewService->getMostViewedPosts(10);
        $mostViewedIds = collect($mostViewedData)->pluck('id')->toArray();

        $mostViewed = Post::with(['category', 'author'])
            ->whereIn('id', $mostViewedIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $mostViewedIds) . ')')
            ->get();

        if ($mostViewed->isEmpty()) {
            $mostViewed = Post::with(['category', 'author'])
                ->where('visibility', 'public')
                ->latest()
                ->take(10)
                ->get();
        }

        // Most Trending Posts (berdasarkan likes + comments dalam 7 hari terakhir)
        $trending = $this->postViewService->getTrendingPosts(10, 7);
        if ($trending->isEmpty()) {
            $trending = Post::with(['category', 'author'])
                ->where('visibility', 'public')
                ->latest()
                ->take(10)
                ->get();
        }

        // Filter untuk news slider (featured posts) - ambil 5 terbaru
        $news = Post::with(['author', 'category'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'cover_image' => $post->cover_image ? 'storage/' . $post->cover_image : $post->unsplash_image_url,
                    'category' => $post->category->name ?? 'Uncategorized',
                    'category_slug' => $post->category->slug ?? 'uncategorized',
                    'category_color' => $post->category->color ?? '#fff',
                    'author' => $post->author->name ?? 'Unknown',
                    'author_slug' => $post->author->username ?? 'unknown',
                    'time_ago' => $post->created_at->diffForHumans(),
                ];
            });

        $sidebarPosts = $news->skip(5)->take(5);

        // Category Posts dengan Pagination
        $categoryPostsQuery = Post::with(['category', 'author'])
            ->where('visibility', 'public')
            ->withCount('comments')
            ->latest();

        // Filter berdasarkan category jika ada
        if ($request->has('category') && $request->category) {
            $categoryPostsQuery->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        // Pagination untuk category posts (8 posts per halaman)
        $categoryPosts = $categoryPostsQuery->paginate(8, ['*'], 'category_page');

        // Append query parameters ke pagination links
        $categoryPosts->appends($request->query());

        // Pagination untuk semua posts (9 posts per halaman)
        $paginatedPosts = $allPosts->forPage($request->get('page', 1), 9);

        // Get all categories untuk filter
        $categories = \App\Models\Category::orderBy('name')->get();

        return view(
            'front.homepage',
            [
                'title' => 'Homepage'
            ],
            compact('news', 'sidebarPosts', 'allPosts', 'mostViewed', 'trending', 'categoryPosts', 'categories')
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

        // Get all categories for filter dropdown
        $categories = Category::orderBy('name')->get();

        // Get all authors who have published posts for filter dropdown
        $authors = User::whereHas('posts', function ($query) {
            $query->where('visibility', 'public');
        })
            ->orderBy('name')
            ->get();

        return view('front.postspage', [
            'title' => 'Blog',
            'heading' => 'Discover Nice Articles Here',
            'description' => 'Welcome to our blog, a friendly space where we share stories and knowledge. Feel free to browse through our articles and find something that resonates with you.',
            'posts' => $posts,
            'count' => $posts->total(),
            'categories' => $categories,
            'authors' => $authors,
            'currentSearch' => $request->search,
            'currentAuthor' => $request->author,
            'currentCategory' => $request->category,
        ]);
    }

    public function show(Post $post, Request $request)
    {
        $post->load(['category', 'author']);

        // Track view
        $this->postViewService->trackView($post, $request);

        // Get view count
        $viewCount = $this->postViewService->getPostViewCount($post);

        // Most Trending Posts (berdasarkan likes + comments dalam 7 hari terakhir)
        $trending = $this->postViewService->getTrendingPosts(10, 7);
        if ($trending->isEmpty()) {
            $trending = Post::with(['category', 'author'])
                ->where('visibility', 'public')
                ->latest()
                ->take(10)
                ->get();
        }

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
            'comments' => $comments,
            'trending' => $trending,
            'viewCount' => $viewCount,
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
