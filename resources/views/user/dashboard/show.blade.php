@extends('user.layouts.app')

@section('title')
    Dashboard-{{ $post->title }}
@endsection

@section('content')
    <div class="flex p-6 bg-white dark:bg-background-foreground rounded-sm shadow-md font-benne">
        <div class="flex flex-col w-full max-w-2xl mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 mb-2 font-bebas-neue tracking-wider">Single Post</h1>
            <span class="inline-flex items-center gap-1 text-gray-500 mb-4">
                <a href="/dashboard" class="hover:text-primary">
                    Dashboard
                </a>
                <x-ri-arrow-right-double-fill class="w-4 h-4 pb-1" />
                <a href="/dashboard/posts" class="hover:text-primary">
                    Posts
                </a>
                <x-ri-arrow-right-double-fill class="w-4 h-4 pb-1" />
                {{ $post->title }}
            </span>

            <div class="flex items-center mb-4 gap-x-2 font-medium text-sm text-gray-800">
                <a href="/dashboard/posts"
                    class="inline-flex items-center px-2 py-1.5 gap-1 bg-primary/80 rounded-sm hover:bg-primary shadow-sm">
                    <x-heroicon-o-arrow-uturn-left class="w-4 h-4 mb-1" />
                    Back to All My Posts
                </a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit"
                    class="inline-flex items-center px-2 py-1.5 gap-1 bg-yellow-400 rounded-sm hover:bg-yellow-500 shadow-sm">
                    <x-heroicon-o-pencil-square class="w-4 h-4 mb-1" />
                    Edit
                </a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="POST"
                    class="inline-flex items-center px-2 py-1.5 gap-1 bg-red-400 rounded-sm hover:bg-red-500 shadow-sm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="flex items-center gap-1">
                        <x-heroicon-o-trash class="w-4 h-4 mb-1" />
                        Delete
                    </button>
                </form>
            </div>

            <div class="flex flex-col gap-y-4 mb-4">
                <div class="h-30 max-w-40">
                    @if ($post->cover_image)
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                            class="object-cover w-full h-full" />
                    @elseif (isset($imageUrl))
                        <img src="{{ $imageUrl }}" alt="unsplashAPI-{{ $post->category->name }}"
                            class="object-cover w-full h-full" />
                    @else
                        <p>image not found or error fetch api unsplash</p>
                    @endif
                </div>
                <div class="flex flex-col gap-0.5">
                    <h2 class="text-base font-bebas-neue tracking-wider font-medium text-gray-800">Title</h2>
                    <p class="text-gray-600">{{ $post->title }}</p>
                </div>
                <div class="flex flex-col gap-0.5">
                    <h2 class="text-base font-bebas-neue tracking-wider font-medium text-gray-800">Created At</h2>
                    <p class="text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex flex-col gap-0.5">
                    <h2 class="text-base font-bebas-neue tracking-wider font-medium text-gray-800">Content</h2>
                    <p class="text-gray-600">{!! $post->body !!}</p>
                </div>
                <div class="flex flex-col gap-0.5">
                    <h2 class="text-base font-bebas-neue tracking-wider font-medium text-gray-800">Category</h2>
                    <p class="text-gray-600">{{ $post->category->name }}</p>
                </div>
                <div class="flex flex-col gap-0.5">
                    <h2 class="text-base font-bebas-neue tracking-wider font-medium text-gray-800">Status</h2>
                    <p class="text-gray-600 first-letter:uppercase">{{ $post->status }}</p>
                </div>
            </div>
        </div>
    @endsection
