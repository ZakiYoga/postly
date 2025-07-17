@props(['posts' => collect()])

<x-section-container title="Most Viewed" class="mt-6 md:mt-0">
    <div class="flex w-full flex-col gap-6 lg:flex-row lg:gap-8">

        {{-- Featured Articles Section --}}
        <div class="flex w-full lg:max-w-xs">
            <div class="flex w-full flex-col gap-6">
                @foreach ($posts->take(2) as $post)
                    <div class="group border-b border-gray-200 dark:border-gray-600">
                        <div class="relative h-32 overflow-hidden md:h-36">
                            <x-cover-image :image="$post['cover_image']" :title="$post['title']" />
                            <div
                                class="font-bebas-neue absolute bottom-2 right-2 inline-flex gap-1 bg-gray-900/80 p-1 tracking-wider text-white">
                                <x-eva-eye class="h-4 w-4" />
                                <p class="text-sm">{{ $post->view_count }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 p-4 lg:p-0 lg:py-4">
                            <div class="font-bebas-neue flex items-center gap-3 text-sm">
                                <a href="/category/{{ $post->category->slug ?? '' }}"
                                    style="--text-category-hover: {{ $post->category->color ?? '#000' }}"
                                    class="category-title text-gray-800 dark:text-gray-100">
                                    {{ $post->category->name ?? 'Uncategorized' }}
                                </a>
                                <div class="hidden h-0.5 w-5 bg-gray-200 sm:block"></div>
                                <p class="text-xs text-gray-400">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <h3 class="line-clamp-3 font-semibold text-slate-900 dark:text-white">
                                {{ $post->title }}
                            </h3>
                            <a href="/posts/{{ $post->slug }}"
                                class="font-bebas-neue inline-flex items-center gap-2 text-sm uppercase tracking-wider underline dark:text-white">
                                More
                                <x-fas-arrow-right
                                    class="h-3 w-3 transition-all duration-200 group-hover:rotate-[315deg]" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Articles List Section --}}
        <div
            class="custom-scrollbar order-2 flex max-h-[80vh] w-full flex-col gap-y-4 overflow-y-auto border-gray-200 pr-4 lg:order-1 lg:flex-1 lg:border-l lg:pl-8 dark:border-gray-600">
            @foreach ($posts->skip(2)->take(8) as $post)
                <article
                    class="rounded-xs group flex flex-col gap-4 border-b border-gray-200 pb-6 sm:flex-row dark:border-gray-600">
                    <div class="relative h-28 overflow-hidden">
                        <x-cover-image :image="$post['cover_image']" :title="$post['title']" size="large" />
                        <div
                            class="font-bebas-neue absolute bottom-2 right-2 inline-flex gap-1 bg-gray-900/80 p-1 tracking-wider text-white">
                            <x-eva-eye class="h-4 w-4" />
                            <p class="text-sm">{{ $post->view_count }}</p>
                        </div>
                    </div>
                    <div class="flex h-full w-full flex-col gap-y-3">
                        <div class="font-bebas-neue flex items-center gap-3 text-sm">
                            <a href="/category/{{ $post->category->slug ?? '' }}"
                                style="--text-category-hover: {{ $post->category->color ?? '#000' }}"
                                class="category-title text-gray-800 dark:text-gray-100">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </a>
                            <div class="hidden h-0.5 w-5 bg-gray-200 sm:block"></div>
                            <p class="text-xs text-gray-400">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <div class="text-base font-semibold sm:text-lg dark:text-white">
                            <a href="/posts/{{ $post->slug }}"
                                class="transition-colors duration-300 hover:text-[{{ $post->category->color ?? '#000' }}]">
                                {{ Str::limit($post->title, 80) }}
                            </a>
                        </div>

                        <a href="/posts/{{ $post->slug }}"
                            class="font-bebas-neue mt-auto inline-flex items-center gap-2 text-sm uppercase tracking-wider underline dark:text-white">
                            More
                            <x-fas-arrow-right
                                class="h-3 w-3 transition-all duration-200 group-hover:rotate-[315deg]" />
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</x-section-container>
