@props(['post' => null])

<article
    class="group flex w-full flex-col gap-4 border-b border-gray-200 pb-4 sm:flex-row sm:gap-2 dark:border-gray-400">
    @if ($post['cover_image'])
        <div class="rounded-xs h-48 w-full overflow-hidden sm:h-28 sm:w-44">
            <img src="{{ $post['cover_image'] }}" alt="{{ $post['title'] }}"
                class="h-full w-full object-cover object-center transition-all duration-300 group-hover:scale-110">
        </div>
    @else
        <div
            class="rounded-xs flex h-48 w-full items-center justify-center overflow-hidden border-2 border-dashed border-gray-300 bg-gray-100 sm:h-28 sm:w-44">
            <div class="text-center">
                <x-heroicon-o-photo class="mx-auto mb-2 h-12 w-12 text-gray-400" />
                <p class="text-xs font-medium text-gray-500">Tidak ada gambar</p>
            </div>
        </div>
    @endif
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
