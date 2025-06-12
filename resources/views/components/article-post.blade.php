@props(['post'])

<article class="flex flex-col sm:flex-row gap-4 sm:gap-2 group w-full">
    <div class="w-full sm:w-44 h-48 sm:h-28 rounded-xs overflow-hidden">
        <img src="/images/article-1.png" alt="{{ $post->title }}"
            class="group-hover:scale-110 transition-all duration-300 w-full h-full object-cover object-center">
    </div>
    <div class="space-y-2 w-full h-full group">
        <div class="inline-flex items-center text-sm/normal gap-2 font-bebas-neue dark:text-gray-200">
            <a href="/posts?category={{ $post->category->slug }}"
                class="tracking-wider rounded-xs p-0.5 px-1.5 text-[{{ $post->category->color }}] bg-[{{ $post->category->color }}]/15 group-hover:bg-[{{ $post->category->color }}] group-hover:text-white shadow-inner transition-all duration-500">
                {{ $post->category->name }}
            </a>
            <div class="w-5 h-0.5 bg-gray-200"></div>
            <p class="tracking-wider text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
        </div>
        <div class="text-lg font-semibold dark:text-white">
            <a href="/posts/{{ $post->slug }}" class="hover:text-[{{ $post->category->color }}]">
                {{ Str::limit($post->title, 60) }}
            </a>
        </div>
        <a href="/posts/{{ $post->slug }}"
            class="relative overflow-hidden inline-flex items-center gap-1 uppercase underline tracking-wider font-bebas-neue mt-auto dark:text-white hover:text-gray-900/80">
            More
            <x-fas-arrow-right class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
        </a>
    </div>
</article>
