<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <x-headingPost title="Blog" :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Posts', 'url' => '/posts']]" />

    <section
        class="flex justify-between gap-4 lg:gap-6 w-full h-fit mx-auto pb-4 px-4 py-6 lg:px-8 lg:py-12 shadow-sm bg-white dark:bg-gray-900">
        <div class="flex w-full flex-col gap-y-4 ">
            <article
                class="flex flex-col py-2 px-4 lg:px-8 mx-auto w-full md:h-[calc(100vh-6rem)] max-w-lg lg:max-w-xl border-b border-gray-200 dark:border-gray-700">
                @if ($post->cover_image || $post->unsplash_image_url)
                    <div class="w-full h-64 lg:h-96 rounded overflow-hidden mb-2">
                        @if ($post->cover_image)
                            <img src="{{ asset('storage/' . $post->cover_image) }}"
                                alt="Cover image for {{ $post->title }}"
                                class="object-cover object-center w-full h-full" />
                        @else
                            <img src="{{ $post->unsplash_image_url }}"
                                alt="Unsplash image for {{ optional($post->category)->name ?? 'kategori' }}"
                                class="object-cover object-center w-full h-full" />
                        @endif
                    </div>
                @endif
                <header class="mb-4">
                    <h1 class="text-3xl font-extrabold leading-tight text-gray-900 lg:text-4xl dark:text-white">
                        {{ $post->title }}
                    </h1>
                    <p class="text-gray-500 dark:text-gray-700">
                        By
                        <a href="/posts?author={{ $post->author->username }}"
                            class="hover:text-primary hover:underline">
                            {{ $post->author->name }}
                        </a>
                        in
                        <a href="/posts?category={{ $post->category->slug }}"
                            class="hover:text-primary hover:underline">
                            {{ $post->category->name }},
                        </a>
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </header>
                <p>
                    {{ $post->body }}
                </p>

                <div class="mt-auto py-4 inline-flex items-center gap-2 not-format">
                    <h5 class="pl-2 leading-6 border-l-4 border-primary font-bebas-neue tracking-wider mr-2">
                        SHARE
                    </h5>
                    {{-- Facebook --}}
                    <a href="#"
                        class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-blue-700">
                        <svg class="w-4 h-4 text-gray-100 fill-current" viewBox="0 0 50 50">
                            <path
                                d="M32,11h5c0.552,0,1-0.448,1-1V3.263c0-0.524-0.403-0.96-0.925-0.997C35.484,2.153,32.376,2,30.141,2C24,2,20,5.68,20,12.368 V19h-7c-0.552,0-1,0.448-1,1v7c0,0.552,0.448,1,1,1h7v19c0,0.552,0.448,1,1,1h7c0.552,0,1-0.448,1-1V28h7.222 c0.51,0,0.938-0.383,0.994-0.89l0.778-7C38.06,19.518,37.596,19,37,19h-8v-5C29,12.343,30.343,11,32,11z" />
                        </svg>
                    </a>


                    {{-- Instagram --}}
                    <a href="#"
                        class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-gradient-to-tr from-pink-500 via-red-500 to-yellow-500">
                        <svg class="w-4 h-4 text-gray-100 fill-current" xmlns="http://www.w3.org/2000/svg" x="0px"
                            y="0px" width="50" height="50" viewBox="0 0 50 50">
                            <path
                                d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z">
                            </path>
                        </svg>
                    </a>

                    {{-- X --}}
                    <a href="#"
                        class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-gray-950">
                        <svg class="w-4 h-4 text-gray-100 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 30 30" width="50px" height="50px">
                            <path
                                d="M26.37,26l-8.795-12.822l0.015,0.012L25.52,4h-2.65l-6.46,7.48L11.28,4H4.33l8.211,11.971L12.54,15.97L3.88,26h2.65 l7.182-8.322L19.42,26H26.37z M10.23,6l12.34,18h-2.1L8.12,6H10.23z" />
                        </svg>
                    </a>
                </div>
            </article>
            <div>
                <h2 class="font-bebas-neue tracking-wider">Comments</h2>
                <div class="flex flex-col items-start">
                    <div class="flex items-center gap-x-2">
                        <img class="w-7 h-7 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                            alt="avatar-{{ $post->author->username }}" />
                        <div class="flex flex-col gap-2">
                            <p>{{ $post->author->username }}</p>
                            <p>timestamp comments</p>
                        </div>
                    </div>
                    <div class="">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga temporibus, modi assumenda ullam quod ut iure libero? Fugiat earum, vero nulla ducimus dignissimos, a totam saepe labore iure, ex asperiores?</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-y-6">
            {{-- Search --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-xs w-full lg:w-72">
                <form class="flex items-center mr-auto w-full" action="/posts" method="GET">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none p-2">
                            <x-elemplus-search class="w-5 h-5 dark:text-gray-600 pb-0.5" />
                        </div>
                        <label for="search" class="sr-only">Search</label>
                        <input type="search" id="search" name="search"
                            class="font-bebas-neue block w-full p-2 pt-2.5 pr-9 text-sm text-gray-900 border-transparent bg-transparent focus:ring-gray-500 focus:border-primary-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="search article" autocomplete="off" />
                    </div>
                </form>
            </div>

            {{-- categories --}}
            <div class="flex flex-col gap-y-4 bg-background p-4">
                <x-heading size="xl">Categories</x-heading>
                <ul class="space-y-4">
                    @foreach ($categories as $index => $category)
                        @if ($index < 5)
                            <li
                                class="inline-flex gap-x-0.5 w-full relative border-b border-gray-200 dark:border-gray-700 pb-1 group">
                                <x-eva-corner-down-right
                                    class="absolute left-0 opacity-0 hidden transition-all duration-300 group-hover:opacity-100 group-hover:block w-4 h-4" />
                                <a href="/posts?category={{ $category->slug }}"
                                    class="w-full group-hover:pl-4 transition-all duration-300 hover:text-primary text-gray-800 dark:text-gray-200">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- popularpost --}}
            <div class="flex flex-col gap-y-4 p-4">
                <x-heading size="xl">
                    Popular Posts
                </x-heading>
                <div class="inline-flex gap-2 items-center">
                    <img src="/images/article-1.png" alt="article"
                        class="object-center object-cover w-14 aspect-square" />
                    <div class="space-y-2">
                        <h4 class="font-semibold">Lorem ipsum dolor, sit amet consectetur</h4>
                        <p class="text-sm text-gray-400 dark:text-gray-200">4 days ago</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
