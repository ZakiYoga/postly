<!-- Sidebar -->
<div x-cloak :class="sidebarOpen ? 'w-0 md:w-56' : 'w-20'"
    class="dark:bg-background-foreground/20 flex h-full flex-col overflow-hidden overflow-x-hidden bg-white pb-2 shadow-md transition-all duration-300">

    <!-- Logo -->
    <div class="flex h-16 items-center justify-center border-b border-gray-200 py-6 shadow-sm dark:border-gray-500">
        <a href="{{ route('front.homepage') }}">
            <div x-show="sidebarOpen" class="flex items-center space-x-2">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                <span class="font-bebas-neue text-2xl font-semibold tracking-wide text-gray-800 dark:text-gray-200">
                    POSTLY
                </span>
            </div>
            <div x-show="!sidebarOpen" class="flex h-9 w-9 items-center justify-center">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </div>
        </a>
    </div>

    <!-- Menu Items -->
    <div :class="sidebarOpen ? 'opacity-0 md:opacity-100' : 'opacity-100'"
        class="custom-scrollbar font-bebas-neue my-6 h-full overflow-y-auto overflow-x-hidden tracking-wider">
        <nav class="h-full px-2 pb-2">
            <!-- Create Post Menu -->
            @if (Auth::user()->role == 'user')
                <div class="mb-4"
                    :class="sidebarOpen ?
                        'bg-primary/20 shadow-sm border border-gray-200 dark:border-gray-700' :
                        'bg-transparent shadow-none border-none mx-0'">
                    <x-nav-link-sidebar href="/dashboard/posts/create" :active="request()->is('dashboard/posts/create')"
                        class="flex items-center justify-center transition-all duration-150">
                        <span x-show="sidebarOpen" class="mr-4 leading-5 tracking-widest dark:text-white">Create <br>New
                            Post</span>
                        <span
                            class="bg-primary rounded-xs inline-flex items-center justify-center border border-gray-200 p-1 dark:border-gray-700">
                            <x-heroicon-o-plus class="h-5 w-5 pb-0.5 text-gray-100 md:h-6 md:w-6 dark:text-gray-600" />
                        </span>
                    </x-nav-link-sidebar>
                </div>
            @endif

            <!-- Dashboard Menu -->
            <x-nav-link-sidebar href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard' : '/dashboard' }}"
                :active="Auth::user()->role == 'admin'
                    ? request()->is('admin/dashboard')
                    : request()->is('dashboard')">
                <span class="grid h-8 w-8 place-content-center">
                    <x-eva-grid-outline class="h-5 w-5 md:h-6 md:w-6" />
                </span>
                <span x-show="sidebarOpen" class="ml-3 text-[0.9rem] md:text-base">Dashboard</span>
            </x-nav-link-sidebar>

            <!-- User Menus -->
            @if (Auth::user()->role == 'user')
                <!-- Editor Menu -->
                <x-nav-link-sidebar href="/dashboard/posts" :active="request()->is('dashboard/posts*')" class="">
                    <span class="grid h-8 w-8 place-content-center">
                        <x-heroicon-o-newspaper class="h-6 w-6 md:h-7 md:w-7" />
                    </span>
                    <span x-show="sidebarOpen" class="ml-3 text-[0.9rem] md:text-base">MyPosts</span>
                </x-nav-link-sidebar>

                <!-- Private Posts -->
                <x-nav-link-sidebar href="/dashboard/archive" :active="request()->is('dashboard/archive*')" class="">
                    <span class="grid h-8 w-8 place-content-center">
                        <x-heroicon-o-archive-box class="h-5 w-5 md:h-6 md:w-6" />
                    </span>
                    <span x-show="sidebarOpen" class="ml-3 text-[0.9rem] md:text-base">Private Posts</span>
                </x-nav-link-sidebar>

                <!-- Trash Menu -->
                <x-nav-link-sidebar href="/dashboard/trash" :active="request()->is('dashboard/trash*')" class="">
                    <span class="grid h-8 w-8 place-content-center">
                        <x-heroicon-o-trash class="h-5 w-5 md:h-6 md:w-6" />
                    </span>
                    <span x-show="sidebarOpen" class="ml-3 text-[0.9rem] md:text-base">Trash</span>
                </x-nav-link-sidebar>
            @else
                <!-- Admin Menus -->

                <!-- Add Category Menu -->
                <x-nav-link-sidebar href="/admin/dahsbord/add_category" :active="request()->is('dashboard/posts*')" class="">
                    <span class="grid h-8 w-8 place-content-center">
                        <x-heroicon-o-pencil-square class="h-5 w-5" />
                    </span>
                    <span x-show="sidebarOpen" class="ml-3 text-[0.9rem] md:text-base">Add Category</span>
                </x-nav-link-sidebar>

                <!-- User Menu -->
                <x-nav-link-sidebar href="/admin/dahsbord/users" class="">
                    <span class="grid h-8 w-8 place-content-center">
                        <x-heroicon-o-user-group class="h-6 w-7" />
                    </span>
                    <span x-show="sidebarOpen" class="ml-3 text-[0.9rem] md:text-base">All Users</span>
                </x-nav-link-sidebar>

                <!-- Report Menu -->
                <x-nav-link-sidebar href="/admin/dahsbord/users" class="">
                    <span class="grid h-8 w-8 place-content-center">
                        <x-heroicon-o-exclamation-circle class="h-5 w-5 md:h-6 md:w-6" />
                    </span>
                    <span x-show="sidebarOpen" class="ml-3 text-[0.9rem] md:text-base">Report</span>
                </x-nav-link-sidebar>
            @endif
        </nav>
    </div>

    <!-- Settings Menu -->
    <div :class="sidebarOpen ? 'opacity-0 md:opacity-100' : 'opacity-100'"
        class="font-bebas-neue mt-auto space-y-2 px-2 tracking-wider">

        <button id="theme-toggle" class="rounded-xs block w-full bg-transparent px-1.5 py-1 sm:hidden">
            <span id="theme-toggle-light" class="hidden">🌞</span>
            <span id="theme-toggle-dark">🌙</span>
        </button>

        <x-nav-link-sidebar
            href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard/settings' : '/dashboard/settings' }}"
            :active="Auth::user()->role == 'admin'
                ? request()->is('admin/dashboard/settings')
                : request()->is('dashboard/settings')" class="">
            <span class="grid h-8 w-8 place-content-center">
                <x-elemplus-setting class="h-5 w-5 md:h-6 md:w-6" />
            </span>
            <span x-show="sidebarOpen" class="ml-3">Settings</span>
        </x-nav-link-sidebar>
    </div>
</div>
