<header class="grid place-self-center w-full sticky top-0 backdrop-blur-xl z-50">
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
                    class="uppercase font-bebas-neue sm:text-sm font-semibold tracking-[0.2em] group-hover:tracking-[0.26em] transition-all duration-200 mr-1 group-hover:mr-0">
                    menu
                </span>
            </button>
            <x-header-menu></x-header-menu>
        </div>
        <div class="inline-flex relative">
            <h1 class="uppercase text-4xl md:text-5xl lg:text-[64px] tracking-wider font-bebas-neue dark:text-white">
                Postly
                <span class="h-3 w-[70%] bg-primary absolute bottom-4 left-[32%] -translate-x-1/2 -z-10"></span>
            </h1>
        </div>
        <div class="flex items-center justify-end gap-2 sm:gap-1 font-bebas-neue tracking-wider text-base/4">
            <a href="/login" class="uppercase mr-2 underline dark:text-white">
                Sign In
            </a>
            <a href="/login"
                class="hidden sm:flex bg-primary hover:bg-primary/80 px-2.5 py-2 border-2 shadow-[2px_2px_0px_#000] active:translate-0.5 active:shadow-none">
                Subscribe
            </a>
            <button id="theme-toggle"
                class="p-2.5 border-2 shadow-[2px_2px_0px_#000] active:translate-0.5 active:shadow-none">
                <span id="theme-toggle-light" class="hidden">🌞</span>
                <span id="theme-toggle-dark">🌙</span>
            </button>
        </div>
    </div>
    <x-navbar></x-navbar>
    </div>
</header>
