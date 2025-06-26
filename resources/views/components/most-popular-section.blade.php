@props(['posts' => collect()])

<x-section-container title="Most Popular">

    <div class="flex flex-col lg:flex-row gap-6 w-full min-h-[500px] lg:min-h-[70vh]">
        {{-- Articles List Section --}}
        <div class="flex-1 order-2 lg:order-1 overflow-auto md:max-h-[71vh] md:pr-4 custom-scrollbar">
            <div class="flex items-center flex-col gap-y-4">
                @foreach ($posts->skip(3) as $index => $post)
                <article class="flex flex-col sm:flex-row pb-4 border-b border-gray-200 dark:border-gray-600 rounded-xs gap-4 group w-full">
                    <div class="space-y-3 w-full h-full group">
                        {{-- Category and Date --}}
                        <div class="flex flex-row items-center text-sm gap-2 sm:gap-3 font-bebas-neue tracking-wider text-gray-500 dark:text-gray-400">
                            <a href="/category/{{ $post->category->slug ?? '' }}" class="leading-5 font-medium text-sm md:text-base ">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </a>
                            <div class="hidden sm:block w-5 h-0.5 bg-gray-200"></div>
                            <p class="text-gray-400 text-xs sm:text-sm">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>

                        {{-- Title --}}
                        <div class="text-base sm:text-lg font-semibold dark:text-white leading-tight">
                            <a href="/posts/{{ $post->slug }}" class="hover:text-[{{ $post->category->color ?? '#000' }}] transition-colors duration-300">
                                {{ Str::limit($post->title, 80) }}
                            </a>
                        </div>

                        {{-- Read More Link --}}
                        <div class="flex w-full items-center justify-between mt-auto tracking-wider font-bebas-neue dark:text-white hover:text-gray-900/80">
                            <span class="flex font-bebas-neue transition-color duration-300">
                                @include('components.like-button', ['post' => $post])
                                <div class="inline-flex items-center gap-1">
                                    <x-eva-message-square-outline class="w-5 h-5 inline-block" />
                                    {{ $post->comments_count }}
                                </div>
                            </span>
                            <a href="/posts/{{ $post->slug }}" class="relative overflow-hidden inline-flex items-center gap-2 uppercase underline  transition-colors duration-300">
                                More
                                <x-fas-arrow-right class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                            </a>

                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>

        {{-- Featured Articles Grid Section - Menggunakan data dari trending posts --}}
        <div class="flex-1 w-full order-1 lg:order-2">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach ($posts->take(3) as $index => $post)
                @if ($index == 0)
                {{-- First Featured Article --}}
                <div class="relative overflow-hidden rounded-xs shadow-lg group cursor-pointer">
                    <img src="{{ $post->cover_image ? 'storage/' . $post->cover_image : '/images/article-1.png' }}" alt="{{ $post->title }}" class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-white font-bold text-lg sm:text-xl leading-tight mb-3 md:mr-8">
                                {{ Str::limit($post->title, 100) }}
                            </h3>
                            <a href="/posts/{{ $post->slug }}" class="absolute bottom-4 right-4 bg-primary p-2 rounded-xs group-hover:bg-primary/80 transition-colors duration-300">
                                <x-fas-arrow-right class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                            </a>
                        </div>
                    </div>
                </div>
                @elseif ($index == 1)
                {{-- Second Featured Article --}}
                <div class="relative overflow-hidden rounded-xs shadow-md group cursor-pointer">
                    <img src="{{ $post->cover_image ? 'storage/' . $post->cover_image : '/images/article-1.png' }}" alt="{{ $post->title }}" class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-white font-bold text-lg sm:text-xl leading-tight mb-3 md:mr-8">
                                {{ Str::limit($post->title, 60) }}
                            </h3>
                            <a href="/posts/{{ $post->slug }}" class="absolute bottom-4 right-4 bg-primary p-2 rounded-xs group-hover:bg-primary/80 transition-colors duration-300">
                                <x-fas-arrow-right class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                            </a>
                        </div>
                    </div>
                </div>
                @elseif ($index == 2)
                {{-- Third Featured Article --}}
                <div class="relative overflow-hidden rounded-xs shadow-lg sm:col-span-2 group cursor-pointer">
                    <img src="{{ $post->cover_image ? 'storage/' . $post->cover_image : '/images/article-1.png' }}" alt="{{ $post->title }}" class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-white font-bold text-lg sm:text-xl leading-tight mb-3 md:mr-8">
                                {{ Str::limit($post->title, 100) }}
                            </h3>
                            <a href="/posts/{{ $post->slug }}" class="absolute bottom-4 right-4 bg-primary p-2 rounded-xs group-hover:bg-primary/80 transition-colors duration-300">
                                <x-fas-arrow-right class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</x-section-container>
