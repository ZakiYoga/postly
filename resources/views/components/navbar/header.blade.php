<header
    class="grid place-self-center w-full sticky top-0 bg-background/50 dark:bg-background-foreground/50 backdrop-blur-xl z-50">
    <div class="w-full h-fit flex items-center justify-between py-4 px-6 sm:px-8 md:px-10 lg:px-16">
        <!-- Hamburger Button and Mobile Menu -->
        <div x-data="{ isOpen: false }" class="relative">
            <!-- Hamburger Button -->
            <button @click="isOpen = !isOpen" type="button"
                class="-m-2.5 flex items-center justify-center gap-3 rounded-md p-2.5 text-gray-700 dark:text-white group hover:cursor-pointer z-50">
                <span class="sr-only">Open main menu</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4h16.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5" />
                </svg>
                <span
                    class="uppercase font-bebas-neue text-xs sm:text-sm font-semibold tracking-[0.2em] group-hover:tracking-[0.26em] transition-all duration-200 mr-1 group-hover:mr-0">
                    menu
                </span>
            </button>

            <x-navbar.header-menu></x-navbar.header-menu>

        </div>
        <div class="inline-flex relative">
            <a href="/"
                class="ml-2 xs:ml-4 lg:ml-10 text-4xl md:text-5xl lg:text-[64px] tracking-wider font-bebas-neue dark:text-white">
                Postly
                <span
                    class="h-1.5 sm:h-2 md:h-3 w-[60%] bg-primary absolute bottom-3 lg:bottom-4 left-1/3 md:left-[45%] -translate-x-1/2 -z-10"></span>
            </a>
        </div>
        <div class="flex items-center gap-2 md:gap-2 font-bebas-neue tracking-wider text-base/4">
            @auth
                <span class="font-bebas-neue items-center dark:text-white text-sm/6 hidden sm:inline-flex gap-2">
                    <x-user-avatar :user="auth()->user()" size="w-8 h-8" class="shadow-md" />
                    <p>{{ auth()->user()->username }}</p>
                </span>
            @else
                <a href="/login" class="inline-flex items-center uppercase underline dark:text-white">
                    Sign In
                    <x-heroicon-o-arrow-right-end-on-rectangle class="ml-0.5 w-6 h-6" />
                </a>
            @endauth
            <a href="#subscribe" id="subscribe"
                class="inline-flex items-center rounded-xs font-bebas-neue px-4 py-2 bg-primary dark:bg-gray-200 border dark:border-gray-900 shadow-[3px_3px_0px_#000] dark:shadow-[2px_2px_0px_#111827] active:translate-0.5 active:shadow-none text-xs dark:text-gray-800 uppercase tracking-widest hover:bg-primary/80 dark:hover:bg-gray-700 active:bg-primary/80 dark:active:bg-gray-300 focus:outline-none transition ease-in-out duration-150">
                Subscribe
            </a>
            <x-primary-button id="theme-toggle"
                class="p-2.5 py-2 border bg-transparent hover:!bg-gray-300/50 dark:border-gray-500 dark:bg-gray-800">
                <span id="theme-toggle-light" class="hidden">🌞</span>
                <span id="theme-toggle-dark">🌙</span>
            </x-primary-button>
        </div>
    </div>
    <x-navbar.navbar />
    </div>
</header>
