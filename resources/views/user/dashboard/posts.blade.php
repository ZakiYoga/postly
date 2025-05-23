@extends('user.layouts.app')

@section('title')
    Dashboard - MyPosts
@endsection

@section('content')
    {{-- Alert Success --}}
    @if (session('success'))
        <x-alert type="success" title="Sukses!" :duration="3000">
            {{ session(key: 'success') }}
        </x-alert>
    @endif

    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => '/dashboard'], ['label' => 'My Posts']]" />

    <div class="bg-white dark:bg-background-foreground rounded-sm shadow p-4 md:p-6">
        <x-heading>
            My Posts
        </x-heading>

        @if ($posts->isEmpty())
            <div class="flex flex-col items-center justify-center">
                <img src="/images/empty-posts.png" alt="empty" class="max-w-64 object-center text-gray-400" />
                <div class="w-full grid place-content-center text-center text-gray-500">
                    <p>Oh no, you don&#39;t have any posts yet.</p>
                    <p>Ready to create your first one?</p>
                </div>
                <a href="/dashboard/posts/create"
                    class="mt-2 font-bebas-neue tracking-wide px-4 py-2 bg-primary text-white rounded-sm shadow-md hover:bg-primary/80 transition duration-200 ease-in-out">
                    Create Post
                </a>
            </div>
        @else
            <div class="space-y-2">
                @foreach ($posts as $post)
                    <!-- Posts -->
                    <div
                        class="flex flex-col md:flex-row border-b py-2 border-gray-200 items-center justify-between group hover:bg-gray-50/50 transition duration-200 ease-in-out">
                        <div class="block md:flex items-start space-x-4">
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
                            <div class="flex flex-col max-w-sm">
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

                        <div
                            class="flex w-full items-center space-x-2 mt-4 justify-between md:justify-items-start md:mt-0 ">
                            <span
                                class="text-sm px-2 py-1 rounded cursor-default first-letter:uppercase
                                {{ $post->visibility == 'public' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600' }}">
                                {{ ucfirst($post->visibility) }}
                            </span>
                            <div class="inline-flex gap-2">
                                <a href="/dashboard/posts/{{ $post->slug }}/edit"
                                    class="text-gray-400 hover:text-yellow-400">
                                    <x-far-pen-to-square class="h-6 w-6" />
                                </a>
                                <form action="/dashboard/posts/{{ $post->slug }}" method="POST"
                                    class="flex items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="text-gray-400 hover:text-red-600">
                                        <x-heroicon-o-trash class="h-7 w-7" />
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
