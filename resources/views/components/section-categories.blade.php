@props(['allPosts'])

<section class="h-fit mt-8 px-4 sm:px-6 md:px-8 lg:px-16">
    <div
        class="flex item-center p-8 flex-col gap-4 w-full h-full min-h-[80vh] bg-white/95 dark:bg-gray-900 dark:text-gray-200">
        <div class="flex w-full justify-between items-center">
            <x-heading>Categories</x-heading>
            <div>
                <a href="/posts"
                    class="font-bebas-neue hover:underline-offset-2 hover:underline hover:text-primary tracking-wide">View
                    All</a>
            </div>
        </div>

        <div class="relative w-full">
            <button
                class="prev absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 dark:bg-gray-800 p-2 rounded-full shadow-lg z-10 hover:bg-primary hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>

            <div
                class="slider-wrapper flex items-center min-h-[60px] relative w-full pointer-events-none overflow-hidden pb-4 px-10">
                <div
                    class="slider-inner absolute overflow-visible w-full h-full top-0 left-0 pb-1 flex gap-x-4 pointer-events-none transition-all duration-400 ease-out">
                    @foreach ($categories as $category)
                        <div
                            class="slider-item flex items-center gap-2 p-2 border shadow-[2px_2px_0px_#000] flex-shrink-0 snap-start bg-white dark:bg-gray-800 hover:border-primary cursor-pointer transition-all">
                            @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="w-8 h-8 object-cover">
                            @else
                                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                    </svg>
                                </div>
                            @endif
                            <h2 class="text-center text-lg font-semibold">{{ $category->name }}</h2>
                        </div>
                    @endforeach
                </div>
            </div>

            <button
                class="next absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 dark:bg-gray-800 p-2 rounded-full shadow-lg z-10 hover:bg-primary hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($allPosts->take(8) as $post)
                <article class="bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-xs">
                    @if ($post->cover_image)
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}"
                            class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                    @endif

                    <div class="p-4">
                        @if ($post->category)
                            <span
                                class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-full">{{ $post->category->name }}</span>
                        @endif

                        <h3 class="text-xl font-bold mt-2 mb-2 line-clamp-2">{{ $post->title }}</h3>

                        <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4">
                            {{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}
                        </p>

                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                            <a href="/posts/{{ $post->slug }}" class="text-primary hover:underline">Read
                                more</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-lg text-gray-500 dark:text-gray-400">No posts available yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
