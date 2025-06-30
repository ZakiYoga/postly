@php
    $query = request()->except('category', 'category_page');
    $url = count($query) ? url()->current() . '?' . http_build_query($query) : url()->current();
@endphp

<x-layout>
    <x-slot:title>{{ $title ?? 'Blog' }}</x-slot:title>
    <section class="mx-auto my-4 h-fit w-full px-6 sm:px-8 md:px-10 lg:my-6 lg:px-16">
        <div
            class="mx-auto mb-4 w-full rounded-sm border border-gray-200 bg-white px-4 py-6 text-center shadow-md lg:mb-6 lg:px-8 lg:py-8 dark:border-gray-700 dark:bg-gray-900">
            <h2
                class="font-bebas-neue mb-2 text-2xl font-semibold tracking-wider text-gray-900 lg:text-4xl dark:text-white">
                @if (request('category') || request('search') || request('author'))
                    @if (request('category'))
                        Category : {{ request('category') }}
                    @elseif(request('author'))
                        All Posts for "{{ request('author') }}"
                    @elseif(request('search'))
                        Search "{{ request('search') }}"
                    @endif
                @else
                    {{ $heading }}
                @endif
            </h2>
            @if (request('search') || request('category') || request('author'))
                <p
                    class="mt-4 inline-flex items-center leading-4 text-gray-500 first-letter:uppercase dark:text-gray-400">
                    <a href="/" class="hover:text-primary focus:text-primary">
                        Homepage
                    </a>
                    <x-ri-arrow-right-double-fill class="mx-1 h-4 w-4" />
                    <a href="/posts" class="hover:text-primary focus:text-primary">
                        Posts
                    </a>
                    <x-ri-arrow-right-double-fill class="mx-1 h-4 w-4" />
                    @if (request('category'))
                        {{ ucfirst(request('category')) }}
                    @elseif (request('author'))
                        {{ ucfirst(request('author')) }}
                    @elseif (request('search'))
                        Search
                    @endif
                </p>
            @else
                <p class="text-lg font-light text-gray-500 dark:text-gray-400">
                    {{ $description }}
                </p>
            @endif
        </div>

        <div x-data="{ filterOpen: false }">
            {{-- Filter Button --}}
            <div class="mb-4">
                <x-primary-button size="xs" class="gap-1" @click="filterOpen = !filterOpen">
                    <template x-if="!filterOpen">
                        <x-heroicon-o-funnel class="h-5 w-5 dark:text-gray-800" />
                    </template>
                    <template x-if="filterOpen">
                        <x-heroicon-o-x-circle class="h-6 w-6" />
                    </template>
                    <span x-text="filterOpen ? 'Close Filter' : 'Filter'"></span>
                </x-primary-button>
            </div>

            {{-- Filter Section --}}
            <div x-show="filterOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                class="relative mb-6 rounded-sm border border-gray-200 bg-white p-4 py-6 shadow-md dark:border-gray-700 dark:bg-gray-900"
                @click.away="filterOpen = false">
                <form method="GET" action="/posts" class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-3">
                    {{-- Search --}}
                    <div class="relative col-span-1 sm:col-span-1 md:col-span-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center p-2">
                            <x-elemplus-search class="h-6 w-6 text-gray-500 dark:text-gray-400" />
                        </div>
                        <input type="search" id="search" name="search" value="{{ request('search') }}"
                            class="font-bebas-neue focus:ring-primary focus:border-primary dark:focus:ring-primary dark:focus:border-primary block w-full rounded-sm border border-gray-300 bg-gray-50 p-2 pl-9 pt-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            placeholder="Search articles..." autocomplete="off" />
                    </div>

                    {{-- Category --}}
                    <div class="col-span-1 sm:col-span-1 md:col-span-1">
                        <select id="category" name="category"
                            class="font-bebas-neue focus:ring-primary focus:border-primary dark:focus:ring-primary dark:focus:border-primary block w-full rounded-sm border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}"
                                    {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Author --}}
                    <div class="col-span-1 sm:col-span-1 md:col-span-1">
                        <select id="author" name="author"
                            class="font-bebas-neue focus:ring-primary focus:border-primary dark:focus:ring-primary dark:focus:border-primary block w-full rounded-sm border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="">All Authors</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->username }}"
                                    {{ request('author') == $author->username ? 'selected' : '' }}>
                                    {{ $author->name ?? $author->username }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Action Buttons Full Width --}}
                    <div class="col-span-1 flex justify-end gap-2 sm:col-span-1 md:col-span-3">
                        <x-primary-button type="submit" size="xs" class="flex items-center gap-1 leading-4">
                            <x-elemplus-search class="mb-0.5 h-4 w-4" />
                            Filter
                        </x-primary-button>

                        @if (request()->hasAny(['search', 'category', 'author']))
                            <a href="/posts"
                                class="rounded-xs font-bebas-neue active:translate-0.5 inline-flex items-center border bg-gray-300 px-4 py-2 text-xs uppercase tracking-widest shadow-[3px_3px_0px_#000] transition duration-150 ease-in-out hover:bg-gray-400 focus:outline-none active:bg-gray-200 active:shadow-none dark:border-gray-900 dark:text-gray-800 dark:shadow-[2px_2px_0px_#111827] dark:hover:bg-gray-200 dark:active:bg-gray-300">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>


            {{-- Active Filter Display --}}
            @if (request('category') || request('search') || request('author'))
                <p class="my-4 leading-4 text-gray-500 dark:text-white">
                    Found {{ $count }} {{ Str::plural('article', $count) }}
                    @if (request('category'))
                        in <span
                            class="font-bold text-gray-600 first-letter:uppercase">"{{ ucfirst(request('category')) }}"</span>
                    @endif
                    @if (request('author'))
                        by <span
                            class="font-bold text-gray-600 first-letter:uppercase">"{{ ucfirst(request('author')) }}"</span>
                    @endif
                    @if (request('search'))
                        matching <span class="font-bold text-gray-600">"{{ request('search') }}"</span>
                    @endif
                </p>
            @else
                <div></div>
            @endif


            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                {{-- Posts --}}
                @forelse ($posts as $post)
                    <article
                        class="group flex h-full max-h-fit flex-col overflow-hidden rounded-sm border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-900">

                        <div class="h-full w-full bg-red-500 transition-all duration-500 ease-in-out">
                            @if ($post->cover_image)
                                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                                    class="h-full w-full object-cover object-center" />
                            @elseif ($post->unsplash_image_url)
                                <img src="{{ $post->unsplash_image_url }}"
                                    alt="unsplashAPI-{{ $post->category->name }}"
                                    class="h-full w-full object-cover object-center" />
                            @else
                                <img src="/images/article-1.png" alt="gambarsementara"
                                    class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105" />
                            @endif
                        </div>

                        <div class="flex min-h-80 flex-col gap-y-2 px-6 py-4 transition-all duration-500">
                            <div class="flex items-center justify-between text-gray-500 dark:text-gray-400">
                                <a href="/posts?category={{ $post->category->slug }}"
                                    class="category-tag rounded-xs bg-[var(--bg-category)] px-2 py-1 text-gray-600 group-hover:bg-[var(--bg-category)] group-hover:text-white xl:text-base"
                                    style="--bg-category: @hexToRgba($post->category->color, 0.2); --bg-category-group-hover: {{ $post->category->color }};">
                                    {{ $post->category->name }}
                                </a>
                                <span class="font-bebas-neue transition-color flex duration-300">
                                    <x-like-button :post="$post" />
                                    <div class="inline-flex items-center gap-1">
                                        <x-eva-message-square-outline class="inline-block h-5 w-5" />
                                        {{ $post->comments_count }}
                                    </div>
                                </span>
                            </div>
                            <a href="/posts/{{ $post->slug }}">
                                <h2 class="category-title text-lg font-medium text-gray-800 hover:text-[var(--text-category-hover)] dark:text-gray-100"
                                    style="--text-category-group-hover: {{ $post->category->color }};">
                                    {{ ucfirst($post->title) }}
                                </h2>
                            </a>
                            <p class="mb-4 text-sm text-gray-500 sm:text-base dark:text-gray-400">
                                {!! Str::limit($post->body, 120) !!}
                            </p>
                            <div class="mt-auto flex items-center justify-between">
                                <div class="inline-flex gap-x-2">
                                    <x-user-avatar :user="$post->author" size="w-9 h-9" class="rounded-sm" />
                                    <div class="flex flex-col gap-0.5">
                                        <a class="font-bebas-neue text-sm text-gray-900 hover:underline dark:text-gray-300"
                                            href="/posts?author={{ $post->author->username }}">
                                            {{ $post->author->username }}
                                        </a>
                                        <p class="text-xs text-gray-500 dark:text-gray-300">
                                            {{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <a href="/posts/{{ $post->slug }}"
                                    class="font-bebas-neue text-primary dark:text-primary inline-flex items-center gap-2 text-sm font-medium tracking-wider hover:underline group-hover:text-[{{ $post->category->color }}] dark:text-white">
                                    Read more
                                    <x-fas-arrow-right
                                        class="duration-600 mb-0.5 h-3 w-3 transition-all group-hover:rotate-[315deg]" />
                                </a>
                            </div>
                        </div>
                    </article>

                @empty
                    <div
                        class="col-span-3 flex min-h-[30vh] flex-col items-center justify-center border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-900">
                        <p class="text-xl text-gray-800 dark:text-white">
                            Stay tuned for upcoming posts!
                        </p>
                        @if (request('search') || request('category') || request('author'))
                            <a href="/posts"
                                class="font-bebas-neue bg-primary hover:bg-primary/80 mr-auto mt-auto inline-flex items-center justify-start gap-2 px-3 py-2 text-gray-900 shadow-md">
                                <x-fas-arrow-left class="h-" />
                                Back to All Posts
                            </a>
                        @endif

                    </div>
                @endforelse
            </div>

            {{ $posts->links() }}
    </section>
</x-layout>
