@extends('user.layouts.app')

@section('title')
    Dashboard - Private Posts
@endsection

@section('content')
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => '/dashboard'], ['label' => 'Private']]" />

    <div class="bg-white dark:bg-background-foreground rounded-sm shadow p-6">
        <x-heading>
            My Private Posts
        </x-heading>

        <div class="space-y-2">
            {{-- @foreach ($posts as $post)
                <!-- Posts -->
                <div
                    class="flex border-b py-2 border-gray-200 items-center justify-between group hover:bg-gray-50/50 transition duration-200 ease-in-out">
                    <div class="flex items-start space-x-3">
                        <div class="h-30 max-w-40">
                            <img src="/images/article-1.png" alt="article-1" class="object-cover w-full h-full" />
                        </div>
                        <div class="flex flex-col max-w-sm">
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
                        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="text-gray-400 hover:text-yellow-400">
                            <x-far-pen-to-square class="h-6 w-6" />
                        </a>
                        <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')"
                                class="text-gray-400 hover:text-red-600">
                                <x-heroicon-o-trash class="h-7 w-7" />
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach --}}
        </div>
    </div>
@endsection
