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
                <p class="mt-4 inline-flex items-center text-gray-500 first-letter:uppercase dark:text-gray-400">
                    <a href="/" class="hover:text-primary focus:text-primary">
                        Homepage
                    </a>
                    <x-ri-arrow-right-double-fill class="h-4 w-4 pb-0.5" />
                    <a href="/posts" class="hover:text-primary focus:text-primary">
                        Posts
                    </a>
                    <x-ri-arrow-right-double-fill class="h-4 w-4 pb-1" />
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
        @if (request('category') || request('search') || request('author'))
            <p class="my-4 leading-4 text-gray-500 dark:text-white">
                Found {{ $count }} {{ Str::plural('article', $count) }}
                @if (request('category'))
                    in <span class="font-bold text-gray-600">"{{ request('category') }}"</span>
                @endif
                @if (request('author'))
                    by <span class="font-bold text-gray-600">"{{ request('author') }}"</span>
                @endif
                @if (request('search'))
                    matching <span class="font-bold text-gray-600">"{{ request('search') }}"</span>
                @endif
            </p>
        @else
            <div></div>
        @endif


        <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article
                    class="group relative h-full max-h-fit overflow-hidden rounded-sm border border-gray-200 bg-white p-6 shadow-md dark:border-gray-700 dark:bg-gray-900">

                    <div
                        class="absolute left-0 top-0 h-[35%] w-full overflow-hidden transition-all duration-500 ease-in-out group-hover:h-[100%]">
                        <div class="shadow-gradient">
                            @if ($post->cover_image)
                                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                                    class="h-full w-full object-cover object-center" />
                            @elseif ($post->unsplash_image_url)
                                <img src="{{ $post->unsplash_image_url }}"
                                    alt="unsplashAPI-{{ $post->category->name }}"
                                    class="h-full w-full object-cover object-center" />
                            @else
                                <img src="/images/article-1.png" alt="gambarsementara" />
                            @endif
                        </div>
                    </div>

                    <div
                        class="h-75 relative z-10 mt-[45%] flex flex-col transition-all duration-500 group-hover:mt-[44%] sm:group-hover:mt-[43%] md:group-hover:mt-[42%]">
                        <div class="my-2 flex items-center justify-between text-gray-500 dark:text-gray-400">
                            <a href="/posts?category={{ $post->category->slug }}"
                                class="category-tag rounded-xs bg-[var(--bg-category)] px-2 py-1 text-gray-600 group-hover:bg-[var(--bg-category)] group-hover:text-white xl:text-base"
                                style="--bg-category: @hexToRgba($post->category->color, 0.2); --bg-category-group-hover: {{ $post->category->color }};">
                                {{ $post->category->name }}
                            </a>
                            <span class="font-bebas-neue transition-color flex duration-300 group-hover:text-white">
                                <x-like-button :post="$post" unliked-color="group-hover:text-white"
                                    count-unliked-class="group-hover:text-white" />
                                <div class="inline-flex items-center gap-1">
                                    <x-eva-message-square-outline class="inline-block h-5 w-5" />
                                    {{ $post->comments_count }}
                                </div>
                            </span>
                        </div>
                        <a href="/posts/{{ $post->slug }}" class="lg:mt-1">
                            <h2 class="category-title text-xl font-semibold lg:text-2xl"
                                style="--text-category-hover: {{ $post->category->color }}">
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
                                class="font-bebas-neue text-primary-600 dark:text-primary-500 inline-flex items-center gap-2 text-sm font-medium tracking-wider hover:underline group-hover:text-[{{ $post->category->color }}] dark:text-white">
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
                            <x-fas-arrow-left class="h-4 w-4 pb-0.5" />
                            Back to All Posts
                        </a>
                    @endif

                </div>
            @endforelse
        </div>

        {{ $posts->links() }}
    </section>
</x-layout>
