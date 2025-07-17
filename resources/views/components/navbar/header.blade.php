<header
    class="bg-background/50 dark:bg-background-foreground/50 sticky top-0 z-50 grid w-full place-self-center backdrop-blur-xl">
    <div class="flex h-fit w-full items-center justify-between px-6 py-4 sm:px-8 md:px-10 lg:px-16">
        <!-- Hamburger Button and Mobile Menu -->
        <div x-data="{ isOpen: false }" class="relative">
            <!-- Hamburger Button -->
            <button @click="isOpen = !isOpen" type="button"
                class="group z-50 -m-2.5 flex items-center justify-center gap-3 rounded-md p-2.5 text-gray-700 hover:cursor-pointer dark:text-white">
                <span class="sr-only">Open main menu</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4h16.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5" />
                </svg>
                <span
                    class="font-bebas-neue mr-1 hidden text-xs font-semibold uppercase tracking-[0.2em] transition-all duration-200 group-hover:mr-0 group-hover:tracking-[0.26em] sm:flex sm:text-sm">
                    menu
                </span>
            </button>

            <x-navbar.header-menu></x-navbar.header-menu>

        </div>
        <div class="relative inline-flex">
            <a href="/"
                class="xs:ml-4 font-bebas-neue ml-2 text-4xl tracking-wider md:text-5xl lg:ml-10 lg:text-[64px] dark:text-white">
                Postly
                <span
                    class="bg-primary absolute bottom-3 left-1/3 -z-10 h-1.5 w-[60%] -translate-x-1/2 sm:h-2 md:left-[45%] md:h-3 lg:bottom-4"></span>
            </a>
        </div>
        <div class="font-bebas-neue flex items-center gap-2 text-base/4 tracking-wider md:gap-2">
            @auth
                <span class="font-bebas-neue hidden items-center gap-2 text-sm/6 sm:inline-flex dark:text-white">
                    <x-user-avatar :user="auth()->user()" size="w-8 h-8" class="shadow-md" />
                    <p>{{ auth()->user()->username }}</p>
                </span>
            @else
                <a href="/login" class="hidden items-center uppercase underline sm:inline-flex dark:text-white">
                    Sign In
                    <x-heroicon-o-arrow-right-end-on-rectangle class="ml-0.5 h-6 w-6" />
                </a>
            @endauth
            <a href="#subscribe" id="subscribe"
                class="rounded-xs font-bebas-neue bg-primary active:translate-0.5 hover:bg-primary/80 active:bg-primary/80 hidden items-center border px-4 py-2 text-xs uppercase tracking-widest shadow-[3px_3px_0px_#000] transition duration-150 ease-in-out focus:outline-none active:shadow-none sm:inline-flex dark:border-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:shadow-[2px_2px_0px_#111827] dark:hover:bg-gray-700 dark:active:bg-gray-300">
                Subscribe
            </a>
            <button id="theme-toggle"
                class="rounded-xs active:translate-0.5 border bg-transparent px-4 py-2 shadow-[3px_3px_0px_#000] transition duration-150 ease-in-out hover:bg-gray-300/50 focus:outline-none active:shadow-none dark:text-gray-800 dark:shadow-[2px_2px_0px_#111827] dark:active:bg-gray-300">
                <span id="theme-toggle-light" class="hidden">🌞</span>
                <span id="theme-toggle-dark">🌙</span>
            </button>
        </div>
    </div>
    <x-navbar.navbar />
    </div>
</header>
