<header class="bg-white dark:bg-background-foreground/20 shadow-md h-16 border-b border-gray-200 dark:border-gray-500">
    <div class="flex items-center justify-between px-6 h-full">
        <div class="flex items-center space-x-4">
            <!-- Toggle Button -->
            <button @click="toggleSidebar()" class="text-gray-600 dark:text-white focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7">
                    </path>
                </svg>
            </button>

            <div>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white font-bebas-neue tracking-wider">Dashboard</h1>
                <div class="text-gray-500 text-sm leading-4">
                    {{ date('l, j F Y') }}
                </div>
            </div>
        </div>

        <!-- Right: Notification & User Profile -->
        <div class="flex items-center space-x-2">
            <button class="text-gray-900 dark:text-gray-200 focus:outline-none relative">
                <span class="absolute top-0 right-0 w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                <x-heroicon-o-bell class="h-6 w-6" />
            </button>

            <!-- User Profile -->
            <div class="flex items-center space-x-2">
                <x-dropdown width="32" class="border-none w-28">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center p-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-transparent hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-1">
                                @auth
                                <div class="hidden sm:block font-bebas-neue tracking-wide uppercase">
                                    {{ Auth::user()->username }}
                                </div>

                                <div class="mx-0.5 relative">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <x-user-avatar :user="auth()->user()" size="w-8 h-8" class="shadow-md" />
                                @endauth
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content" class="mt-4">
                        <x-dropdown-link href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard/settings' : '/dashboard/settings' }}" :active="Auth::user()->role == 'admin'
                            ? request()->is('admin/dashboard/settings')
                            : request()->is('dashboard/settings')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Toggle Theme --}}
            <button id="theme-toggle" class="px-1.5 py-1 border rounded-xs border-gray-200 bg-transparent hover:bg-gray-300/50 dark:hover:bg-gray-800 dark:border-gray-500 dark:bg-gray-900">
                <span id="theme-toggle-light" class="hidden">🌞</span>
                <span id="theme-toggle-dark">🌙</span>
            </button>
        </div>
    </div>
</header>
