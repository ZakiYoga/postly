<header class="dark:bg-background-foreground/20 h-16 border-b border-gray-200 bg-white shadow-md dark:border-gray-500">
    <div class="flex h-full items-center justify-between px-6">
        <div class="flex items-center space-x-4">
            <!-- Toggle Button -->
            <button @click="toggleSidebar()" class="text-gray-600 focus:outline-none dark:text-white">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7">
                    </path>
                </svg>
            </button>

            <div>
                <h1 class="font-bebas-neue text-lg font-semibold tracking-wider text-gray-900 dark:text-white">Dashboard
                </h1>
                <div class="text-sm leading-4 text-gray-500">
                    {{ date('l, j F Y') }}
                </div>
            </div>
        </div>

        <!-- Right: Notification & User Profile -->
        <div class="flex items-center space-x-2">
            <button class="relative text-gray-900 focus:outline-none dark:text-gray-200">
                <span class="absolute right-0 top-0 h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                <x-heroicon-o-bell class="h-6 w-6" />
            </button>

            <!-- User Profile -->
            <div class="flex items-center space-x-2">
                <x-dropdown width="32" class="w-28 border-none">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center rounded-md border border-transparent bg-transparent p-1 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:text-gray-300">
                            <div class="flex items-center gap-1">
                                @auth
                                    <div class="font-bebas-neue hidden uppercase tracking-wide sm:block">
                                        {{ Auth::user()->username }}
                                    </div>

                                    <div class="relative mx-0.5">
                                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <x-user-avatar :user="auth()->user()" size="w-8 h-8" class="shadow-md" />
                                @endauth
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content" class="mt-4">
                        <x-dropdown-link
                            href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard/settings' : '/dashboard/settings' }}"
                            :active="Auth::user()->role == 'admin'
                                ? request()->is('admin/dashboard/settings')
                                : request()->is('dashboard/settings')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Toggle Theme --}}
            <button id="theme-toggle"
                class="rounded-xs hidden border border-gray-200 bg-transparent px-1.5 py-1 hover:bg-gray-300/50 sm:block dark:border-gray-500 dark:bg-gray-900 dark:hover:bg-gray-800">
                <span id="theme-toggle-light" class="hidden">🌞</span>
                <span id="theme-toggle-dark">🌙</span>
            </button>
        </div>
    </div>
</header>
