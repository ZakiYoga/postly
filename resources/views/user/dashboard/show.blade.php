@extends('user.layouts.app')

@section('title')
    Dashboard-{{ $post->title }}
@endsection

@section('content')
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => '/dashboard'],
        ['label' => 'My Posts', 'url' => '/dashboard/posts'],
        ['label' => $post->slug],
    ]" />

    <div class="flex p-6 bg-white dark:bg-background-foreground rounded-sm shadow-md font-benne">
        <div class="flex flex-col w-full max-w-2xl mx-auto">

            <x-heading>
                My Private Posts
            </x-heading>

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
                <div class="w-full max-w-sm aspect-video max-h-48 md:max-h-64 md:max-w-lg">
                    @if ($post->cover_image)
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                            class="object-cover object-center w-full h-full" />
                    @elseif ($post->unsplash_image_url)
                        <img src="{{ $post->unsplash_image_url }}" alt="unsplashAPI-{{ $post->category->name }}"
                            class="object-cover object-center w-full h-full" />
                    @else
                        <div class="w-full h-full object-cover bg-gray-200 text-gray-500 flex items-center justify-center">
                            <span class="font-bebas-neue text-lg tracking-wider">No Preview Image</span>
                        </div>
                    @endif
                </div>
                <div class="flex flex-col gap-0.5">
                    <h2 class="text-base font-bebas-neue tracking-wider font-medium text-gray-800">Title</h2>
                    <p class="text-gray-600">{{ $post->title }}</p>
                </div>
                <div class="flex flex-col gap-0.5">
                    <h2 class="text-base font-bebas-neue tracking-wider font-medium text-gray-800">Created At</h2>
                    <p class="text-gray-600">
                        {{ $post->created_at->diffForHumans() }}</p>
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
                    <h2 class="text-base font-bebas-neue tracking-wider font-medium text-gray-800">Visibility</h2>
                    <p class="text-gray-600 first-letter:uppercase">{{ $post->visibility }}</p>
                </div>
                <div class="flex flex-col gap-0.5">
                    <h2 class="text-base font-bebas-neue tracking-wider font-medium text-gray-800">Like Count</h2>
                    <p class="text-gray-600 first-letter:uppercase">{{ $post->like_count }}</p>
                </div>
            </div>
        </div>
    @endsection
