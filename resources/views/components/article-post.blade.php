@props(['post'])

<article
    class="flex flex-col border-b border-gray-200 dark:border-gray-400 pb-4 sm:flex-row gap-4 sm:gap-2 group w-full">
    <div class="w-full sm:w-44 h-48 sm:h-28 rounded-xs overflow-hidden">
        <img src="/images/article-1.png" alt="{{ $post->title }}"
            class="group-hover:scale-110 transition-all duration-300 w-full h-full object-cover object-center">
    </div>
    <div class="flex flex-col gap-y-2 w-full h-full group">
        <div class="inline-flex items-center text-sm/normal gap-2 font-bebas-neue dark:text-gray-200">
            <a id="categoryTag" href="/posts?category={{ $post->category->slug }}"
                class="category-tag rounded-xs px-1.5 py-1 text-gray-100 hover:underline"
                style="--bg-category: {{ $post->category->color }}; --bg-category-hover:  @hexToRgba($post->category->color, 0.8);">
                {{ $post->category->name }}
            </a>
            <div class="w-5 h-0.5 bg-gray-200"></div>
            <p class="tracking-wider text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
        </div>
        <div class="text-lg font-semibold dark:text-white">
            <a href="/dashboard/posts/{{ $post->slug }}" style="--text-category-hover: {{ $post->category->color }}"
                class="category-title font-medium text-lg text-gray-800 dark:text-gray-100">
                {{ Str::limit($post->title, limit: 60) }}
            </a>
        </div>
        <a href="/posts/{{ $post->slug }}"
            class="relative leading-4 overflow-hidden inline-flex items-center gap-1 uppercase underline tracking-wider font-bebas-neue mt-auto dark:text-white hover:text-gray-900/80">
            More
            <x-fas-arrow-right class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
        </a>
    </div>
</article>
