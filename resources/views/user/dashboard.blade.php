@extends('user.layouts.app')

<x-slot:title>{{ $title }}</x-slot:title>

@section('content')
<!-- Welcome Section -->
@include('user.layouts.welcome')

<h2 class="font-bebas-neue tracking-wider text-xl md:text-2xl ml-0.5 text-gray-800 dark:text-white mb-2">Overview</h2>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Stat All Posts -->
    <x-stat-card value="{{ $posts->count() }}" label="Your All Posts added" color="red" icon="heroicon-o-fire" />

    <!-- Stat Public Posts -->
    <x-stat-card value="0" label="Your Public Posts" color="blue" icon="heroicon-o-document-text" />

    <!-- Stat Like -->
    <x-stat-card value="{{ $posts->sum('likes_count') }}" label="Total Like All Posts" color="pink" icon="eva-heart" />

    <!-- Stat Comment -->
    <x-stat-card value="{{ $posts->sum('comments_count') }}" label="Total Comment All Posts" color="yellow" icon="eva-message-square-outline" />
</div>

<!-- Posts Section -->
<div class="bg-white dark:bg-slate-900 rounded-sm shadow-sm p-6">
    <x-heading>
        Latest Posts
    </x-heading>

    <div class="space-y-2">
        @if ($posts->isEmpty())
        <div class="flex items-center justify-center">
            <p class="text-gray-500">No posts found.</p>
        </div>
        @else
        @foreach ($posts->take(4) as $post)
        <!-- Posts -->
        <div class="flex border-b py-2 border-gray-200 dark:border-gray-500 rounded-xs w-full items-center flex-col md:flex-row justify-start md:justify-between group hover:bg-gray-50/50 dark:hover:bg-gray-800/20 transition duration-200 ease-in-out">
            <div class="flex w-full flex-col md:flex-row items-start gap-x-3 gap-y-4">
                <div class="w-full rounded-xs overflow-hidden h-32 lg:min-w-44 md:max-w-44">
                    @if ($post->cover_image)
                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="object-cover object-center w-full h-full" />
                    @elseif ($post->unsplash_image_url)
                    <img src="{{ $post->unsplash_image_url }}" alt="unsplashAPI-{{ $post->category->name }}" class="object-cover object-center w-full h-full" />
                    @else
                    <div class="w-full h-full object-cover bg-gray-200 text-gray-500 dark:bg-gray-800 dark:text-gray-300 flex items-center justify-center">
                        <span class="font-bebas-neue text-lg tracking-wider">No Featured Image</span>
                    </div>
                    @endif
                </div>
                <div class="flex w-full flex-col lg:max-w-md xl:max-w-lg">
                    <div class="inline-flex items-center justify-between md:justify-start gap-x-4 font-bebas-neue tracking-wider leading-4 text-sm text-gray-500 dark:text-gray-400">
                        <span id="categoryTag" href="/posts?category={{ $post->category->slug }}" class="w-fit inline-flex items-center category-title" style="--text-category: {{ $post->category->color }};">
                            <x-css-tag class="w-4 h-4 mr-1.5 -rotate-45" />
                            {{ $post->category->name }}
                        </span>

                        <div class="inline-flex items-center gap-1">
                            <x-heroicon-o-calendar-date-range class="w-5 h-5 mb-0.5" />
                            <p>{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <a href="/dashboard/posts/{{ $post->slug }}" style="--text-category-hover: {{ $post->category->color }}" class="category-title font-medium text-lg text-gray-800 dark:text-gray-100">
                        {{ $post->title }}
                    </a>
                    <p class="text-base text-gray-500 dark:text-gray-400 mt-1">
                        {!! Str::limit($post->body, 150, '...') !!}
                    </p>
                </div>
            </div>

            <div class="flex w-full items-center md:max-w-fit space-x-2 mt-2 md:mt-0 font-bebas-neue md:mr-2">
                <span class="text-sm px-2 py-1 rounded traking-wider
                                {{ $post->visibility == 'public' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600' }}">
                    {{ ucfirst($post->visibility) }}
                </span>
                <div class="flex items-center gap-1 text-red-500">
                    <x-eva-heart class="w-5 h-5" />
                    {{ $post->likes_count ?? 0 }}
                </div>
                <div class="flex items-center gap-1 text-gray-500">
                    <x-eva-message-square-outline class="w-5 h-5" />
                    {{ $post->comments_count ?? 0 }}
                </div>
            </div>
        </div>
        @endforeach
        @endif
        @if ($posts->count() > 4)
        <div class="flex justify-center pt-3 mt-2">
            <a href="/dashboard/posts" class="inline-flex items-center font-medium px-4 py-2 text-sm text-gray-600 dark:text-gray-200 hover:text-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:text-primary">
                View All Posts ({{ $posts->count() }})</a>
        </div>
        @endif
    </div>
</div>
@endsection
