<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="h-fit mt-2 px-4 sm:px-6 md:px-8 lg:px-16 w-full border border-gray-300 dark:border-gray-700 text-white bg-red-500 dark:bg-red-600">
        <div class="flex items-center gap-2 h-8">
            <x-heroicon-o-fire class="w-6 h-6 pb-0.5" />
            <h1 class="text-sm font-bebas-neue min-w-fit tracking-wide">Trending Topic</h1>

            <div class="relative group h-8 w-full ml-2  overflow-hidden">
                <div class="absolute animate-scroll-step pause-on-hover">
                    <div class="flex flex-col">
                        @foreach ($allPosts->take(3) as $post)
                        <a href="{{ route('posts.show', $post) }}" class="text-sm h-8 py-2 flex items-center hover:underline">
                            {{ $post->title }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="h-fit px-4 sm:px-6 md:px-8 lg:px-16">
        <div class="w-full flex flex-col lg:flex-row items-start justify-between px-4 sm:px-6 md:px-0 gap-8 lg:h-[70vh] py-4">
            <!-- Main featured article with slider - Full width on mobile, 60% on desktop -->
            <div class="w-full lg:w-[60%] h-full mb-8 lg:mb-0" x-data="{
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

                @if(count($news ?? []) > 0)
                <div class="relative w-full h-full overflow-hidden">
                    <!-- Slides Container -->
                    <div class="relative w-full h-full min-h-52 -z-10 sm:min-h-60">
                        <template x-for="(slide, index) in slides" :key="index">
                            <article class="absolute inset-0 w-full h-full transition-all duration-500 ease-in-out" :class="currentSlide === index ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full'" x-show="currentSlide === index" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-full">

                                <!-- Article Content -->
                                <div class="flex flex-col rounded-xs shadow-[0px_-8px_0px_#f5f5f5] drop-shadow-[4px_4px_0px_#f5f5f5] dark:shadow-[0px_-8px_0px_#030712] dark:drop-shadow-[4px_4px_0px_#030712] relative lg:absolute top-auto lg:top-0 lg:left-0 w-full lg:w-[45%] h-fit bg-background border border-gray-300 dark:border-gray-700 dark:bg-gray-900 z-10 space-y-2 p-4 mb-4 lg:mb-0">
                                    <div class="inline-flex items-center gap-2 font-bebas-neue text-sm/6 text-gray-800 dark:text-gray-200">
                                        <a :href="'/posts?category=' + slide.category_slug" class="tracking-wider p-0.5 px-1.5 dark:bg-[#050708] hover:underline hover:underline-offset-2 transition-all duration-200" x-text="slide.category?.name || slide.category || 'Gadget'"></a>
                                        <span class="w-5 h-[1px] bg-gray-300"></span>
                                        <p class="tracking-wider" x-text="slide.time_ago || '20 minute ago'"></p>
                                    </div>
                                    <a :href="'/posts/' + slide.slug" class="group block">
                                        <h3 class="text-xl mb-2 sm:text-2xl md:text-3xl font-semibold dark:text-white group-hover:underline group-hover:underline-offset-4 transition-all duration-200" x-text="slide.title">
                                        </h3>
                                        <hr class="w-14 group-hover:w-full transition-all duration-500 h-1 text-transparent bg-primary" />
                                    </a>
                                </div>

                                <!-- Article Image -->
                                <div class="flex lg:absolute lg:top-0 lg:right-0 w-full lg:pl-32 h-48 sm:h-64 md:h-80 lg:h-full">
                                    <img :src="slide.cover_image || '/images/article-1.png'" :alt="slide.title || 'article'" class="rounded-xs w-full lg:aspect-[10/8] h-full object-cover object-center" />
                                </div>
                            </article>
                        </template>
                    </div>

                    <!-- Navigation Buttons (only show if more than 1 slide) -->
                    <div x-show="totalSlides > 1" class="flex items-center justify-between w-full mt-4 lg:justify-center px-4 mb-4 lg:p-0 lg:m-0 lg:absolute z-20 lg:space-x-4 lg:bottom-4 lg:left-2 xl:left-2.5 lg:max-w-[15%] text-black dark:text-white">
                        <button @click="prevSlide()" class="w-10 h-10 p-1 bg-white/40 dark:bg-gray-900/40 hover:bg-white dark:hover:bg-gray-900 rounded-xs shadow-md transition-all duration-200 hover:shadow-lg hover:scale-105 active:scale-95">
                            <x-heroicon-m-chevron-left class="text-lg" />
                        </button>
                        <button @click="nextSlide()" class="w-10 h-10 p-1 bg-white/40 dark:bg-gray-900/40 hover:bg-white dark:hover:bg-gray-900 rounded-xs shadow-md transition-all duration-200 hover:shadow-lg hover:scale-105 active:scale-95">
                            <x-heroicon-m-chevron-right class="text-lg" />
                        </button>
                    </div>

                    <!-- Slide Indicators (Dots) - only show if more than 1 slide -->
                    <div x-show="totalSlides > 1" class="absolute p-2 rounded-xs bottom-5 left-1/2 transform -translate-x-1/2 lg:backdrop-blur-xs lg:bg-white/40 lg:dark:bg-gray-800/40 lg:bottom-6 lg:left-auto lg:-translate-0 lg:right-5 flex space-x-2 z-20">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="goToSlide(index)" class="w-2 h-2 rounded-full transition-all duration-200" :class="currentSlide === index ? 'bg-primary scale-125' : 'bg-gray-400 hover:bg-gray-600'">
                            </button>
                        </template>
                    </div>

                    <!-- Progress Bar (Optional) - only show if more than 1 slide -->
                    <div x-show="totalSlides > 1" class="absolute bottom-0 left-0 right-0 h-1 bg-gray-200 dark:bg-gray-700 z-20">
                        <div class="h-full bg-primary transition-all duration-500 ease-linear" :style="`width: ${((currentSlide + 1) / totalSlides) * 100}%`">
                        </div>
                    </div>
                </div>

                @else
                {{-- No posts found state --}}
                <div class="flex items-center justify-center w-full h-full min-h-[300px] bg-gray-50 dark:bg-gray-800 rounded-xs border-2 border-dashed border-gray-300 dark:border-gray-600">
                    <div class="text-center">
                        <x-heroicon-o-document-text class="w-16 h-16 text-gray-400 mx-auto mb-4" />
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Featured Posts</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                            @if(request('category'))
                            No posts found in this category for the featured section.
                            @else
                            No posts available for the featured section.
                            @endif
                        </p>
                        @if(request('category'))
                        <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 underline">
                            View all posts
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Latest articles sidebar - Full width on mobile, 40% on desktop -->
            <div class="custom-scrollbar md:pb-1 flex flex-col gap-y-6 justify-between pr-4 items-start w-full overflow-hidden lg:overflow-y-auto rounded-xs lg:w-[40%] h-full space-y-4 lg:space-y-0">
                @if($sidebarPosts->count() > 0)
                @foreach ($sidebarPosts as $index => $post)
                @if ($index == 1)
                <hr class="w-full h-1.5 text-gray-300" />
                <x-article-post :post="$post" />
                <hr class="w-full h-1.5 text-gray-300" />
                @else
                <x-article-post :post="$post" />
                @endif
                @endforeach
                @else
                {{-- No sidebar posts found state --}}
                <div class="flex items-center justify-center w-full h-full min-h-[200px] bg-gray-50 dark:bg-gray-800 rounded-xs border border-gray-200 dark:border-gray-700">
                    <div class="text-center p-6">
                        <x-heroicon-o-newspaper class="w-12 h-12 text-gray-400 mx-auto mb-3" />
                        <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-2">No Additional Posts</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            @if(request('category'))
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
