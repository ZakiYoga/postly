@extends('user.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    {{-- Alert Success --}}
    @if (session('success'))
        <x-alert type="success" title="Sukses!" :duration="3000">
            {{ session('success') }}
        </x-alert>
    @endif

    <!-- Welcome Section -->
    @include('user.layouts.welcome')

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Stat Card 1 -->
        <x-stat-card value="0" label="Your Public Posts added" color="red" icon="heroicon-o-fire" />

        <!-- Stat Card 2 -->
        <x-stat-card value="0" label="Your post draft" color="blue" icon="carbon-document-protected" />

        <!-- Stat Card 3 -->
        <x-stat-card value="0" label="Total Like" color="yellow" icon="heroicon-o-hand-thumb-up" />

        <!-- Stat Card 4 -->
        <x-stat-card value="2.9k" label="Total Comment" color="pink" icon="heroicon-o-chat-bubble-left-ellipsis" />
    </div>

    <!-- Posts Section -->
    <div class="bg-white dark:bg-background-foreground rounded-sm shadow p-6">
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
                            <div class="md:h-30 md:max-w-40">
                                @if ($post->cover_image)
                                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                                        class="object-cover w-full h-full" />
                                @else
                                    <img src="https://source.unsplash.com/featured/?{{ urlencode($post->category->name) }}"
                                        alt="unsplashAPI-{{ $post->category->name }}" class="object-cover w-full h-full" />
                                @endif

                            </div>
                            <div class="flex w-full flex-col max-w-sm">
                                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                <a href="/dashboard/posts/{{ $post->slug }}"
                                    class="font-medium text-lg text-gray-800 hover:text-[{{ $post->category->color }}]">{{ $post->title }}</a>
                                <p class="text-base text-gray-500 mt-1">
                                    {{ Str::limit($post->body, 100, '...') }}
                                </p>
                                <span
                                    class="inline-flex w-fit text-sm mt-1 p-1.5 text-[{{ $post->category->color }}] bg-[{{ $post->category->color }}]/15 group-hover:text-white group-hover:bg-[{{ $post->category->color }}]">
                                    <x-css-tag class="w-4 h-4 mr-1.5" />
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </div>

                        <div class="flex w-full items-center md:max-w-fit space-x-2 mt-2 md:mt-0">
                            <div class="flex items-center font-sans gap-1 text-gray-500">
                                <x-heroicon-o-hand-thumb-up class="w-6 h-6" />
                                {{ $post->likes_count ?? 0 }}
                            </div>
                            <div class="flex items-center font-sans gap-1 text-gray-500">
                                <x-heroicon-o-chat-bubble-left-ellipsis class="w-6 h-6" />
                                {{ $post->comments_count ?? 0 }}
                            </div>
                            <span
                                class="text-sm px-2 py-1 rounded cursor-default first-letter:uppercase
                                {{ $post->visibility == 'public' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600' }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
                <div class="flex justify-center mt-2">
                    <a href="/dashboard/posts"
                        class="inline-flex items-center font-medium px-4 py-2 text-sm text-gray-600 hover:text-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:text-primary">
                        View All Posts ({{ $postCount }})</a>
                </div>
            @endif
        </div>
    </div>
@endsection
