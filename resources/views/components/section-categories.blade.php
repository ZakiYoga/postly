@props(['categoryPosts' => collect(), 'categories'])

<x-section-container id="category-section" title="Categories" link="/posts">
    {{-- Category List --}}
    <div class="flex gap-4 overflow-x-auto pb-2 mb-4 snap-x snap-mandatory scrollbar-thin custom-scrollbar font-bebas-neue tracking-wide">
        {{-- All Categories Button --}}
        <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="category-tag group flex items-center gap-2 p-2 border shadow-[2px_2px_0px_#000] flex-shrink-0 snap-start cursor-pointer transition-all rounded-xs min-w-36 {{ !request('category') ? 'border-primary bg-cyan-50 dark:bg-cyan-900/20' : 'border-gray-200 dark:border-gray-400 hover:border-2 hover:border-primary' }}">
            <div class="w-8 h-8 bg-gray-200 dark:bg-gray-900 flex items-center justify-center rounded-xs">
                <x-heroicon-o-squares-2x2 class="w-5 h-5 text-gray-500" />
            </div>
            <h2 class="text-center font-semibold tracking-wider {{ !request('category') ? 'text-primary dark:text-ptimaty/90' : '' }}">
                All Categories
            </h2>
        </a>

        @foreach ($categories as $category)
        <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug]) }}" style="--bg-category-hover: {{ \App\Helpers\ColorHelper::hexToRgba($category->color, 0.2) }}; --category-border: {{ $category->color }}; " class="category-tag group flex items-center gap-2 p-2 border flex-shrink-0 snap-start cursor-pointer transition-all hover:border-[var(--category-border)] rounded-xs min-w-36 {{ request('category') === $category->slug ? 'category-border' : 'border-gray-200 dark:border-gray-400' }}">
            @if ($category->image)
            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-8 h-8 object-cover rounded-full">
            @else
            <div class="w-8 h-8 bg-gray-200 dark:bg-gray-900 flex items-center justify-center rounded-xs">
                <x-heroicon-o-tag class="w-5 h-5 text-gray-500" />
            </div>
            @endif

            <h2 style="--text-category-group-hover: {{ $category->color }}; {{ request('category') === $category->slug ? 'color: ' . $category->color : '' }}" class="category-title text-center font-semibold tracking-wider">
                {{ $category->name }}
            </h2>
        </a>
        @endforeach
    </div>

    {{-- Active Filter Display --}}
    @if(request('category'))
    @php
    $activeCategory = $categories->firstWhere('slug', request('category'));
    @endphp
    @if($activeCategory)
    <div class="flex items-center gap-2 my-4 p-3 bg-gray-50 dark:bg-gray-800 rounded-xs border-l-4" style="border-left-color: {{ $activeCategory->color }}">
        <x-heroicon-o-funnel class="w-5 h-5 text-gray-600 dark:text-gray-400" />
        <span class="text-sm text-gray-600 dark:text-gray-400">Showing posts in category:</span>
        <span class="font-semibold font-bebas-neue tracking-wider leading-4" style="color: {{ $activeCategory->color }}">{{ $activeCategory->name }}</span>
        <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="ml-auto font-bebas-neue tracking-wide text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 underline-offset-2 underline">
            Clear filter
        </a>
    </div>
    @endif
    @endif

    {{-- Posts Grid --}}
    <div class="grid grid-cols-1 mt-4 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($categoryPosts->take(8) as $post)
        <article class="bg-white dark:bg-gray-900 shadow-md rounded-xs overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="relative overflow-hidden">
                <img src="{{ $post->cover_image ? asset('storage/' . $post->cover_image) : asset('images/article-1.png') }}" alt="{{ $post->title }}" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300" onerror="this.src='{{ asset('images/article-1.png') }}'">

                {{-- Category Badge --}}
                <div class="absolute bottom-3 right-3">
                    <span class="px-2 py-1 text-xs font-semibold rounded-xs text-gray-200 shadow-sm" style="background-color: @hexToRgba($post->category->color, 0.8)">
                        {{ $post->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
            </div>

            <div class="flex flex-col p-4 h-full">
                <div class="flex items-center justify-between font-bebas-neue tracking-wider gap-2 mb-2">
                    <span class="flex font-bebas-neue transition-color duration-300 group-hover:text-white">
                        <x-like-button :post="$post" />
                        <div class="inline-flex items-center gap-1">
                            <x-eva-message-square-outline class="w-5 h-5 inline-block" />
                            {{ $post->comments_count }}
                        </div>
                    </span>
                    <span class="text-sm text-gray-500">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>

                <h3 class="text-lg font-bold mb-2 line-clamp-2 hover:text-gray-800 hover:underline dark:hover:text-gray-100 transition-colors">
                    <a href="/posts/{{ $post->slug }}">
                        {{ $post->title }}
                    </a>
                </h3>

                <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4 flex-grow">
                    {{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}
                </p>

                <div class="flex justify-between items-center mt-auto pt-3 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-2">
                        @if($post->author)
                        <img src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : 'https://ui-avatars.io/api/?name=' . urlencode($post->author->name) . '&color=7F9CF5&background=EBF4FF' }}" alt="{{ $post->author->name }}" class="w-6 h-6 rounded-full">
                        <span class="text-xs text-gray-500">{{ $post->author->name }}</span>
                        @endif
                    </div>
                    <a href="/posts/{{ $post->slug }}" class="text-primary font-bebas-neue tracking-wider hover:underline text-sm font-medium">
                        Read more →
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="flex flex-col items-center">
                <x-heroicon-o-document-text class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" />
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-2">
                    @if(request('category'))
                    No posts found in this category.
                    @else
                    No posts available yet.
                    @endif
                </p>
                @if(request('category'))
                <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="text-primary hover:text-primary/90 underline">
                    View all posts
                </a>
                @endif
            </div>
        </div>
        @endforelse
    </div>
</x-section-container>
