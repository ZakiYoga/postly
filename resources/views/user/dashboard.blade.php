@extends('user.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    {{-- Alert --}}
    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <!-- Welcome Section -->
    @include('user.layouts.welcome')

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Stat Card 1 -->
        <x-stat-card value="20" label="Your Public Posts added" color="red" icon="heroicon-o-fire" />

        <!-- Stat Card 2 -->
        <x-stat-card value="3" label="Your post draft" color="blue" />
        {{-- <x-heroicon-o-archive-box class="w-6 h-6" /> --}}

        <!-- Stat Card 3 -->
        <x-stat-card value="1.7k" label="Total Like" color="yellow" />
        {{-- <x-heroicon-o-hand-thumb-up class="w-6 h-6" /> --}}

        <!-- Stat Card 4 -->
        <x-stat-card value="2.9k" label="Total Comment" color="pink" />
    </div>

    <!-- Projects Section -->
    <div class="bg-white dark:bg-background-foreground rounded-sm shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-2 font-bebas-neue tracking-wider">Recent Projects</h3>

        @foreach ($posts as $post)
            <!-- Project -->
            <div class="border-b border-gray-200 pb-4 mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-start space-x-3">
                        <div class="h-30 max-w-40">
                            <img src="/images/article-1.png" alt="article-1" class="object-cover w-full h-full" />
                        </div>
                        <div class="flex flex-col max-w-md">
                            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            <h4 class="font-medium text-lg text-gray-800 ">{{ $post->title }}</h4>
                            <p class="text-base text-gray-500 mt-1">
                                {{ Str::limit($post->body, 110, '...') }}
                            </p>
                            <span
                                class="inline-flex w-fit text-sm mt-1 p-2 text-[{{ $post->category->color }}] bg-[{{ $post->category->color }}]/15 group-hover:bg-[{{ $post->category->color }}]">
                                <x-css-tag class="w-4 h-4 mr-1.5" />
                                {{ $post->category->name }}
                            </span>
                            <div class="inline-flex gap-2">
                                <div class="flex items-center font-sans gap-1 text-gray-500 mt-2">
                                    <x-heroicon-o-hand-thumb-up class="w-6 h-6" />
                                    {{ $post->likes_count ?? 0 }}
                                </div>
                                <div class="flex items-center font-sans gap-1 text-gray-500 mt-2">
                                    <x-heroicon-o-chat-bubble-left-ellipsis class="w-6 h-6" />
                                    {{ $post->comments_count ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <span
                            class="text-sm px-2 py-1 rounded cursor-default first-letter:uppercase
                            {{ $post->status == 'published'
                                ? 'bg-blue-100 text-blue-600'
                                : ($post->status == 'draft'
                                    ? 'bg-orange-100 text-orange-600'
                                    : ($post->status == 'private'
                                        ? 'bg-gray-100 text-gray-600'
                                        : '')) }}">
                            {{ ucfirst($post->status) }}
                        </span>
                        <button class="text-gray-400 hover:text-gray-600">
                            <x-far-pen-to-square class="h-6 w-6" />
                        </button>
                        <button class="text-gray-400 hover:text-gray-600">
                            <x-heroicon-o-trash class="h-7 w-7" />
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
