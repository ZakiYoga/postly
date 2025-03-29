<div x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" @click.outside="isOpen = false"
    class="fixed inset-y-0 left-0 w-72 h-screen bg-white dark:bg-background-foreground/80 backdrop-blur-xl shadow-lg transform transition-transform duration-300 ease-in-out z-[52]">
    <!-- Close Button -->
    <button @click="isOpen = false" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <!-- Menu Items -->
    <div class="flex flex-col h-screen pb-4">
        <nav class="mt-14 mb-2 px-4 flex flex-col items-start w-full overflow-y-auto">
            <div class="space-y-2 my-2 w-full">
                <div
                    class="inline-flex mb-2 items-center text-xs text-gray-400 gap-2 uppercase font-bebas-neue tracking-[0.2em]">
                    <span class="h-[1px] w-6 bg-primary"></span>
                    Navigation
                </div>
                <x-nav-link href="/" :active="request()->is('/')"
                    class="font-bebas-neue font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    Homepage
                </x-nav-link>
                <x-nav-link href="/posts" :active="request()->is('posts')"
                    class="font-bebas-neue font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    Blog
                </x-nav-link>
                <x-nav-link href="/about" :active="request()->is('about')"
                    class="font-bebas-neue font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    About
                </x-nav-link>
                <x-nav-link href="/contact" :active="request()->is('contact')"
                    class="font-bebas-neue font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    Contact
                </x-nav-link>
                <x-nav-link href="/" :active="request()->is('#subscribe')"
                    class="flex sm:hidden font-bebas-neue font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    Subcribe
                </x-nav-link>
            </div>
            <ul class="space-y-2 my-2 w-full tracking-widest">
                <li
                    class="inline-flex mb-2 items-center text-xs text-gray-400 gap-2 uppercase font-bebas-neue tracking-[0.2em]">
                    <span class="h-[1px] w-6 bg-primary"></span>
                    dashboard
                </li>
                <li><a href="/" class="block p-2 font-bebas-neue hover:bg-gray-100 hover:text-primary">
                        Profiles</a>
                </li>
                <li><a href="/contact" class="block p-2 font-bebas-neue hover:bg-gray-100 hover:text-primary">
                        My Posts</a>
                </li>
                <li><a href="/about" class="block p-2 font-bebas-neue hover:bg-gray-100 hover:text-primary">
                        Account</a>
                </li>
                <li><a href="/services" class="block p-2 font-bebas-neue hover:bg-gray-100 hover:text-primary">
                        Settings</a>
                </li>
            </ul>
        </nav>
        <div class="mt-auto mx-4 pt-2 border-t border-gray-200 dark:border-gray-700">
            <button class="flex justify-between w-full font-bebas-neue p-2 hover:bg-gray-100">
                Logout
                <x-heroicon-o-arrow-left-end-on-rectangle class="w-6 h-6 font-semibold" />
            </button>
            {{-- <button class="flex justify-between w-full text-let p-2 hover:bg-gray-100">
                Logout
                <x-heroicon-o-arrow-right-end-on-rectangle />
            </button> --}}
        </div>
    </div>
</div>
<!-- Backdrop Overlay -->
<div x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-50" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-50" x-transition:leave-end="opacity-0" @click="isOpen = false"
    class="fixed inset-0 bg-black z-[51] w-full h-screen" style="opacity: 0.5;">
</div>
