<!-- Sidebar -->
<div x-cloak :class="sidebarOpen ? 'w-0 md:w-56' : 'w-20'"
    class="bg-white dark:bg-background-foreground/20 shadow-md pb-2 flex flex-col h-full overflow-hidden transition-all duration-300 overflow-x-hidden ">

    <!-- Logo -->
    <div class="flex items-center justify-center shadow-sm h-16 border-b py-6 border-gray-200 dark:border-gray-500">
        <div x-show="sidebarOpen" class="flex items-center space-x-2">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            <span class="text-2xl font-semibold text-gray-800 dark:text-gray-200 font-bebas-neue tracking-wide">
                POSTLY
        </div>
        <div x-show="!sidebarOpen" class="flex items-center justify-center h-9 w-9">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </div>
    </div>

    <!-- Menu Items -->
    <div :class="sidebarOpen ? 'opacity-0 md:opacity-100' : 'opacity-100'"
        class="my-6 overflow-y-auto overflow-x-hidden h-full custom-scrollbar font-bebas-neue tracking-wider">
        <nav class="px-2 pb-2 h-full">
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
                            class="inline-flex items-center justify-center border border-gray-200 dark:border-gray-700 bg-primary rounded-xs p-1">
                            <x-heroicon-o-plus class="h-5 w-5 md:h-6 md:w-6 pb-0.5 text-gray-100 dark:text-gray-600" />
                        </span>
                    </x-nav-link-sidebar>
                </div>
            @endif

            <!-- Dashboard Menu -->
            <x-nav-link-sidebar href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard' : '/dashboard' }}"
                :active="Auth::user()->role == 'admin'
                    ? request()->is('admin/dashboard')
                    : request()->is('dashboard')">
                <span class="grid place-content-center h-8 w-8">
                    <x-eva-grid-outline class="h-5 w-5 md:h-6 md:w-6" />
                </span>
                <span x-show="sidebarOpen" class="md:text-base text-[0.9rem] ml-3">Dashboard</span>
            </x-nav-link-sidebar>

            <!-- User Menus -->
            @if (Auth::user()->role == 'user')
                <!-- Editor Menu -->
                <x-nav-link-sidebar href="/dashboard/posts" :active="request()->is('dashboard/posts*')" class="">
                    <span class="grid place-content-center h-8 w-8">
                        <x-heroicon-o-newspaper class="h-6 w-6 md:h-7 md:w-7" />
                    </span>
                    <span x-show="sidebarOpen" class="md:text-base text-[0.9rem] ml-3">MyPosts</span>
                </x-nav-link-sidebar>

                <!-- Private Posts -->
                <x-nav-link-sidebar href="/dashboard/archive" :active="request()->is('dashboard/archive*')" class="">
                    <span class="grid place-content-center h-8 w-8">
                        <x-heroicon-o-archive-box class="h-5 w-5 md:h-6 md:w-6" />
                    </span>
                    <span x-show="sidebarOpen" class="md:text-base text-[0.9rem] ml-3">Private Posts</span>
                </x-nav-link-sidebar>

                <!-- Trash Menu -->
                <x-nav-link-sidebar href="/dashboard/trash" :active="request()->is('dashboard/trash*')" class="">
                    <span class="grid place-content-center h-8 w-8">
                        <x-heroicon-o-trash class="h-5 w-5 md:h-6 md:w-6" />
                    </span>
                    <span x-show="sidebarOpen" class="md:text-base text-[0.9rem] ml-3">Trash</span>
                </x-nav-link-sidebar>
            @else
                <!-- Admin Menus -->

                <!-- Add Category Menu -->
                <x-nav-link-sidebar href="/admin/dahsbord/add_category" :active="request()->is('dashboard/posts*')" class="">
                    <span class="grid place-content-center h-8 w-8">
                        <x-heroicon-o-pencil-square class="h-5 w-5" />
                    </span>
                    <span x-show="sidebarOpen" class="md:text-base text-[0.9rem] ml-3">Add Category</span>
                </x-nav-link-sidebar>

                <!-- User Menu -->
                <x-nav-link-sidebar href="/admin/dahsbord/users" class="">
                    <span class="grid place-content-center h-8 w-8">
                        <x-heroicon-o-user-group class="h-6 w-7" />
                    </span>
                    <span x-show="sidebarOpen" class="md:text-base text-[0.9rem] ml-3">All Users</span>
                </x-nav-link-sidebar>

                <!-- Report Menu -->
                <x-nav-link-sidebar href="/admin/dahsbord/users" class="">
                    <span class="grid place-content-center h-8 w-8">
                        <x-heroicon-o-exclamation-circle class="h-5 w-5 md:h-6 md:w-6" />
                    </span>
                    <span x-show="sidebarOpen" class="md:text-base text-[0.9rem] ml-3">Report</span>
                </x-nav-link-sidebar>
            @endif
        </nav>
    </div>

    <!-- Settings Menu -->
    <div :class="sidebarOpen ? 'opacity-0 md:opacity-100' : 'opacity-100'"
        class="mt-auto px-2 font-bebas-neue tracking-wider">
        <x-nav-link-sidebar
            href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard/settings' : '/dashboard/settings' }}"
            :active="Auth::user()->role == 'admin'
                ? request()->is('admin/dashboard/settings')
                : request()->is('dashboard/settings')" class="">
            <span class="grid place-content-center">
                <x-elemplus-setting class="h-5 w-5 md:h-6 md:w-6" />
            </span>
            <span x-show="sidebarOpen" class="ml-3">Settings</span>
        </x-nav-link-sidebar>
    </div>
</div>
