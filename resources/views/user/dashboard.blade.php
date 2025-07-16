@extends('layouts.dashboard.app')

@section('title', $title)

@section('content')
    <!-- Welcome Section -->
    @include('layouts.dashboard.welcome')

    <h2 class="font-bebas-neue mb-2 ml-0.5 text-xl tracking-wider text-gray-800 md:text-2xl dark:text-white">Overview</h2>

    <!-- Stats Overview -->
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
        <!-- Stat All Posts -->
        <x-stat-card value="{{ $posts->count() }}" label="Your All Posts added" color="red" icon="heroicon-o-fire" />

        <!-- Stat Public Posts -->
        <x-stat-card value="0" label="Your Public Posts" color="blue" icon="heroicon-o-document-text" />

        <!-- Stat Like -->
        <x-stat-card value="{{ $posts->sum('likes_count') }}" label="Total Like All Posts" color="pink"
            icon="eva-heart" />

        <!-- Stat Comment -->
        <x-stat-card value="{{ $posts->sum('comments_count') }}" label="Total Comment All Posts" color="yellow"
            icon="eva-message-square-outline" />
    </div>

    <!-- Posts Section -->
    <div class="rounded-sm bg-white p-6 shadow-sm dark:bg-slate-900">
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
                    <div
                        class="rounded-xs group flex w-full flex-col items-center justify-start border-b border-gray-200 py-2 transition duration-200 ease-in-out hover:bg-gray-50/50 md:flex-row md:justify-between dark:border-gray-500 dark:hover:bg-gray-800/20">
                        <div class="flex w-full flex-col items-start gap-x-3 gap-y-4 md:flex-row">
                            <div class="rounded-xs h-32 w-full overflow-hidden md:max-w-44 lg:min-w-44">
                                <x-cover-image :image="$post['cover_image']" :title="$post['title']" size='large' />
                            </div>
                            <div class="flex w-full flex-col lg:max-w-md xl:max-w-lg">
                                <div
                                    class="font-bebas-neue inline-flex items-center justify-between gap-x-4 text-sm leading-4 tracking-wider text-gray-500 md:justify-start dark:text-gray-400">
                                    <span id="categoryTag" href="/posts?category={{ $post->category->slug }}"
                                        class="category-title inline-flex w-fit items-center"
                                        style="--text-category: {{ $post->category->color }};">
                                        <x-css-tag class="mr-1.5 h-4 w-4 -rotate-45" />
                                        {{ $post->category->name }}
                                    </span>

                                    <div class="inline-flex items-center gap-1">
                                        <x-heroicon-o-calendar-date-range class="mb-0.5 h-5 w-5" />
                                        <p>{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <a href="/dashboard/posts/{{ $post->slug }}"
                                    style="--text-category-hover: {{ $post->category->color }}"
                                    class="category-title text-lg font-medium text-gray-800 dark:text-gray-100">
                                    {{ $post->title }}
                                </a>
                                <p class="mt-1 text-base text-gray-500 dark:text-gray-400">
                                    {!! Str::limit($post->body, 150, '...') !!}
                                </p>
                            </div>
                        </div>

                        <div class="font-bebas-neue mt-2 flex w-full items-center space-x-2 md:mr-2 md:mt-0 md:max-w-fit">
                            <span
                                class="traking-wider {{ $post->visibility == 'public' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600' }} rounded px-2 py-1 text-sm">
                                {{ ucfirst($post->visibility) }}
                            </span>
                            <div class="flex items-center gap-1 text-red-500">
                                <x-eva-heart class="h-5 w-5" />
                                {{ $post->likes_count ?? 0 }}
                            </div>
                            <div class="flex items-center gap-1 text-gray-500">
                                <x-eva-message-square-outline class="h-5 w-5" />
                                {{ $post->comments_count ?? 0 }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @if ($posts->count() > 4)
                <div class="mt-2 flex justify-center pt-3">
                    <a href="/dashboard/posts"
                        class="hover:text-primary focus:text-primary inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:text-gray-200">
                        View All Posts ({{ $posts->count() }})</a>
                </div>
            @endif
        </div>
    </div>
@endsection
