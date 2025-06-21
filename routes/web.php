<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontPostController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\User\DashboardPostController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

Route::get('/', [FrontPostController::class, 'homepage'])->name('front.homepage');
Route::get('/about', [FrontPostController::class, 'about'])->name('front.aboutpage');
Route::get('/contact', [FrontPostController::class, 'contact'])->name('front.contactpage');
Route::view('/privacy-policy', 'front.privacy-policy')->name('privacy.policy');

Route::get('/posts', [FrontPostController::class, 'index'])->name('front.index');
Route::get('/posts/{post:slug}', [FrontPostController::class, 'show'])->name('front.show');
Route::get('/author/{user:username}', [FrontPostController::class, 'author'])->name('front.authorpage');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

Route::middleware('auth')->group(function () {
    Route::post('/posts/{post:slug}/like', [LikeController::class, 'toggle'])->name('posts.like.toggle');

    Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])->name('post.comments.store');
    Route::delete('/posts/comments/{comment}', [CommentController::class, 'destroy'])->name('post.comments.destroy');
});

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

    Route::get('/archive', [UserController::class, 'archive'])->name('user.dashboard.archive');
    Route::get('/trash', [UserController::class, 'trash'])->name('user.dashboard.trash');
});

// Admin Routes
Route::middleware(['auth', 'adminMiddleware'])->prefix('admin/dashboard')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/settings', [ProfileController::class, 'edit'])->name('admin.settings.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('admin.settings.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('admin.settings.destroy');
});

Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete')->middleware('auth');

require __DIR__ . '/auth.php';