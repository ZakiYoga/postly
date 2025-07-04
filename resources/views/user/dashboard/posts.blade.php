@extends('layouts.dashboard.app')

@section('title')
    Dashboard - MyPosts
@endsection

@section('content')
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => '/dashboard'], ['label' => 'My Posts']]" />

    <div class="bg-white dark:bg-slate-900 rounded-sm shadow p-4 md:p-6">
        <x-heading textClass="text-xl lg:text-2xl">
            My Posts
        </x-heading>

        @forelse ($posts as $post)
            <!-- Posts -->
            <div class="space-y-2">
                <div
                    class="flex flex-col md:flex-row border-b py-2 border-gray-200 dark:border-gray-500 items-center justify-between group hover:bg-gray-50/50 dark:hover:bg-gray-800/20 transition duration-200 ease-in-out">
                    <div class="flex w-full flex-col md:flex-row space-x-4">
                        <div class="w-full h-32 lg:min-w-44 md:max-w-44">
                            @if ($post->cover_image)
                                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                                    class="object-cover object-center w-full h-full" />
                            @elseif ($post->unsplash_image_url)
                                <img src="{{ $post->unsplash_image_url }}" alt="unsplashAPI-{{ $post->category->name }}"
                                    class="object-cover object-center w-full h-full" />
                            @else
                                <div
                                    class="w-full h-full object-cover bg-gray-200 text-gray-500 dark:bg-gray-800 dark:text-gray-300 flex items-center justify-center">
                                    <span class="font-bebas-neue text-lg tracking-wider">No Featured Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col w-full">
                            <div
                                class="inline-flex items-center justify-between md:justify-start gap-x-4 font-bebas-neue tracking-wider leading-4 text-sm text-gray-500 dark:text-gray-400">
                                <span id="categoryTag" href="/posts?category={{ $post->category->slug }}"
                                    class="w-fit inline-flex items-center category-title"
                                    style="--text-category: {{ $post->category->color }};">
                                    <x-css-tag class="w-4 h-4 mr-1.5 -rotate-45" />
                                    {{ $post->category->name }}
                                </span>

                                <div class="inline-flex items-center gap-1">
                                    <x-heroicon-o-calendar-date-range class="w-5 h-5 mb-0.5" />
                                    <p>{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <a href="/dashboard/posts/{{ $post->slug }}"
                                style="--text-category-hover: {{ $post->category->color }}"
                                class="category-title font-medium text-lg text-gray-800 dark:text-gray-100">
                                {{ $post->title }}
                            </a>
                            <p class="text-base text-gray-500 mt-1">
                                {!! Str::limit($post->body, 150, '...') !!}
                            </p>
                            <div class="inline-flex gap-2 mt-auto">
                                <div class="flex items-center font-sans gap-1 text-gray-500 mt-2">
                                    <x-eva-heart class="w-4 h-4 text-red-500" />
                                    <span>{{ $post->likes_count ?? 0 }}</span>
                                </div>
                                <div class="flex items-center font-sans gap-1 text-gray-500 dark:text-gray-400 mt-2">
                                    <x-eva-message-square-outline class="w-4 h-4" />
                                    {{ $post->comments_count ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex w-full md:w-fit font-bebas-neue tracking-wider text-sm items-center space-x-2 mt-4 md:mr-2 justify-between md:justify-items-start md:mt-0 ">
                        <form method="POST" action="{{ route('posts.visibility', $post) }}" x-data="{ visibility: '{{ $post->visibility }}' }"
                            class="flex items-center">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="visibility" :value="visibility === 'public' ? '0' : '1'">

                            <button type="submit"
                                @click.prevent="visibility = visibility === 'public' ? 'private' : 'public'; $el.form.submit();"
                                class="relative overflow-hidden shadow-inner inline-flex items-center justify-center rounded-full w-20 h-8 text-sm font-medium transition-colors duration-300"
                                :class="visibility === 'public' ?
                                    'bg-blue-100 text-blue-500' :
                                    'bg-orange-100 text-orange-600'">

                                <span class="absolute right-3 pt-0.5 transition-all duration-300 opacity-0"
                                    :class="visibility === 'public' ? 'opacity-100' : 'opacity-0'">Public</span>
                                <span class="absolute left-3 pt-0.5 transition-all duration-300 opacity-0"
                                    :class="visibility === 'private' ? 'opacity-100' : 'opacity-0'">Private</span>

                                <span
                                    class="absolute left-1/2 w-6 h-6 bg-white rounded-full shadow transform transition-transform duration-300"
                                    :class="visibility === 'public' ? '-translate-x-9' : 'translate-x-3'"></span>
                            </button>
                        </form>
                        <div class="inline-flex gap-2">
                            <a href="/dashboard/posts/{{ $post->slug }}/edit"
                                class="text-gray-400 hover:text-yellow-400">
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
                </div>
            </div>

        @empty
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
        @endforelse
    </div>
    {{ $posts->links() }}
@endsection
