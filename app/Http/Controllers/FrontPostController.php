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

        // Most Trending
        $trendingData = $this->postViewService->getTrendingPosts(10);
        $trendingIds = collect($trendingData)->pluck('id')->toArray();

        $trending = Post::with(['category', 'author'])
            ->whereIn('id', $trendingIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $trendingIds) . ')')
            ->get();

        // Filter untuk news slider (featured posts) - ambil 5 terbaru
        $news = $allPosts->take(5)->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'category' => $post->category->name ?? 'Uncategorized',
                'category_slug' => $post->category->slug ?? 'uncategorized',
                'author' => $post->author->name ?? 'Unknown',
                'author_slug' => $post->author->username ?? 'unknown',
                'time_ago' => $post->created_at->diffForHumans(),
                'cover_image' => $post->cover_image ? 'storage/' . $post->cover_image : null,
            ];
        });

        $sidebarPosts = $allPosts->skip(5)->take(5);

        $categoryPosts = $allPosts;
        if ($request->has('category') && $request->category) {
            $categoryPosts = $allPosts->filter(function ($post) use ($request) {
                return $post->category && $post->category->slug === $request->category;
            });
        }

        // Jika butuh pagination untuk halaman tertentu
        $paginatedPosts = $allPosts->forPage($request->get('page', 1), 9);

        return view(
            'front.homepage',
            [
                'title' => 'Homepage'
            ],
            compact('news', 'sidebarPosts', 'allPosts', 'mostViewed', 'trending', 'categoryPosts')
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

    public function show(Post $post, Request $request)
    {
        $post->load(['category', 'author']);

        // Track view
        $this->postViewService->trackView($post, $request);

        // Get view count
        $viewCount = $this->postViewService->getPostViewCount($post);

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
