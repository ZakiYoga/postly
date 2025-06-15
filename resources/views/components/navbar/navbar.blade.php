<nav x-data="{ menuOpen: false }"
    class="bg-gray-50 dark:bg-gray-900 mx-auto flex w-full items-center justify-between py-2 tracking-widest z-40 flex-col-reverse lg:flex-row px-6 sm:px-8 md:px-10 lg:px-16 gap-2"
    aria-label="Global">
    <form class="flex items-center mr-auto w-full lg:w-72" action="/posts" method="GET">
        @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        @if (request('author'))
            <input type="hidden" name="author" value="{{ request('author') }}">
        @endif
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none p-2">
                <x-elemplus-search class="w-5 h-5 dark:text-gray-600 pb-0.5" />
            </div>
            <label for="search" class="sr-only">Search</label>
            <input type="search" id="search" name="search"
                class="font-bebas-neue rounded-sm block w-full p-2 pt-2.5 pl-9 text-sm text-gray-900 border-transparent bg-transparent focus:ring-gray-500 focus:border-primary-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="search article" autocomplete="off" />
        </div>
    </form>

    <div class="inline-flex items-center flex-wrap justify-center lg:justify-end gap-x-2 w-full text-sm/6 uppercase">
        <x-nav-link href="/" :active="request()->is('news')" class="">News</x-nav-link>
        @php
            $total = $categories->count(); // Karena $categories adalah Collection
        @endphp

        @foreach ($categories as $index => $category)
            @if ($index < $total - 3)
                <x-nav-link href="/posts?category={{ $category->slug }}" :active="request()->is('posts') && request('category') === $category->slug">
                    {{ $category->name }}
                </x-nav-link>
            @endif
        @endforeach

        <div class="relative">
            <button type="button" @click="menuOpen = !menuOpen"
                class="flex items-center font-bebas-neue uppercase gap-x-1 text-gray-500 hover:text-gray-700 group dark:text-gray-400 dark:hover:text-gray-300 active:text-primary"
                aria-expanded="false">
                More
                <svg :class="{ 'rotate-180': menuOpen }"
                    class="transition duration-150 size-5 flex-none text-gray-400 dark:group-hover:text-gray-300"
                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd"
                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <div x-show="menuOpen" x-transition:enter="transition ease-out duration-200 transform"
                x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150 transform"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute top-full -left-12 z-10 mt-3 overflow-hidden rounded-sm                                           bg-white ring-1 dark:bg-gray-900 shadow-lg ring-gray-900/5 border border-gray-300">
                <div class="p-4">
                    <ul class="space-y-2 my-0.5 w-full text-sm">
                        <li class="w-full">
                            @foreach ($categories as $index => $category)
                                @if ($index > $total - 4)
                                    <x-nav-link class="w-full" href="/posts?category={{ $category->slug }}"
                                        :active="request()->is('posts') && request('category') === $category->slug">
                                        {{ $category->name }}
                                    </x-nav-link>
                                @endif
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
