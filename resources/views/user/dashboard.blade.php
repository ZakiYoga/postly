@extends('user.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Welcome Section -->
    @include('user.layouts.welcome')

    <h2 class="font-bebas-neue tracking-wider ml-0.5 text-gray-800 dark:text-white mb-2">Overview</h2>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Stat Card 1 -->
        <x-stat-card value="{{ $posts->count() }}" label="Your All Posts added" color="red" icon="heroicon-o-fire" />

        <!-- Stat Card 2 -->
        <x-stat-card value="0" label="Your Public Posts" color="blue" icon="heroicon-o-document-text" />

        <!-- Stat Card 3 -->
        <x-stat-card value="0" label="Total Like" color="pink" icon="eva-heart" />

        <!-- Stat Card 4 -->
        <x-stat-card value="2.9k" label="Total Comment" color="yellow" icon="eva-message-square-outline" />
    </div>

    <!-- Posts Section -->
    <div class="bg-white dark:bg-background-foreground rounded-sm shadow-sm p-6">
        <x-heading>
            Latest Posts
        </x-heading>

        <div class="space-y-2">
            @if ($posts->isEmpty())
                <div class="flex items-center justify-center">
                    <p class="text-gray-500">No posts found.</p>
                </div>
            @else
                @foreach ($posts as $post)
                    <!-- Posts -->
                    <div
                        class="flex border-b py-2 w-full border-gray-200 items-center flex-col md:flex-row justify-start md:justify-between group hover:bg-gray-50/50 transition duration-200 ease-in-out">
                        <div class="flex w-full flex-col md:flex-row items-start space-x-3">
                            <div class="min-w-36 h-32 lg:min-w-44 max-w-44">
                                @if ($post->cover_image)
                                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                                        class="object-cover object-center w-full h-full" />
                                @elseif ($post->unsplash_image_url)
                                    <img src="{{ $post->unsplash_image_url }}" alt="unsplashAPI-{{ $post->category->name }}"
                                        class="object-cover object-center w-full h-full" />
                                @else
                                    <div
                                        class="w-full h-full object-cover bg-gray-200 text-gray-500 flex items-center justify-center">
                                        <span class="font-bebas-neue text-lg tracking-wider">No Preview Image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex w-full flex-col max-w-sm">
                                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                <a href="/dashboard/posts/{{ $post->slug }}"
                                    class="font-medium text-lg text-gray-800 hover:text-[{{ $post->category->color }}]">{{ $post->title }}</a>
                                <p class="text-base text-gray-500 mt-1">
                                    {!! Str::limit($post->body, 100, '...') !!}
                                </p>
                                <span
                                    class="inline-flex w-fit text-sm mt-1 p-1.5 text-[{{ $post->category->color }}] bg-[{{ $post->category->color }}]/15 group-hover:text-white group-hover:bg-[{{ $post->category->color }}]">
                                    <x-css-tag class="w-4 h-4 mr-1.5" />
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </div>

                        <div class="flex w-full items-center md:max-w-fit space-x-2 mt-2 md:mt-0 font-bebas-neue">
                            <span
                                class="text-sm px-2 py-1 rounded traking-wider
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
                <div class="flex justify-center mt-2">
                    <a href="/dashboard/posts"
                        class="inline-flex items-center font-medium px-4 py-2 text-sm text-gray-600 hover:text-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:text-primary">
                        View All Posts ({{ $posts->count() }})</a>
                </div>
            @endif
        </div>
    </div>
@endsection
