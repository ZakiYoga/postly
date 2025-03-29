<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage', [
        'title' => 'Homepage',
        'posts' => Post::latest()->get(),
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
        'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(6)->withQueryString(),
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