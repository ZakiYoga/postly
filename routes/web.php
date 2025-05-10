<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('homepage', [
        'title' => 'Homepage',
        'posts' => Post::latest()->get(),
        'categories' => Category::all(),
    ]);
});

Route::get('/about', function () {
    return view('aboutpage', [
        'title' => 'About',
        'nama' => 'Zaki Satria'
    ]);
});

Route::get('/posts', function () {
    return view('postspage', [
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
    return view('postpage ', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user) {
    return view('postspage ', [
        'title' => 'Article by ' . $user->name,
        'description' => 'Found ' . count($user->posts) . ' article by ' . $user->name,
        'posts' => $user->posts
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('postspage ', [
        'title' => 'Article in ' . $category->name,
        'description' => 'Found ' . count($category->posts) . ' article in ' . $category->name,
        'posts' => $category->posts
    ]);
});

Route::get('/contact', function () {
    return view('contactpage', [
        'title' => 'Contact'
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Check Slug
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

// User Routes
Route::middleware(['auth', 'userMiddleware'])->prefix('dashboard')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
    Route::resource('/posts', DashboardPostController::class);
});

// Admin Routes
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
