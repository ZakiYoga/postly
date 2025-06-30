<div x-show="isOpen" x-cloak @click.outside="isOpen = false"
    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="-translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-300 transform"
    x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-full opacity-0"
    class="fixed inset-y-0 left-0 z-[52] h-screen w-72 bg-white shadow-lg backdrop-blur-xl dark:bg-gray-900">
    <!-- Close Button -->
    <button @click="isOpen = false" class="absolute right-4 top-4 text-gray-600 hover:text-gray-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <!-- Menu Items -->
    <div class="flex h-screen flex-col pb-4">
        <nav class="mb-2 mt-14 flex w-full flex-col items-start overflow-y-auto px-4">
            <div class="my-2 flex w-full flex-col gap-2">
                <div
                    class="font-bebas-neue mb-2 inline-flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-gray-400">
                    <span class="bg-primary h-[1px] w-6"></span>
                    Menu
                </div>
                <x-nav-link @click="isOpen = !isOpen" href="/" :active="request()->is('/')"
                    class="font-bebas-neue border-none font-thin hover:bg-gray-100 md:text-lg dark:hover:bg-gray-900">
                    Homepage
                </x-nav-link>
                <x-nav-link @click="isOpen = !isOpen" href="/posts" :active="request()->is('posts*')"
                    class="font-bebas-neue border-none font-thin hover:bg-gray-100 md:text-lg dark:hover:bg-gray-900">
                    Blog
                </x-nav-link>
                <div x-data="navigationHandler()">
                    <x-nav-link @click="navigateToSection('category-section')" href="/#category-section"
                        :active="false"
                        class="font-bebas-neue w-full border-none font-thin hover:bg-gray-100 md:text-lg dark:hover:bg-gray-900">
                        Categories
                    </x-nav-link>
                </div>
                <x-nav-link @click="isOpen = !isOpen" href="/about" :active="request()->is('about')"
                    class="font-bebas-neue border-none font-thin hover:bg-gray-100 md:text-lg dark:hover:bg-gray-900">
                    About
                </x-nav-link>
                <x-nav-link @click="isOpen = !isOpen" href="/contact" :active="request()->is('contact')"
                    class="font-bebas-neue border-none font-thin hover:bg-gray-100 md:text-lg dark:hover:bg-gray-900">
                    Contact
                </x-nav-link>
                <x-nav-link @click="isOpen = !isOpen" href="/" :active="request()->is('#subscribe')"
                    class="font-bebas-neue flex border-none font-thin hover:bg-gray-100 sm:hidden md:text-lg dark:hover:bg-gray-900">
                    Subcribe
                </x-nav-link>
            </div>
            @auth
                <div class="my-2 flex w-full flex-col gap-2">
                    <div
                        class="font-bebas-neue mb-2 inline-flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-gray-400">
                        <span class="bg-primary h-[1px] w-6"></span>
                        Dashboard
                    </div>
                    <x-nav-link @click="isOpen = !isOpen"
                        href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard' : '/dashboard' }}" :active="Auth::user()->role == 'admin'
                            ? request()->is('admin/dashboard')
                            : request()->is('dashboard')"
                        class="font-bebas-neue border-none font-thin hover:bg-gray-100 md:text-lg dark:hover:bg-gray-900">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link @click="isOpen = !isOpen"
                        href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard/settings' : '/dashboard/settings' }}"
                        :active="Auth::user()->role == 'admin'
                            ? request()->is('admin/dashboard/settings')
                            : request()->is('dashboard/settings')"
                        class="font-bebas-neue border-none font-thin hover:bg-gray-100 md:text-lg dark:hover:bg-gray-900">
                        settings
                    </x-nav-link>
                </div>
            @endauth
        </nav>

        <div class="mt-auto border-t border-gray-200 px-4 pt-4 dark:border-gray-700">
            @auth
                <form method="POST" action="{{ route('logout') }}"
                    class="hover:bg group inline-flex w-full items-center justify-between hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    @csrf
                    <a class="w-full" href="/profile">
                        <div class="inline-flex w-full items-center gap-2 text-gray-400">
                            <div class="h-full w-full max-w-9">
                                <x-user-avatar :user="auth()->user()" size="w-9 h-9" class="rounded-sm" />
                            </div>
                            <div class="w-full space-y-1">
                                <p class="font-bebas-neue w-full text-sm tracking-wider text-gray-900 dark:text-gray-200">
                                    {{ Auth::user()->username }}
                                </p>
                                <p class="font-bebas-neue text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>
                    </a>
                    <label for="logout" class="sr-only">Logout</label>
                    <button type="submit" name="logout" id="logout"
                        class="mb-0.5 p-2 hover:border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:border-gray-700 dark:hover:bg-gray-900 dark:hover:text-gray-300">
                        <x-heroicon-o-arrow-right-start-on-rectangle class="h-6 w-6" />
                    </button>
                </form>
            @else
                <x-nav-link href="{{ route('login') }}"
                    class="text-let flex w-full justify-between border-none p-2 hover:bg-gray-100 dark:hover:bg-gray-900">
                    sign in
                    <x-heroicon-o-arrow-right-end-on-rectangle class="h-6 w-6 font-semibold" />
                </x-nav-link>
            @endauth
        </div>
    </div>
</div>
<!-- Backdrop Overlay -->
<div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-50" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-50" x-transition:leave-end="opacity-0" @click="isOpen = false"
    class="fixed inset-0 z-[51] h-screen w-full bg-black" style="opacity: 0.5;">
</div>
