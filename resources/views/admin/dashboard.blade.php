{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('user.layouts.app')

@section('title')
    Dashboard Admin
@endsection

@section('content')
    {{-- Alert Success --}}
    @if (session('success'))
        <x-alert type="success" title="Success!">
            {{ session('success') }}
        </x-alert>
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

    <!-- Posts Section -->
    <div class="bg-white dark:bg-background-foreground rounded-sm shadow p-6 pb-2">
        <div class="flex flex-col gap-y-1 w-fit">
            <span class="bg-primary w-[20%] h-1"></span>
            <h3 class="text-xl font-semibold text-gray-800 font-bebas-neue tracking-wider mb-4">Latest My Post</h3>
        </div>

        <div class="space-y-2">
            {{-- @foreach ($posts as $post)
                <!-- Posts -->
                <div
                    class="flex border-b py-2 w-full border-gray-200 items-center flex-col md:flex-row justify-start md:justify-between group hover:bg-gray-50/50 transition duration-200 ease-in-out">
                    <div class="flex w-full flex-col md:flex-row items-start space-x-3">
                        <div class="md:h-30 md:max-w-40">
                            @if ($post->cover_image)
                                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="article-1"
                                    class="object-cover w-full h-full" />
                            @else
                                <img src="/images/article-1.png" alt="article-1" class="object-cover w-full h-full" />
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
                                {{ $post->status == 'published'
                                    ? 'bg-blue-100 text-blue-600'
                                    : ($post->status == 'draft'
                                        ? 'bg-orange-100 text-orange-600'
                                        : ($post->status == 'private'
                                            ? 'bg-gray-100 text-gray-600'
                                            : '')) }}">
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
            --}}
        </div>
    </div>
@endsection
