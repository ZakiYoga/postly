@props(['posts' => collect()])

<x-section-container title="Most Popular">

    <div class="flex min-h-[500px] w-full flex-col gap-6 lg:min-h-[70vh] lg:flex-row">
        {{-- Articles List Section --}}
        <div class="custom-scrollbar order-2 flex-1 overflow-auto md:max-h-[71vh] md:pr-4 lg:order-1">
            <div class="flex flex-col items-center gap-y-4">
                @foreach ($posts->skip(3) as $index => $post)
                    <article
                        class="rounded-xs group flex w-full flex-col gap-4 border-b border-gray-200 pb-4 sm:flex-row dark:border-gray-600">
                        <div class="group h-full w-full space-y-3">
                            {{-- Category and Date --}}
                            <div
                                class="font-bebas-neue flex flex-row items-center gap-2 text-sm tracking-wider text-gray-500 sm:gap-3 dark:text-gray-400">
                                <a href="/category/{{ $post->category->slug ?? '' }}"
                                    class="text-sm font-medium leading-5 md:text-base">
                                    {{ $post->category->name ?? 'Uncategorized' }}
                                </a>
                                <div class="hidden h-0.5 w-5 bg-gray-200 sm:block"></div>
                                <p class="text-xs text-gray-400 sm:text-sm">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>

                            {{-- Title --}}
                            <div class="text-base font-semibold leading-tight sm:text-lg dark:text-white">
                                <a href="/posts/{{ $post->slug }}"
                                    class="transition-colors duration-300 hover:text-[{{ $post->category->color ?? '#000' }}]">
                                    {{ Str::limit($post->title, 80) }}
                                </a>
                            </div>

                            {{-- Read More Link --}}
                            <div
                                class="font-bebas-neue mt-auto flex w-full items-center justify-between tracking-wider hover:text-gray-900/80 dark:text-white">
                                <span class="font-bebas-neue transition-color flex duration-300">
                                    <x-like-button :post="$post" />
                                    <div class="inline-flex items-center gap-1">
                                        <x-eva-message-square-outline class="inline-block h-5 w-5" />
                                        {{ $post->comments_count }}
                                    </div>
                                </span>
                                <a href="/posts/{{ $post->slug }}"
                                    class="relative inline-flex items-center gap-2 overflow-hidden uppercase underline transition-colors duration-300">
                                    More
                                    <x-fas-arrow-right
                                        class="mb-0.5 h-3 w-3 transition-all duration-200 group-hover:rotate-[315deg]" />
                                </a>

                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        {{-- Featured Articles Grid Section - Menggunakan data dari trending posts --}}
        <div class="order-1 w-full flex-1 lg:order-2">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                @foreach ($posts->take(3) as $index => $post)
                    @if ($index == 0)
                        {{-- First Featured Article --}}
                        <div class="rounded-xs group relative cursor-pointer overflow-hidden shadow-lg">
                            <x-cover-image :image="$post['cover_image']" :title="$post['title']" />

                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <div class="space-y-1">
                                        <span
                                            class="font-bebas-neue transition-color inline-flex w-full justify-start duration-300">
                                            <x-like-button :post="$post" unlikedColor="text-white"
                                                countUnlikedClass="text-white" />
                                            <div class="inline-flex items-center gap-4 text-white">
                                                <x-eva-message-square-outline class="inline-block h-5 w-5" />
                                                {{ $post->comments_count }}
                                            </div>
                                        </span>
                                        <h3 class="mb-3 text-lg font-bold leading-tight text-white sm:text-xl">
                                            {{ Str::limit($post->title, 100) }}
                                        </h3>
                                    </div>
                                </div>
                                <a href="/posts/{{ $post->slug }}"
                                    class="bg-primary rounded-xs group-hover:bg-primary/80 absolute right-4 top-4 p-2 transition-colors duration-300">
                                    <x-fas-arrow-right
                                        class="mb-0.5 h-3 w-3 transition-all duration-200 group-hover:rotate-[315deg]" />
                                </a>
                            </div>
                        </div>
                    @elseif ($index == 1)
                        {{-- Second Featured Article --}}
                        <div class="rounded-xs group relative cursor-pointer overflow-hidden shadow-md">
                            <x-cover-image :image="$post['cover_image']" :title="$post['title']" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <div class="space-y-1">
                                        <span
                                            class="font-bebas-neue transition-color inline-flex w-full justify-start duration-300">
                                            <x-like-button :post="$post" unlikedColor="text-white"
                                                countUnlikedClass="text-white" />
                                            <div class="inline-flex items-center gap-4 text-white">
                                                <x-eva-message-square-outline class="inline-block h-5 w-5" />
                                                {{ $post->comments_count }}
                                            </div>
                                        </span>
                                        <h3 class="mb-3 text-lg font-bold leading-tight text-white sm:text-xl">
                                            {{ Str::limit($post->title, 100) }}
                                        </h3>
                                    </div>
                                </div>
                                <a href="/posts/{{ $post->slug }}"
                                    class="bg-primary rounded-xs group-hover:bg-primary/80 absolute right-4 top-4 p-2 transition-colors duration-300">
                                    <x-fas-arrow-right
                                        class="mb-0.5 h-3 w-3 transition-all duration-200 group-hover:rotate-[315deg]" />
                                </a>
                            </div>
                        </div>
                    @elseif ($index == 2)
                        {{-- Third Featured Article --}}
                        <div class="rounded-xs group relative cursor-pointer overflow-hidden shadow-lg sm:col-span-2">
                            <x-cover-image :image="$post['cover_image']" :title="$post['title']" class="max-h-52 md:max-h-72" />

                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <div class="space-y-1">
                                        <span
                                            class="font-bebas-neue transition-color inline-flex w-full justify-start duration-300">
                                            <x-like-button :post="$post" unlikedColor="text-white"
                                                countUnlikedClass="text-white" />
                                            <div class="inline-flex items-center gap-4 text-white">
                                                <x-eva-message-square-outline class="inline-block h-5 w-5" />
                                                {{ $post->comments_count }}
                                            </div>
                                        </span>
                                        <h3 class="mb-3 text-lg font-bold leading-tight text-white sm:text-xl">
                                            {{ Str::limit($post->title, 100) }}
                                        </h3>
                                    </div>
                                </div>
                                <a href="/posts/{{ $post->slug }}"
                                    class="bg-primary rounded-xs group-hover:bg-primary/80 absolute bottom-4 right-4 p-2 transition-colors duration-300">
                                    <x-fas-arrow-right
                                        class="mb-0.5 h-3 w-3 transition-all duration-200 group-hover:rotate-[315deg]" />
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-section-container>
