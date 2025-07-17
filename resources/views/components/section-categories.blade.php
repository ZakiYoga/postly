@props(['categoryPosts', 'categories'])

<x-section-container id="category-section" title="Categories" link="/posts">
    {{-- Category List --}}
    <div
        class="scrollbar-thin custom-scrollbar font-bebas-neue mb-4 flex snap-x snap-mandatory gap-4 overflow-x-auto pb-2 tracking-wide">
        {{-- All Categories Button --}}
        <a href="{{ request()->fullUrlWithQuery(['category' => null, 'category_page' => null]) }}"
            class="category-tag rounded-xs {{ !request('category') ? 'border-primary bg-cyan-50 dark:bg-cyan-900/20' : 'border-gray-200 dark:border-gray-400 hover:border-2 hover:border-primary' }} group flex min-w-36 flex-shrink-0 cursor-pointer snap-start items-center gap-2 border p-2 shadow-[2px_2px_0px_#000] transition-all">
            <div class="rounded-xs flex h-8 w-8 items-center justify-center bg-gray-200 dark:bg-gray-900">
                <x-heroicon-o-squares-2x2 class="h-5 w-5 text-gray-500" />
            </div>
            <h2
                class="{{ !request('category') ? 'text-primary dark:text-primary/90' : '' }} text-center font-semibold tracking-wider">
                All Categories
            </h2>
        </a>

        @foreach ($categories as $category)
            <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug, 'category_page' => null]) }}"
                style="--bg-category-hover: {{ \App\Helpers\ColorHelper::hexToRgba($category->color, 0.2) }}; --category-border: {{ $category->color }}; "
                class="category-tag rounded-xs {{ request('category') === $category->slug ? 'category-border' : 'border-gray-200 dark:border-gray-400' }} group flex min-w-36 flex-shrink-0 cursor-pointer snap-start items-center gap-2 border p-2 transition-all hover:border-[var(--category-border)]">
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                        class="h-8 w-8 rounded-full object-cover">
                @else
                    <div class="rounded-xs flex h-8 w-8 items-center justify-center bg-gray-200 dark:bg-gray-900">
                        <x-heroicon-o-tag class="h-5 w-5 text-gray-500" />
                    </div>
                @endif

                <h2 style="--text-category-group-hover: {{ $category->color }}; {{ request('category') === $category->slug ? 'color: ' . $category->color : '' }}"
                    class="category-title text-center font-semibold tracking-wider">
                    {{ $category->name }}
                </h2>
            </a>
        @endforeach
    </div>

    {{-- Active Filter Display --}}
    @if (request('category'))
        @php
            $activeCategory = $categories->firstWhere('slug', request('category'));
        @endphp
        @if ($activeCategory)
            <div class="rounded-xs my-4 flex items-center gap-2 border-l-4 bg-gray-50 p-3 dark:bg-gray-800"
                style="border-left-color: {{ $activeCategory->color }}">
                <x-heroicon-o-funnel class="h-5 w-5 text-gray-600 dark:text-gray-400" />
                <span class="text-sm text-gray-600 dark:text-gray-400">Showing posts in category:</span>
                <span class="font-bebas-neue font-semibold leading-4 tracking-wider"
                    style="color: {{ $activeCategory->color }}">{{ $activeCategory->name }}</span>
                <a href="{{ url()->current() }}"
                    class="font-bebas-neue ml-auto text-xs tracking-wide text-gray-500 underline underline-offset-2 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    Clear filter
                </a>
            </div>

            {{-- Pagination Info --}}
            <div class="mb-4 flex items-center justify-between">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Showing {{ $categoryPosts->firstItem() }} to {{ $categoryPosts->lastItem() }} of
                    {{ $categoryPosts->total() }} posts
                    @if (request('category'))
                        in <span class="font-semibold"
                            style="color: {{ $activeCategory->color }}">{{ $activeCategory->name }}</span>
                    @endif
                </p>
            </div>
        @endif
    @endif

    {{-- Posts Grid --}}
    <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @forelse($categoryPosts as $post)
            <article
                class="rounded-xs overflow-hidden bg-white shadow-md transition-shadow duration-300 hover:shadow-lg dark:bg-gray-900">
                <div class="relative overflow-hidden">
                    <x-cover-image :image="$post['cover_image']" :title="$post['title']" />


                    {{-- Category Badge --}}
                    <div class="absolute bottom-3 right-3">
                        <span class="rounded-xs px-2 py-1 text-xs font-semibold text-gray-200 shadow-sm"
                            style="background-color: @hexToRgba($post->category->color, 0.8)">
                            {{ $post->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                </div>

                <div class="flex h-full flex-col p-4">
                    <div class="font-bebas-neue mb-2 flex items-center justify-between gap-2 tracking-wider">
                        <span class="font-bebas-neue transition-color flex duration-300 group-hover:text-white">
                            <x-like-button :post="$post" />
                            <div class="inline-flex items-center gap-1">
                                <x-eva-message-square-outline class="inline-block h-5 w-5" />
                                {{ $post->comments_count }}
                            </div>
                        </span>
                        <span class="text-sm text-gray-500">
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <h3
                        class="mb-2 line-clamp-2 text-lg font-bold transition-colors hover:text-gray-800 hover:underline dark:hover:text-gray-100">
                        <a href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </a>
                    </h3>

                    <p class="mb-4 line-clamp-3 flex-grow text-sm text-gray-600 dark:text-gray-300">
                        {{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}
                    </p>

                    <div
                        class="mt-auto flex items-center justify-between border-t border-gray-100 pt-3 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            @if ($post->author)
                                <img src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : 'https://ui-avatars.io/api/?name=' . urlencode($post->author->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                    alt="{{ $post->author->name }}" class="h-6 w-6 rounded-full">
                                <span class="text-xs text-gray-500">{{ $post->author->name }}</span>
                            @endif
                        </div>
                        <a href="/posts/{{ $post->slug }}"
                            class="text-primary font-bebas-neue text-sm font-medium tracking-wider hover:underline">
                            Read more →
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full py-12 text-center">
                <div class="flex flex-col items-center">
                    <x-heroicon-o-document-text class="mb-4 h-16 w-16 text-gray-300 dark:text-gray-600" />
                    <p class="mb-2 text-lg text-gray-500 dark:text-gray-400">
                        @if (request('category'))
                            No posts found in this category.
                        @else
                            No posts available yet.
                        @endif
                    </p>
                    @if (request('category'))
                        <a href="{{ request()->fullUrlWithQuery(['category' => null, 'category_page' => null]) }}"
                            class="text-primary hover:text-primary/90 underline">
                            View all posts
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    @if ($categoryPosts->hasPages())
        {{-- Alternative: Simple Pagination (if you prefer) --}}
        {{ $categoryPosts->links() }}
    @endif
</x-section-container>
