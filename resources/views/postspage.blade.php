<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="h-fit mt-4 mx-auto px-6 sm:px-8 md:px-10 lg:px-16">
        <div
            class="mx-auto w-full text-center py-6 lg:py-8 px-4 lg:px-8 lg:mb-4 mb-2 bg-white border border-gray-200 shadow-md dark:bg-gray-900 dark:border-gray-700 transition-all duration-300">
            <h2
                class="mb-2 text-2xl font-bebas-neue tracking-wider lg:text-4xl font-semibold text-gray-900 dark:text-white">
                {{ $title }}
            </h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">
                {{ $description }}
            </p>
        </div>
        @if (request('category') || request('search') || request('author'))
            <p class="dark:text-white py-4">
                @if (request('category') && request('search'))
                    Found {{ $count }} {{ Str::plural('article', $count) }} in the
                    <span class="text-primary">"{{ request('category') }}"</span>
                    category matching
                    <span class="text-primary">"{{ request('search') }}"</span>
                @elseif(request('author') && request('search'))
                    Found {{ $count }} {{ Str::plural('article', $count) }} by
                    <span class="text-primary">"{{ request('author') }}"</span>
                    matching
                    <span class="text-primary">"{{ request('search') }}"</span>
                @elseif(request('category'))
                    Found {{ $count }} {{ Str::plural('article', $count) }} in category
                    <span class="text-primary">"{{ request('category') }}"</span>
                @elseif(request('author'))
                    Found {{ $count }} {{ Str::plural('article', $count) }} by
                    <span class="text-primary">"{{ request('author') }}"</span>
                @elseif(request('search'))
                    Found {{ $count }} {{ Str::plural('article', $count) }} for
                    <span class="text-primary">"{{ request('search') }}"</span>
                @else
                    Found {{ $count }} {{ Str::plural('article', $count) }}
                @endif
            </p>
        @else
            <div></div>
        @endif


        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article
                    class="p-6 bg-white border border-gray-200 shadow-md dark:bg-gray-900 dark:border-gray-700 group relative overflow-hidden transition-all duration-300">

                    <div
                        class="absolute top-0 left-0 w-full h-0 group-hover:h-[50%] transition-all duration-500 ease-in-out overflow-hidden">
                        <div class="shadow-gradient">
                            <img src="/images/article-1.png" alt="article" class="w-full h-auto">
                        </div>
                    </div>

                    <div class="relative z-10 transition-all duration-500 group-hover:mt-[calc(50%-1.5rem)]">
                        <div class="flex justify-between items-center mb-5 text-gray-500 mt-2 ">
                            <a href="/posts?category={{ $post->category->slug }}"
                                class="text-[{{ $post->category->color }}] bg-[{{ $post->category->color }}]/15 group-hover:bg-[{{ $post->category->color }}] group-hover:text-white hover:underline shadow-inner transition-all duration-200 text-xs font-medium font-bebas-neue tracking-widest inline-flex items-center px-2.5 py-2 dark:bg-primary-200 dark:text-primary-800">
                                {{ $post->category->name }}
                            </a>
                            <span class="text-sm font-bebas-neue group-hover:text-white">
                                {{ $post->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <a href="/posts/{{ $post->slug }}">
                            <h2
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-[{{ $post->category->color }}]">
                                {{ $post->title }}
                            </h2>
                        </a>
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                            {{ Str::limit($post->body, 150) }}
                        </p>
                        <div class="flex justify-between items-center">
                            <a href="/posts?author={{ $post->author->username }}"
                                class="font-medium tracking-wide dark:text-white font-bebas-neue text-sm">
                                <div class="flex items-center gap-x-2">
                                    <img class="w-7 h-7 rounded-full"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                        alt="avatar-{{ $post->author->name }}" />
                                    {{ $post->author->name }}
                                </div>
                            </a>
                            <a href="/posts/{{ $post->slug }}"
                                class="inline-flex gap-2 tracking-wider text-sm items-center font-bebas-neue font-medium text-primary-600 dark:text-primary-500 hover:underline dark:text-white">
                                Read more
                                <x-fas-arrow-right
                                    class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-600" />
                            </a>
                        </div>
                    </div>
                </article>

            @empty
                <div
                    class="flex flex-col items-start justify-start col-span-3 p-6 min-h-[30vh] bg-white border border-gray-200 shadow-md dark:bg-gray-900 dark:border-gray-700">
                    <h1 class="text-2xl text-gray-900 dark:text-white">Article not found!</h1>
                    <a href="/posts"
                        class="inline-flex mt-auto font-bebas-neue items-center gap-2 px-3 py-2 bg-primary hover:bg-primary/80 text-gray-900 shadow-md">
                        <x-fas-arrow-left class="w-4 h-4 pb-0.5" />
                        Back to All Posts
                    </a>
                </div>
            @endforelse
        </div>

        {{ $posts->links() }}
    </section>
</x-layout>
