<x-layout>
    <x-slot:title>{{ $title ?? 'Blog' }}</x-slot:title>
    <section class="w-full h-fit my-4 lg:my-6 mx-auto px-6 sm:px-8 md:px-10 lg:px-16">
        <div
            class="mx-auto w-full rounded-sm text-center py-6 lg:py-8 px-4 lg:px-8 lg:mb-6 mb-4 bg-white border border-gray-200 shadow-md dark:bg-gray-900 dark:border-gray-700">
            <h2
                class="mb-2 text-2xl font-bebas-neue tracking-wider lg:text-4xl font-semibold text-gray-900 dark:text-white">
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
                <p class="inline-flex items-center mt-4 text-gray-500 dark:text-gray-400 first-letter:uppercase">
                    <a href="/" class="hover:text-primary focus:text-primary">
                        Homepage
                    </a>
                    <x-ri-arrow-right-double-fill class="w-4 h-4 pb-0.5" />
                    <a href="/posts" class="hover:text-primary focus:text-primary">
                        Posts
                    </a>
                    <x-ri-arrow-right-double-fill class="w-4 h-4 pb-1" />
                    @if (request('category'))
                        {{ ucfirst(request('category')) }}
                    @elseif (request('author'))
                        {{ ucfirst(request('author')) }}
                    @elseif (request('search'))
                        Search
                    @endif
                </p>
            @else
                <p class="font-light text-gray-500 text-lg dark:text-gray-400">
                    {{ $description }}
                </p>
            @endif
        </div>
        @if (request('category') || request('search') || request('author'))
            <p class="text-gray-500 dark:text-white my-4 leading-4">
                Found {{ $count }} {{ Str::plural('article', $count) }}
                @if (request('category'))
                    in <span class="text-gray-600 font-bold">"{{ request('category') }}"</span>
                @endif
                @if (request('author'))
                    by <span class="text-gray-600 font-bold">"{{ request('author') }}"</span>
                @endif
                @if (request('search'))
                    matching <span class="text-gray-600 font-bold">"{{ request('search') }}"</span>
                @endif
            </p>
        @else
            <div></div>
        @endif


        <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article
                    class="p-6 h-full max-h-fit bg-white border rounded-sm border-gray-200 shadow-md dark:bg-gray-900 dark:border-gray-700 group relative overflow-hidden">

                    <div
                        class="absolute top-0 left-0 w-full h-[35%] group-hover:h-[100%] transition-all duration-500 ease-in-out overflow-hidden">
                        <div class="shadow-gradient">
                            <img src="{{ assert() }}" alt="article"
                                class="w-full h-auto group-hover:scale-105 transition-transform duration-500 ease-in-out">
                        </div>
                    </div>

                    <div
                        class="relative flex flex-col h-75 z-10 transition-all duration-500 mt-[45%] group-hover:mt-[44%] sm:group-hover:mt-[43%] md:group-hover:mt-[42%]">
                        <div class="flex justify-between items-center my-2 text-gray-500 dark:text-gray-400">
                            <a id="categoryTag text-sm md:text-base" href="/posts?category={{ $post->category->slug }}"
                                class="category-tag rounded-xs xl:text-base px-2.5 py-2"
                                style="--bg-category: @hexToRgba($post->category->color, 0.1) }}; --bg-category-hover: {{ $post->category->color }};">
                                {{ $post->category->name }}
                            </a>
                            <span class="flex font-bebas-neue transition-color duration-300 group-hover:text-white">
                                @include('components.like-button', ['post' => $post])
                                <div class="inline-flex items-center gap-1">
                                    <x-eva-message-square-outline class="w-5 h-5 inline-block" />
                                    {{ $post->comments_count }}
                                </div>
                            </span>
                        </div>
                        <a href="/posts/{{ $post->slug }}" class="lg:mt-1">
                            <h2 class="category-title font-semibold text-xl lg:text-2xl"
                                style="--text-category-hover: {{ $post->category->color }}">
                                {{ ucfirst($post->title) }}
                            </h2>
                        </a>
                        <p class="mb-4 text-sm sm:text-base text-gray-500 dark:text-gray-400">
                            {!! Str::limit($post->body, 120) !!}
                        </p>
                        <div class="flex mt-auto justify-between items-center">
                            <div class="inline-flex gap-x-2">
                                <x-user-avatar :user="$post->author" size="w-9 h-9" class="rounded-sm" />
                                <div class="flex flex-col gap-0.5">
                                    <a class="text-sm font-bebas-neue text-gray-900 dark:text-gray-300 hover:underline"
                                        href="/posts?author={{ $post->author->username }}">
                                        {{ $post->author->username }}
                                    </a>
                                    <p class="text-xs text-gray-500 dark:text-gray-300">
                                        {{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <a href="/posts/{{ $post->slug }}"
                                class="inline-flex gap-2 tracking-wider text-sm items-center font-bebas-neue font-medium text-primary-600 dark:text-primary-500 hover:underline dark:text-white group-hover:text-[{{ $post->category->color }}]">
                                Read more
                                <x-fas-arrow-right
                                    class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-600" />
                            </a>
                        </div>
                    </div>
                </article>

            @empty
                <div
                    class="flex flex-col items-center justify-center col-span-3 p-6 min-h-[30vh] bg-white border border-gray-200 shadow-md dark:bg-gray-900 dark:border-gray-700">
                    <p class="text-xl text-gray-800 dark:text-white">
                        Stay tuned for upcoming posts!
                    </p>
                    @if (request('search') || request('category') || request('author'))
                        <a href="/posts"
                            class="inline-flex justify-start mt-auto mr-auto font-bebas-neue items-center gap-2 px-3 py-2 bg-primary hover:bg-primary/80 text-gray-900 shadow-md">
                            <x-fas-arrow-left class="w-4 h-4 pb-0.5" />
                            Back to All Posts
                        </a>
                    @endif

                </div>
            @endforelse
        </div>

        {{ $posts->links() }}
    </section>
</x-layout>
