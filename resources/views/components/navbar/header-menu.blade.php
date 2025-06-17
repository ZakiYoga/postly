<div x-show="isOpen" x-cloak @click.outside="isOpen = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-full opacity-0" class="fixed inset-y-0 left-0 w-72 h-screen bg-white dark:bg-background-foreground/80 backdrop-blur-xl shadow-lg z-[52]">
    <!-- Close Button -->
    <button @click="isOpen = false" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <!-- Menu Items -->
    <div class="flex flex-col h-screen pb-4">
        <nav class="mt-14 mb-2 px-4 flex flex-col items-start w-full overflow-y-auto">
            <div class="flex flex-col gap-2 my-2 w-full ">
                <div class="inline-flex mb-2 items-center text-xs text-gray-400 gap-2 uppercase font-bebas-neue tracking-[0.2em]">
                    <span class="h-[1px] w-6 bg-primary"></span>
                    Menu
                </div>
                <x-nav-link @click="isOpen = !isOpen" href="/" :active="request()->is('/')" class="font-bebas-neue md:text-lg font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    Homepage
                </x-nav-link>
                <x-nav-link @click="isOpen = !isOpen" href="/posts" :active="request()->is('posts*')" class="font-bebas-neue md:text-lg font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    Blog
                </x-nav-link>
                <x-nav-link @click="isOpen = !isOpen" href="/about" :active="request()->is('about')" class="font-bebas-neue md:text-lg font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    About
                </x-nav-link>
                <x-nav-link @click="isOpen = !isOpen" href="/contact" :active="request()->is('contact')" class="font-bebas-neue md:text-lg font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    Contact
                </x-nav-link>
                <x-nav-link @click="isOpen = !isOpen" href="/" :active="request()->is('#subscribe')" class="flex sm:hidden md:text-lg font-bebas-neue font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    Subcribe
                </x-nav-link>
            </div>
            @auth
            <div class="flex flex-col gap-2 my-2 w-full ">
                <div class="inline-flex mb-2 items-center text-xs text-gray-400 gap-2 uppercase font-bebas-neue tracking-[0.2em]">
                    <span class="h-[1px] w-6 bg-primary"></span>
                    Dashboard
                </div>
                <x-nav-link @click="isOpen = !isOpen" href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard' : '/dashboard' }}" :active="Auth::user()->role == 'admin'
                            ? request()->is('admin/dashboard')
                            : request()->is('dashboard')" class="font-bebas-neue md:text-lg font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    Dashboard
                </x-nav-link>
                <x-nav-link @click="isOpen = !isOpen" href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard/settings' : '/dashboard/settings' }}" :active="Auth::user()->role == 'admin'
                            ? request()->is('admin/dashboard/settings')
                            : request()->is('dashboard/settings')" class="font-bebas-neue md:text-lg font-thin border-none hover:bg-gray-100 dark:hover:bg-gray-900">
                    settings
                </x-nav-link>
            </div>
            @endauth
        </nav>

        <div class="mt-auto px-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            @auth
            <form method="POST" action="{{ route('logout') }}" class="inline-flex group hover:bg items-center w-full justify-between dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 ">
                @csrf
                <a class="w-full" href="/profile">
                    <div class="inline-flex w-full items-center gap-2 text-gray-400">
                        <div class="w-full h-full max-w-9">
                            <x-user-avatar :user="auth()->user()" size="w-9 h-9" class="rounded-sm" />
                        </div>
                        <div class="space-y-1 w-full">
                            <p class="w-full text-sm tracking-wider font-bebas-neue text-gray-900 dark:text-gray-200">
                                {{ Auth::user()->username }}
                            </p>
                            <p class="text-xs tracking-wide font-bebas-neue text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                </a>
                <label for="logout" class="sr-only">Logout</label>
                <button type="submit" name="logout" id="logout" class="p-2 mb-0.5 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:bg-gray-900 dark:hover:border-gray-700 hover:bg-gray-100 ">
                    <x-heroicon-o-arrow-right-start-on-rectangle class="w-6 h-6" />
                </button>
            </form>
            @else
            <x-nav-link href="{{ route('login') }}" class="flex justify-between border-none w-full text-let p-2 hover:bg-gray-100 dark:hover:bg-gray-900">
                sign in
                <x-heroicon-o-arrow-right-end-on-rectangle class="w-6 h-6 font-semibold" />
            </x-nav-link>
            @endauth
        </div>
    </div>
</div>
<!-- Backdrop Overlay -->
<div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-50" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-50" x-transition:leave-end="opacity-0" @click="isOpen = false" class="fixed inset-0 bg-black z-[51] w-full h-screen" style="opacity: 0.5;">
</div>
