@extends('layouts.dashboard.app')

@section('title')
Dashboard-{{ $post->title }}
@endsection

@section('content')
<x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => '/dashboard'],
        ['label' => 'My Posts', 'url' => '/dashboard/posts'],
        ['label' => $post->slug],
    ]" />

<div class="flex p-6 bg-white dark:bg-slate-900 rounded-sm shadow-md font-benne">
    <div class="flex flex-col w-full max-w-2xl mx-auto">

        <x-heading>
            My Private Posts
        </x-heading>

        <div class="flex items-center mb-4 gap-x-2 font-medium text-sm text-gray-800">
            <a href="/dashboard/posts" class="inline-flex items-center px-2 py-1.5 gap-1 bg-primary/80 rounded-sm hover:bg-primary shadow-sm">
                <x-heroicon-o-arrow-uturn-left class="w-4 h-4 mb-1" />
                Back to All My Posts
            </a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="inline-flex items-center px-2 py-1.5 gap-1 bg-yellow-400 rounded-sm hover:bg-yellow-500 shadow-sm">
                <x-heroicon-o-pencil-square class="w-4 h-4 mb-1" />
                Edit
            </a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="inline-flex items-center px-2 py-1.5 gap-1 bg-red-400 rounded-sm hover:bg-red-500 shadow-sm">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')" class="flex items-center gap-1">
                    <x-heroicon-o-trash class="w-4 h-4 mb-1" />
                    Delete
                </button>
            </form>
        </div>

        <div class="flex flex-col gap-y-4 mb-4 ">
            <div class="w-full max-w-sm aspect-video max-h-48 md:max-h-64 md:max-w-lg text-base font-bebas-neue tracking-wider font-medium text-gray-800 dark:text-gray-100">
                @if ($post->cover_image)
                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="object-cover object-center w-full h-full" />
                @elseif ($post->unsplash_image_url)
                <img src="{{ $post->unsplash_image_url }}" alt="unsplashAPI-{{ $post->category->name }}" class="object-cover object-center w-full h-full" />
                @else
                <div class="w-full h-full object-cover bg-gray-200 text-gray-500 flex items-center justify-center">
                    <span class="font-bebas-neue text-lg tracking-wider">No Featured Image</span>
                </div>
                @endif
            </div>
            <div class="flex flex-col gap-0.5">
                <h2 class="">Title</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ $post->title }}</p>
            </div>
            <div class="flex flex-col gap-0.5">
                <h2 class="">Created At</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ $post->created_at->diffForHumans() }}</p>
            </div>
            <div class="flex flex-col gap-0.5">
                <h2 class="">Content</h2>
                <p class="text-gray-600 dark:text-gray-400">{!! $post->body !!}</p>
            </div>
            <div class="flex flex-col gap-0.5">
                <h2 class="">Category</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ $post->category->name }}</p>
            </div>
            <div class="flex flex-col gap-0.5">
                <h2 class="">Visibility</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ ucfirst($post->visibility) }}</p>
            </div>
            <div class="flex flex-col gap-0.5">
                <h2 class="">Like Count</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ $post->comments_count ?? 0 }}</p>
            </div>
            @foreach ($post->comments as $comment)
            <div class="mb-4 shadow-sm">
                {{-- Comment Header --}}
                <div class="flex items-center mb-2">
                    <div class="w-8 h-8 flex items-center justify-center mr-3">
                        <span class="text-sm font-semibold text-gray-600">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $comment->user->name }}</h4>
                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Comment Content --}}
                <div class="ml-11">
                    <p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
                </div>

                {{-- Comment Actions --}}
                <div class="ml-11 mt-3 flex items-center space-x-4">
                    <button class="text-sm text-gray-500 hover:text-blue-600 transition-colors">
                        Like
                    </button>
                    <button class="text-sm text-gray-500 hover:text-blue-600 transition-colors">
                        Reply
                    </button>
                </div>

                {{-- Replies Section --}}
                @if($comment->replies->count() > 0)
                <div class="mt-4 ml-11 space-y-3">
                    @foreach ($comment->replies as $reply)
                    <div class="border-l-4 border-blue-200 rounded-r-lg p-3">
                        {{-- Reply Header --}}
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center mr-2">
                                <span class="text-xs font-semibold text-white">
                                    {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-700 text-sm">{{ $reply->user->name }}</h5>
                                <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        {{-- Reply Content --}}
                        <div class="ml-8">
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $reply->content }}</p>
                        </div>

                        {{-- Reply Actions --}}
                        <div class="ml-8 mt-2 flex items-center space-x-3">
                            <button class="text-xs text-gray-400 hover:text-blue-500 transition-colors">
                                Like
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endsection
