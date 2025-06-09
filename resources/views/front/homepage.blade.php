<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    <section
        class="h-fit mt-2 px-4 sm:px-6 md:px-8 lg:px-16 w-full border rounded-xs border-gray-300 dark:border-gray-700 text-white bg-red-500">
        <div class="flex items-center gap-2 h-8">
            <x-heroicon-o-fire class="w-6 h-6 pb-0.5" />
            <h1 class="text-sm font-bebas-neue min-w-fit tracking-wide">Trending Topic</h1>

            <div class="relative group h-8 w-full ml-2  overflow-hidden">
                <div class="absolute animate-scroll-step pause-on-hover">
                    <div class="flex flex-col">
                        @foreach ($posts as $post)
                            <a href="{{ route('posts.show', $post) }}"
                                class="text-sm h-8 py-2 flex items-center font-benne hover:underline">
                                {{ $post->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="h-fit px-4 sm:px-6 md:px-8 lg:px-16">
        <div class="w-full flex flex-col lg:flex-row items-start justify-between gap-8 lg:h-[70vh] py-4">
            <!-- Main featured article - Full width on mobile, 60% on desktop -->
            <div class="w-full lg:w-[60%] h-full mb-8 lg:mb-0">
                <article class="relative w-full h-full">
                    <div
                        class="rounded-xs shadow-[0px_-8px_0px_#f5f5f5] drop-shadow-[4px_4px_0px_#f5f5f5] dark:shadow-[0px_-8px_0px_#030712] dark:drop-shadow-[4px_4px_0px_#030712] relative lg:absolute top-auto lg:top-0 lg:left-0 w-full lg:w-[45%] h-fit bg-background border border-gray-300 dark:border-gray-700 dark:bg-gray-900 z-10 space-y-2 p-4 mb-4 lg:mb-0">
                        <div
                            class="inline-flex items-center gap-2 font-bebas-neue text-sm/6 text-gray-800 dark:text-gray-200">
                            <a href="#" class="tracking-wider p-0.5 px-1.5 dark:bg-[#050708]">Gadget</a>
                            <span class="w-5 h-[1px] bg-gray-300"></span>
                            <p class="tracking-wider">20 minute ago</p>
                        </div>
                        <p class="text-xl sm:text-2xl md:text-3xl font-semibold dark:text-white">
                            Lorem ipsum dolor sit amet, consectetur adipisicingelit.
                        </p>
                        <hr class="w-14 h-1 text-transparent bg-primary" />
                    </div>
                    <div class="lg:absolute lg:top-0 lg:right-0 w-full lg:pl-32 h-48 sm:h-64 md:h-80 lg:h-full">
                        <img src="/images/article-1.png" alt="article1"
                            class="rounded-xs w-full lg:aspect-[10/8] h-full object-cover object-center" />
                    </div>
                    <div
                        class="flex items-center justify-between w-full mt-4 lg:justify-center lg:mt-0 lg:absolute z-10 lg:space-x-4 lg:bottom-0 lg:left-2 lg:max-w-[15%] text-black dark:text-white">
                        <button
                            class="w-10 h-10 p-1 bg-white dark:bg-gray-900 rounded-xs shadow-md transition-all duration-200">
                            <x-heroicon-m-chevron-left class="text-lg" />
                        </button>
                        <button
                            class="w-10 h-10 p-1 bg-white dark:bg-gray-900 rounded-xs shadow-md transition-all duration-200">
                            <x-heroicon-m-chevron-right class="text-lg" />
                        </button>
                    </div>
                </article>
            </div>

            <!-- Latest 3 articles - Full width on mobile, 40% on desktop -->
            <div class="flex flex-col justify-between items-start w-full lg:w-[40%] h-full space-y-4 lg:space-y-0">
                @foreach ($posts as $index => $post)
                    @if ($index == 1)
                        <hr class="w-full h-1.5 text-gray-300" />
                        <x-article-post :post="$post" />
                        <hr class="w-full h-1.5 text-gray-300" />
                    @else
                        <x-article-post :post="$post" />
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- Most Popular section -->
    <section class="h-fit mt-8 px-4 sm:px-6 md:px-8 lg:px-16">
        <div class="flex item-center p-8 justify-between gap-4 w-full h-full min-h-[80vh] bg-white/95 dark:bg-gray-900">
            <div class="flex flex-col w-1/3">
                <div class="">
                    <hr class="w-10 h-1 text-transparent bg-primary" />
                    <h1 class="lg:text-3xl md:text-2xl tracking-wider font-bebas-neue pt-1.5 dark:text-gray-200">
                        Most Popular
                    </h1>
                </div>
                <div class="flex flex-col gap-y-2 mt-4">
                    @foreach ($posts as $index => $post)
                        @if ($index < $posts->count() - 3)
                            <article class="flex flex-col sm:flex-row py-2 rounded-xs gap-4 sm:gap-2 group w-full">
                                <div class="space-y-2 w-full h-full group">
                                    <div class="inline-flex items-center text-sm/normal gap-2 font-bebas-neue">
                                        <a href="#"
                                            class="tracking-wider p-0.5 px-1.5 text-[{{ $post->category->color }}] bg-[{{ $post->category->color }}]/15 group-hover:bg-[{{ $post->category->color }}] group-hover:text-white shadow-inner transition-all duration-500">{{ $post->category->name }}</a>
                                        <div class="w-5 h-0.5 bg-gray-200"></div>
                                        <p class="tracking-wider text-gray-400">{{ $post->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="text-lg font-semibold dark:text-white">
                                        <a href="#" class="hover:text-[{{ $post->category->color }}]">
                                            {{ Str::limit($post->title, 60) }}
                                        </a>
                                    </div>
                                    <a href="/posts/{{ $post->slug }}"
                                        class="relative overflow-hidden inline-flex items-center gap-1 uppercase underline tracking-wider font-bebas-neue mt-auto dark:text-white hover:text-gray-900/80">
                                        More
                                        <x-fas-arrow-right
                                            class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                                    </a>
                                </div>
                            </article>
                            <hr class="w-full h-1 text-gray-300" />
                        @endif
                    @endforeach
                </div>
                {{-- @elseif($index == $totalLimitedPost - 3)
                        <article>
                            asdasdsadasd
                        </article>
                    @elseif($index == $totalLimitedPost - 2)
                        <article>
                            asdasdsadasd
                        </article>
                    @elseif($index == $totalLimitedPost - 1)
                        <article>
                            asdasdsadasd
                        </article>
                    @endif
                @endforeach --}}
            </div>
            <div class="grid grid-cols-2 gap-4 max-w-4xl pl-4 border-l border-gray-300 mx-auto">
                <!-- First Item - Meta Quest Pro -->
                <div class="relative overflow-hidden rounded-xs shadow-md">
                    <img src="/images/article-1.png" alt="Meta Quest Pro VR Headset" class="w-full h-64 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                        <h2 class="text-white font-bold text-xl">The Meta Quest Pro is a cutting-edge headset looking
                            for an audience</h2>
                        <div class="absolute bottom-4 right-4 bg-green-500 p-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Second Item - Yale Assure Lock -->
                <div class="relative overflow-hidden rounded-xs shadow-md">
                    <img src="/images/article-1.png" alt="Yale Assure Lock 2" class="w-full h-64 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                        <h2 class="text-white font-bold text-xl">Yale Assure Lock 2 review: a promising all-rounder</h2>
                        <div class="absolute bottom-4 right-4 bg-green-500 p-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Third Item (Full Width) - Delta Air Taxis -->
                <div class="relative overflow-hidden rounded-xs shadow-md col-span-2">
                    <img src="/images/article-1.png" alt="Electric Air Taxi" class="w-full h-64 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                        <h2 class="text-white font-bold text-xl">Delta Could Soon Fly Passengers To Their Doorsteps
                            Using Electric Air Taxis</h2>
                        <div class="absolute bottom-4 right-4 bg-green-500 p-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Categories -->
    <section class="h-fit mt-8 px-4 sm:px-6 md:px-8 lg:px-16">
        <div
            class="flex item-center p-8 flex-col gap-4 w-full h-full min-h-[80vh] bg-white/95 dark:bg-gray-900 dark:text-gray-200">
            <div class="flex w-full justify-between items-center">
                <div>
                    <hr class="w-10 h-1 text-transparent bg-primary" />
                    <h1 class="lg:text-3xl md:text-2xl tracking-wider font-bebas-neue pt-1.5">Categories</h1>
                </div>
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
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}" class="w-8 h-8 object-cover">
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
                @forelse($posts as $post)
                    <article
                        class="border bg-white dark:bg-gray-800 shadow-md hover:shadow-lg transition-shadow overflow-hidden rounded-lg">
                        @if ($post->thumbnail)
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
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

    <!-- Subscribe Section -->
    <x-subscribe-form></x-subscribe-form>
</x-layout>
