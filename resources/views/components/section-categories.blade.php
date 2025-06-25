@props(['posts' => collect()])

<x-section-container title="Categories" link="/posts">
    {{-- Category List --}}
    <div class="flex gap-4 overflow-x-auto pb-4 snap-x snap-mandatory scrollbar-thin custom-scrollbar font-bebas-neue tracking-wide">
        @foreach ($categories as $category)
        <a style="--bg-category-hover: {{ \App\Helpers\ColorHelper::hexToRgba($category->color, 0.2) }};" class="category-tag category-title group flex items-center gap-2 p-2 border border-gray-400 dark:border-gray-600 shadow-[2px_2px_0px_#000] flex-shrink-0 snap-start cursor-pointer transition-all rounded-xs min-w-36">
            @if ($category->cover_image)
            <img src="{{ asset('storage/' . $category->cover_image) }}" alt="{{ $category->name }}" class="w-8 h-8 object-cover rounded-full">
            @else
            <div class="w-8 h-8 bg-gray-200 dark:bg-gray-900 flex items-center justify-center rounded-xs">
                <x-heroicon-o-tag class="w-5 h-5 text-gray-500" />
            </div>
            @endif
            <h2 style="--text-category-group-hover: {{ $category->color }}" class="category-title text-center font-semibold tracking-wider">
                {{ $category->name }}
            </h2>
        </a>
        @endforeach
    </div>

    {{-- Posts Grid --}}
    <div class="grid grid-cols-1 mt-4 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($posts->take(8) as $post)
        <article class="bg-white dark:bg-gray-800 shadow-md rounded- overflow-hidden">
            @if ($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                <x-heroicon-o-photo class="w-12 h-12 text-gray-400" />
            </div>
            @endif

            <div class="flex flex-col p-4 h-full">
                <a href="/dashboard/posts/{{ $post->slug }}" class="category-title leading-4 font-bebas-neue tracking-wide text-sm md:text-base text-gray-800 dark:text-gray-100" style="--text-category: {{ $post->category->color }}">
                    {{ $post->category->name }}
                </a>

                <h3 class="text-xl font-bold mt-2 mb-2 line-clamp-2">
                    {{ $post->title }}
                </h3>

                <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4">
                    {{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}
                </p>

                <div class="flex justify-between items-center mt-auto">
                    <span class="text-sm text-gray-500">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                    <a href="/posts/{{ $post->slug }}" class="text-primary font-bebas-neue tracking-wider hover:underline">
                        Read more
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full text-center py-12">
            <p class="text-lg text-gray-500 dark:text-gray-400">
                No posts available yet.
            </p>
        </div>
        @endforelse
    </div>
</x-section-container>
