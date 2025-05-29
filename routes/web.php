<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardPostController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('front.homepage', [
        'title' => 'Homepage',
        'posts' => Post::latest()->get(),
        'categories' => Category::all(),
    ]);
});

Route::get('/about', function () {
    return view('front.aboutpage', [
        'title' => 'About',
        'nama' => 'Zaki Satria'
    ]);
});

Route::get('/posts', function () {
    return view('front.postspage', [
        'title' => 'Our Discover nice articles here',
        'description' => 'Welcome to our blog, a friendly space where we share stories and knowledge. Feel free to browse through our articles and find something that resonates with you.',
        'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(9)->withQueryString(),
        'count' => Post::filter(request(['search', 'category', 'author']))->latest()->count(),
        'currentSearch' => request('search'),
        'currentAuthor' => request('author'),
        'currentCategory' => request('category'),
    ]);
});

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('front.postpage ', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user) {
    $posts = Post::with(['category', 'author'])
        ->latest()
        ->paginate(6);
    return view('front.postspage ', [
        'title' => 'Article by ' . $user->name,
        'description' => 'Found ' . count($user->posts) . ' article by ' . $user->name,
        'posts' => $posts
    ]);
});

Route::get('/contact', function () {
    return view('contactpage', [
        'title' => 'Contact'
    ]);
});

Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');


require __DIR__ . '/auth.php';

// Check Slug
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

// User Routes
Route::middleware(['auth', 'userMiddleware'])->prefix('dashboard')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
    Route::resource('/posts', DashboardPostController::class)->names([
        'index' => 'posts.index',
        'create' => 'posts.create',
        'store' => 'posts.store',
        'show' => 'posts.show',
        'edit' => 'posts.edit',
        'update' => 'posts.update',
        'destroy' => 'posts.destroy'
    ]);
    Route::post('/posts/fetch-unsplash', [DashboardPostController::class, 'fetchUnsplash'])->name('posts.fetchUnsplash');
    Route::patch('/posts/{post}/visibility', [DashboardPostController::class, 'updateVisibility'])->name('posts.visibility');

    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('settings.destroy');

    Route::get('/private-posts', [UserController::class, 'private'])->name('user.dashboard.private');
    Route::get('/trash', [UserController::class, 'trash'])->name('user.dashboard.trash');
});

// Admin Routes
Route::middleware(['auth', 'adminMiddleware'])->prefix('admin/dashboard')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
