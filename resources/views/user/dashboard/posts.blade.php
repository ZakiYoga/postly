@extends('layouts.dashboard.app')

@section('title')
    Dashboard - MyPosts
@endsection

@section('content')
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => '/dashboard'], ['label' => 'My Posts']]" />

    <div class="rounded-sm bg-white p-4 shadow md:p-6 dark:bg-slate-900">
        <x-heading textClass="text-xl lg:text-2xl">
            My Posts
        </x-heading>

        @forelse ($posts as $post)
            <!-- Posts -->
            <div class="space-y-2">
                <div
                    class="group flex flex-col items-center justify-between border-b border-gray-200 py-2 transition duration-200 ease-in-out hover:bg-gray-50/50 md:flex-row dark:border-gray-500 dark:hover:bg-gray-800/20">
                    <div class="flex w-full flex-col space-x-4 md:flex-row">
                        <div class="h-32 w-full overflow-hidden md:max-w-44 lg:min-w-44">
                            <x-cover-image :image="$post['cover_image']" :title="$post['title']" />
                        </div>
                        <div class="flex w-full flex-col">
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
                            <p class="mt-1 text-base text-gray-500">
                                {!! Str::limit($post->body, 150, '...') !!}
                            </p>
                            <div class="mt-auto inline-flex gap-2">
                                <div class="mt-2 flex items-center gap-1 font-sans text-gray-500">
                                    <x-eva-heart class="h-4 w-4 text-red-500" />
                                    <span>{{ $post->likes_count ?? 0 }}</span>
                                </div>
                                <div class="mt-2 flex items-center gap-1 font-sans text-gray-500 dark:text-gray-400">
                                    <x-eva-message-square-outline class="h-4 w-4" />
                                    {{ $post->comments_count ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="font-bebas-neue mt-4 flex w-full items-center justify-between space-x-2 text-sm tracking-wider md:mr-2 md:mt-0 md:w-fit md:justify-items-start">
                        <form method="POST" action="{{ route('posts.visibility', $post) }}" x-data="{ visibility: '{{ $post->visibility }}' }"
                            class="flex items-center">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="visibility" :value="visibility === 'public' ? '0' : '1'">

                            <button type="submit"
                                @click.prevent="visibility = visibility === 'public' ? 'private' : 'public'; $el.form.submit();"
                                class="relative inline-flex h-8 w-20 items-center justify-center overflow-hidden rounded-full text-sm font-medium shadow-inner transition-colors duration-300"
                                :class="visibility === 'public' ?
                                    'bg-blue-100 text-blue-500' :
                                    'bg-orange-100 text-orange-600'">

                                <span class="absolute right-3 pt-0.5 opacity-0 transition-all duration-300"
                                    :class="visibility === 'public' ? 'opacity-100' : 'opacity-0'">Public</span>
                                <span class="absolute left-3 pt-0.5 opacity-0 transition-all duration-300"
                                    :class="visibility === 'private' ? 'opacity-100' : 'opacity-0'">Private</span>

                                <span
                                    class="absolute left-1/2 h-6 w-6 transform rounded-full bg-white shadow transition-transform duration-300"
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
                <div class="grid w-full place-content-center text-center text-gray-500">
                    <p>Oh no, you don&#39;t have any posts yet.</p>
                    <p>Ready to create your first one?</p>
                </div>
                <a href="/dashboard/posts/create"
                    class="font-bebas-neue bg-primary hover:bg-primary/80 mt-2 rounded-sm px-4 py-2 tracking-wide text-white shadow-md transition duration-200 ease-in-out">
                    Create Post
                </a>
            </div>
        @endforelse
    </div>
    {{ $posts->links() }}
@endsection
