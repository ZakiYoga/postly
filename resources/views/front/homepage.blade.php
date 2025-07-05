<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    <section
        class="mt-2 h-fit w-full border border-gray-300 bg-red-500 px-4 text-white sm:px-6 md:px-8 lg:px-16 dark:border-gray-700 dark:bg-red-600">
        <div class="flex h-8 items-center gap-2">
            <x-heroicon-o-fire class="h-6 w-6 pb-0.5" />
            <h1 class="font-bebas-neue min-w-fit text-sm tracking-wide">Trending Topic</h1>

            <div class="group relative ml-2 h-8 w-full overflow-hidden">
                <div class="animate-scroll-step pause-on-hover absolute">
                    <div class="flex flex-col">
                        @foreach ($allPosts->take(3) as $post)
                            <a href="/posts/{{ $post->slug }}"
                                class="flex h-8 items-center py-2 text-sm hover:underline">
                                {{ $post->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="h-fit px-4 sm:px-6 md:px-8 lg:px-16">
        <div
            class="flex w-full flex-col items-start justify-between gap-8 px-4 py-4 sm:px-6 md:px-0 lg:h-[70vh] lg:flex-row">
            <!-- Main featured article with slider - Full width on mobile, 60% on desktop -->
            <div class="mb-8 h-full w-full lg:mb-0 lg:w-[60%]" x-data="{
                currentSlide: 0,
                slides: {{ json_encode($news->take(5) ?? []) }},
                totalSlides: {{ count($news->take(5) ?? []) }},
                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                },
                prevSlide() {
                    this.currentSlide = this.currentSlide === 0 ? this.totalSlides - 1 : this.currentSlide - 1;
                },
                goToSlide(index) {
                    this.currentSlide = index;
                }
            }" x-init="// Auto-play functionality (optional)
            if (totalSlides > 1) {
                setInterval(() => {
                    nextSlide();
                }, 5000);
            }">

                @if (count($news ?? []) > 0)
                    <div class="relative h-full w-full overflow-hidden">
                        <!-- Slides Container -->
                        <div class="relative -z-10 h-full min-h-52 w-full sm:min-h-60">
                            <template x-for="(slide, index) in slides" :key="index">
                                <article class="absolute inset-0 h-full w-full transition-all duration-500 ease-in-out"
                                    :class="currentSlide === index ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full'"
                                    x-show="currentSlide === index"
                                    x-transition:enter="transition ease-out duration-500"
                                    x-transition:enter-start="opacity-0 translate-x-full"
                                    x-transition:enter-end="opacity-100 translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 translate-x-0"
                                    x-transition:leave-end="opacity-0 -translate-x-full">

                                    <!-- Article Content -->
                                    <div
                                        class="rounded-xs bg-background relative top-auto z-10 mb-4 flex h-fit w-full flex-col space-y-2 border border-gray-300 p-4 shadow-[0px_-8px_0px_#f5f5f5] drop-shadow-[4px_4px_0px_#f5f5f5] lg:absolute lg:left-0 lg:top-0 lg:mb-0 lg:w-[45%] dark:border-gray-700 dark:bg-gray-900 dark:shadow-[0px_-8px_0px_#030712] dark:drop-shadow-[4px_4px_0px_#030712]">
                                        <div
                                            class="font-bebas-neue inline-flex items-center gap-2 text-sm/6 text-gray-800 dark:text-gray-200">
                                            <a :href="'/posts?category=' + slide.category_slug"
                                                class="p-0.5 px-1.5 tracking-wider transition-all duration-200 hover:underline hover:underline-offset-2 dark:bg-[#050708]"
                                                x-text="slide.category?.name || slide.category || 'Gadget'"></a>
                                            <span class="h-[1px] w-5 bg-gray-300"></span>
                                            <p class="tracking-wider" x-text="slide.time_ago || '20 minute ago'"></p>
                                        </div>
                                        <a :href="'/posts/' + slide.slug" class="group block">
                                            <h3 class="mb-2 text-xl font-semibold transition-all duration-200 group-hover:underline group-hover:underline-offset-4 sm:text-2xl md:text-3xl dark:text-white"
                                                x-text="slide.title">
                                            </h3>
                                            <hr
                                                class="bg-primary h-1 w-14 text-transparent transition-all duration-500 group-hover:w-full" />
                                        </a>
                                    </div>

                                    <!-- Article Image -->
                                    <template x-if="slide.cover_image || slide.unsplash_image_url">
                                        <div
                                            class="flex h-48 w-full sm:h-64 md:h-80 lg:absolute lg:right-0 lg:top-0 lg:h-full lg:pl-32">
                                            <img :src="slide.cover_image || slide.unsplash_image_url"
                                                :alt="slide.title || 'article'"
                                                class="rounded-xs h-full w-full object-cover object-center lg:aspect-[10/8]" />
                                        </div>
                                    </template>

                                    <!-- Placeholder jika gambar tidak tersedia -->
                                    <template x-if="!slide.cover_image && !slide.unsplash_image_url">
                                        <div
                                            class="flex h-48 w-full sm:h-64 md:h-80 lg:absolute lg:right-0 lg:top-0 lg:h-full lg:pl-32">
                                            <div
                                                class="grid place-content-center rounded-xs h-full w-full object-cover object-center lg:aspect-[10/8] border-2 border-dashed border-gray-300 bg-gray-100 text-center">
                                                <x-heroicon-o-photo class="w-24 h-24 mx-auto mb-2 text-gray-400" />
                                                <p class="text-sm font-medium text-gray-500">No preview yet</p>
                                            </div>
                                        </div>
                                    </template>
                                </article>
                            </template>
                        </div>

                        <!-- Navigation Buttons (only show if more than 1 slide) -->
                        <div x-show="totalSlides > 1"
                            class="z-20 mb-4 mt-4 flex w-full items-center justify-between px-4 text-black lg:absolute lg:bottom-4 lg:left-2 lg:m-0 lg:max-w-[15%] lg:justify-center lg:space-x-4 lg:p-0 xl:left-2.5 dark:text-white">
                            <button @click="prevSlide()"
                                class="rounded-xs h-10 w-10 bg-white/40 p-1 shadow-md transition-all duration-200 hover:scale-105 hover:bg-white hover:shadow-lg active:scale-95 dark:bg-gray-900/40 dark:hover:bg-gray-900">
                                <x-heroicon-m-chevron-left class="text-lg" />
                            </button>
                            <button @click="nextSlide()"
                                class="rounded-xs h-10 w-10 bg-white/40 p-1 shadow-md transition-all duration-200 hover:scale-105 hover:bg-white hover:shadow-lg active:scale-95 dark:bg-gray-900/40 dark:hover:bg-gray-900">
                                <x-heroicon-m-chevron-right class="text-lg" />
                            </button>
                        </div>

                        <!-- Slide Indicators (Dots) - only show if more than 1 slide -->
                        <div x-show="totalSlides > 1"
                            class="rounded-xs lg:backdrop-blur-xs lg:-translate-0 absolute bottom-5 left-1/2 z-20 flex -translate-x-1/2 transform space-x-2 p-2 lg:bottom-6 lg:left-auto lg:right-5 lg:bg-white/40 lg:dark:bg-gray-800/40">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button @click="goToSlide(index)"
                                    class="h-2 w-2 rounded-full transition-all duration-200"
                                    :class="currentSlide === index ? 'bg-primary scale-125' : 'bg-gray-400 hover:bg-gray-600'">
                                </button>
                            </template>
                        </div>

                        <!-- Progress Bar (Optional) - only show if more than 1 slide -->
                        <div x-show="totalSlides > 1"
                            class="absolute bottom-0 left-0 right-0 z-20 h-1 bg-gray-200 dark:bg-gray-700">
                            <div class="bg-primary h-full transition-all duration-500 ease-linear"
                                :style="`width: ${((currentSlide + 1) / totalSlides) * 100}%`">
                            </div>
                        </div>
                    </div>
                @else
                    {{-- No posts found state --}}
                    <div
                        class="rounded-xs flex h-full min-h-[300px] w-full items-center justify-center border-2 border-dashed border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-800">
                        <div class="text-center">
                            <x-heroicon-o-document-text class="mx-auto mb-4 h-16 w-16 text-gray-400" />
                            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-gray-100">No Featured Posts</h3>
                            <p class="mb-4 text-gray-500 dark:text-gray-400">
                                @if (request('category'))
                                    No posts found in this category for the featured section.
                                @else
                                    No posts available for the featured section.
                                @endif
                            </p>
                            @if (request('category'))
                                <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}"
                                    class="text-blue-600 underline hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    View all posts
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Latest articles sidebar - Full width on mobile, 40% on desktop -->
            <div
                class="custom-scrollbar rounded-xs flex h-full w-full flex-col items-start justify-between gap-y-6 space-y-4 overflow-hidden pr-4 md:pb-1 lg:w-[40%] lg:space-y-0 lg:overflow-y-auto">
                @if ($sidebarPosts->count() > 0)
                    @foreach ($sidebarPosts as $index => $post)
                        @if ($index == 1)
                            <hr class="h-1.5 w-full text-gray-300" />
                            <x-article-post :post="$post" />
                            <hr class="h-1.5 w-full text-gray-300" />
                        @else
                            <x-article-post :post="$post" />
                        @endif
                    @endforeach
                @else
                    {{-- No sidebar posts found state --}}
                    <div
                        class="rounded-xs flex h-full min-h-[200px] w-full items-center justify-center border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
                        <div class="p-6 text-center">
                            <x-heroicon-o-newspaper class="mx-auto mb-3 h-12 w-12 text-gray-400" />
                            <h4 class="text-md mb-2 font-medium text-gray-900 dark:text-gray-100">No Additional Posts
                            </h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                @if (request('category'))
                                    Not enough posts in this category for the sidebar.
                                @else
                                    No additional posts available for the sidebar.
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <!-- Most Popular section -->
    <x-most-popular-section :posts="$trending" />

    <!-- Most Popular section -->
    <x-most-viewed-section :posts="$mostViewed" />

    <!-- Section Categories -->
    <x-section-categories :categories="$categories" :categoryPosts="$categoryPosts" />

    <!-- Subscribe Section -->
    <x-subscribe-form />
</x-layout>
