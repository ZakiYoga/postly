@props(['posts' => collect()])

<x-section-container title="Most Viewed" class="mt-6 md:mt-0">
    <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 w-full">

        {{-- Featured Articles Section --}}
        <div class="flex lg:max-w-xs w-full">
            <div class="flex flex-col gap-6 w-full">
                @foreach ($posts->take(2) as $post)
                <div class="group border-b border-gray-200 dark:border-gray-600">
                    <div class="relative h-32 md:h-36 overflow-hidden">
                        <img src="{{ $post->cover_image ? 'storage/' . $post->cover_image : '/images/article-1.png' }}" alt="{{ $post->title }}" class="w-full h-full aspect-video object-cover rounded-xs group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inline-flex gap-1 bottom-2 right-2 p-1 text-white bg-gray-900/80 font-bebas-neue tracking-wider">
                            <x-eva-eye class="w-4 h-4" />
                            <p class="text-sm">{{ $post->view_count }}</p>
                        </div>
                    </div>
                    <div class="p-4 lg:py-4 lg:p-0 space-y-2">
                        <div class="flex items-center text-sm gap-3 font-bebas-neue">
                            <a href="/category/{{ $post->category->slug ?? '' }}" style="--text-category-hover: {{ $post->category->color ?? '#000' }}" class="category-title text-gray-800 dark:text-gray-100">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </a>
                            <div class="hidden sm:block w-5 h-0.5 bg-gray-200"></div>
                            <p class="text-gray-400 text-xs">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <h3 class="font-semibold text-slate-900 dark:text-white line-clamp-3">
                            {{ $post->title }}
                        </h3>
                        <a href="/posts/{{ $post->slug }}" class="inline-flex items-center gap-2 uppercase underline tracking-wider font-bebas-neue text-sm dark:text-white">
                            More
                            <x-fas-arrow-right class="w-3 h-3 group-hover:rotate-[315deg] transition-all duration-200" />
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Articles List Section --}}
        <div class="flex flex-col lg:pl-8 pr-4 lg:border-l border-gray-200 dark:border-gray-600 gap-y-4 overflow-y-auto w-full lg:flex-1 order-2 lg:order-1 max-h-[80vh] custom-scrollbar">
            @foreach ($posts->skip(2)->take(8) as $post)
            <article class="flex flex-col sm:flex-row rounded-xs gap-4 pb-6 border-b border-gray-200 dark:border-gray-600 group">
                <div class="relative h-28 overflow-hidden">
                    <img src="{{ $post->cover_image ? 'storage/' . $post->cover_image : '/images/article-1.png' }}" alt="{{ $post->title }}" class="w-full h-full aspect-video object-cover rounded-xs group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inline-flex gap-1 bottom-2 right-2 p-1 text-white bg-gray-900/80 font-bebas-neue tracking-wider">
                        <x-eva-eye class="w-4 h-4" />
                        <p class="text-sm">{{ $post->view_count }}</p>
                    </div>
                </div>
                <div class="flex flex-col gap-y-3 w-full h-full">
                    <div class="flex items-center text-sm gap-3 font-bebas-neue">
                        <a href="/category/{{ $post->category->slug ?? '' }}" style="--text-category-hover: {{ $post->category->color ?? '#000' }}" class="category-title text-gray-800 dark:text-gray-100">
                            {{ $post->category->name ?? 'Uncategorized' }}
                        </a>
                        <div class="hidden sm:block w-5 h-0.5 bg-gray-200"></div>
                        <p class="text-gray-400 text-xs">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <div class="text-base sm:text-lg font-semibold dark:text-white">
                        <a href="/posts/{{ $post->slug }}" class="hover:text-[{{ $post->category->color ?? '#000' }}] transition-colors duration-300">
                            {{ Str::limit($post->title, 80) }}
                        </a>
                    </div>

                    <a href="/posts/{{ $post->slug }}" class="mt-auto inline-flex items-center gap-2 uppercase underline tracking-wider font-bebas-neue text-sm dark:text-white">
                        More
                        <x-fas-arrow-right class="w-3 h-3 group-hover:rotate-[315deg] transition-all duration-200" />
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</x-section-container>
