@props(['title'])

<section class="min-h-fit w-full mt-8 px-4 sm:px-6 md:px-8 lg:px-16">
    <div class="w-full space-y-6 min-h-[80vh] p-6 bg-white dark:bg-slate-900">
        <x-heading>Most Popular</x-heading>

        <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 w-full">
            {{-- Articles List Section --}}
            <div
                class="flex flex-col h-full gap-y-4 lg:overflow-y-scroll lg:max-w-sm overflow-hidden lg:flex-1 order-2 lg:order-1">
                @foreach ($posts->take(10) as $index => $post)
                    @if ($index < 7)
                        <article class="flex flex-col sm:flex-row py-3 rounded-xs gap-4 group w-full">
                            <div class="space-y-3 w-full h-full group">
                                {{-- Category and Date --}}
                                <div class="flex flex-row items-center text-sm gap-2 sm:gap-3 font-bebas-neue">
                                    <a href="/dashboard/posts/{{ $post->slug }}"
                                        style="--text-category-hover: {{ $post->category->color }}"
                                        class="category-title leading-5 font-medium text-sm md:text-base text-gray-800 dark:text-gray-100">
                                        {{ $post->category->name }}
                                    </a>
                                    <div class="hidden sm:block w-5 h-0.5 bg-gray-200"></div>
                                    <p class="tracking-wider text-gray-400 text-xs sm:text-sm">
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>

                                {{-- Title --}}
                                <div class="text-base sm:text-lg font-semibold dark:text-white leading-tight">
                                    <a href="#"
                                        class="hover:text-[{{ $post->category->color }}] transition-colors duration-300">
                                        {{ Str::limit($post->title, 80) }}
                                    </a>
                                </div>

                                {{-- Read More Link --}}
                                <a href="/posts/{{ $post->slug }}"
                                    class="relative overflow-hidden inline-flex items-center gap-2 uppercase underline tracking-wider font-bebas-neue mt-auto dark:text-white hover:text-gray-900/80 transition-colors duration-300 text-sm">
                                    More
                                    <x-fas-arrow-right
                                        class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                                </a>
                            </div>
                        </article>

                        @if ($index < 3)
                            <hr class="w-full border-t border-gray-200 dark:border-gray-600" />
                        @endif
                    @endif
                @endforeach
            </div>

            {{-- Featured Articles Grid Section --}}
            <div class="lg:flex-1 w-full order-1 lg:order-2">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:pl-6 lg:border-l border-gray-200 dark:border-gray-600">
                    {{-- First Featured Article --}}
                    <div class="relative overflow-hidden rounded-xs shadow-lg group cursor-pointer">
                        <img src="/images/article-1.png" alt="Meta Quest Pro VR Headset"
                            class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="text-white font-bold text-lg sm:text-xl leading-tight mb-3 md:mr-8">
                                    The Meta Quest Pro is a cutting-edge headset looking for an audience
                                </h3>
                                <div
                                    class="absolute bottom-4 right-4 bg-primary p-2 rounded-xs group-hover:bg-primary/80 transition-colors duration-300">
                                    <x-fas-arrow-right
                                        class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Second Featured Article --}}
                    <div class="relative overflow-hidden rounded-xs shadow-md group cursor-pointer">
                        <img src="/images/article-1.png" alt="Yale Assure Lock 2"
                            class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="text-white font-bold text-lg sm:text-xl leading-tight mb-3 md:mr-8">
                                    Yale Assure Lock 2 review: a promising all-rounder
                                </h3>
                                <div
                                    class="absolute bottom-4 right-4 bg-primary p-2 rounded-xs group-hover:bg-primary/80 transition-colors duration-300">
                                    <x-fas-arrow-right
                                        class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Third Featured Article (Full Width) --}}
                    <div class="relative overflow-hidden rounded-xs shadow-lg sm:col-span-2 group cursor-pointer">
                        <img src="/images/article-1.png" alt="Electric Air Taxi"
                            class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="text-white font-bold text-lg sm:text-xl leading-tight mb-3 md:mr-8">
                                    Delta Could Soon Fly Passengers To Their Doorsteps Using Electric Air Taxis
                                </h3>
                                <div
                                    class="absolute bottom-4 right-4 bg-primary p-2 rounded-xs group-hover:bg-primary/80 transition-colors duration-300">
                                    <x-fas-arrow-right
                                        class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
