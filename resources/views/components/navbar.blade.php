<nav x-data="{ menuOpen: false }"
    class="bg-gray-50 dark:bg-[#393E46]/70 mx-auto flex w-full items-center justify-between py-2 tracking-widest z-40 flex-col lg:flex-row px-6 sm:px-8 md:px-10 lg:px-16 gap-2"
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
                class="font-bebas-neue block w-full p-2 pt-2.5 pl-9 text-sm text-gray-900 border-transparent bg-transparent focus:ring-gray-500 focus:border-primary-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="SEARCH article" autocomplete="off" />
        </div>
    </form>
    {{-- bg-amber-100 sm:bg-red-500 md:bg-violet-500 lg:bg-sky-800 --}}
    <div class="inline-flex items-center flex-wrap justify-center lg:justify-end gap-x-2 w-full text-sm/6 uppercase">
        <x-nav-link href="/" :active="request()->is('/')" class="">News</x-nav-link>
        <x-nav-link href="/about" :active="request()->is('about')" class="sm:flex hidden">Robotics</x-nav-link>
        <x-nav-link href="/contact" :active="request()->is('contact')" class="md:flex hidden">Space</x-nav-link>
        <x-nav-link href="/contact" :active="request()->is('contact')" class="md:flex hidden">Biotech</x-nav-link>
        <x-nav-link href="/contact" :active="request()->is('contact')" class="lg:flex hidden">AI</x-nav-link>
        <x-nav-link href="/contact" :active="request()->is('contact')" class="lg:flex hidden">Science</x-nav-link>
        <div class="relative">
            <button type="button" @click="menuOpen = !menuOpen"
                class="flex items-center font-bebas-neue uppercase gap-x-1 text-gray-900 dark:text-white active:text-primary hover:text-primary"
                aria-expanded="false">
                More
                <svg :class="{ 'rotate-180': menuOpen }" class="transition duration-150 size-5 flex-none text-gray-400"
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
                class="absolute top-full -left-12 z-10 mt-3 overflow-hidden bg-white ring-1 shadow-lg ring-gray-900/5">
                <div class="p-4">
                    <ul class="space-y-3 my-2 w-full text-sm">
                        <li><a href="/about" class="block p-2 hover:bg-gray-100 sm:hidden">Robotics</a></li>
                        <li><a href="/about" class="block p-2 hover:bg-gray-100 md:hidden">Space</a></li>
                        <li><a href="/about" class="block p-2 hover:bg-gray-100 md:hidden">Biotech</a></li>
                        <li><a href="/about" class="block p-2 hover:bg-gray-100 lg:hidden">AI</a></li>
                        <li><a href="/about" class="block p-2 hover:bg-gray-100 lg:hidden">Science</a></li>
                        <li><a href="/about" class="block p-2 hover:bg-gray-100">Culture</a></li>
                        <li><a href="/about" class="block p-2 hover:bg-gray-100">Travel</a></li>
                        <li><a href="/services" class="block p-2 hover:bg-gray-100">Programming</a></li>
                        <li><a href="/contact" class="block p-2 hover:bg-gray-100">Lifestyle</a></li>
                        <li><a href="/" class="block p-2 hover:bg-gray-100">Sport</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
