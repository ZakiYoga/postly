@props(['post' => null])

<article
    class="group flex w-full flex-col gap-4 border-b border-gray-200 pb-4 sm:flex-row sm:gap-2 dark:border-gray-400">
    <x-cover-image :image="$post['cover_image']" :title="$post['title']" size="small" />
    <div class="group flex h-full w-full flex-col gap-y-2">
        <div
            class="font-bebas-neue inline-flex items-center gap-2 text-sm/normal tracking-wider text-gray-500 dark:text-gray-400">
            <a id="categoryTag" href="/posts?category={{ $post['category_slug'] }}" class="hover:underline">
                {{ $post['category'] }}
            </a>
            <div class="h-0.5 w-5 bg-gray-200"></div>
            <p>{{ $post['time_ago'] }}</p>
        </div>
        <div class="text-lg font-semibold dark:text-white">
            <a href="/dashboard/posts/{{ $post['slug'] }}" style="--text-category-hover: {{ $post['category_color'] }}"
                class="category-title text-lg font-medium text-gray-800 dark:text-gray-100">
                {{ Str::limit($post['title'], 60) }}
            </a>
        </div>
        <a href="/posts/{{ $post['slug'] }}"
            class="font-bebas-neue relative mt-auto inline-flex items-center gap-1 overflow-hidden uppercase leading-4 tracking-wider underline hover:text-gray-900/80 dark:text-white">
            More
            <x-fas-arrow-right class="mb-0.5 h-3 w-3 transition-all duration-200 group-hover:rotate-[315deg]" />
        </a>
    </div>
</article>
