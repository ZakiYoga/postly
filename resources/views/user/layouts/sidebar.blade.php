<!-- Sidebar -->
<div x-cloak :class="sidebarOpen ? 'w-56' : 'w-20'"
    class="bg-white flex flex-col h-full overflow-hidden transition-all duration-300 shadow-lg overflow-x-hidden ">

    <!-- Logo -->
    <div class="flex items-center justify-center h-16 border-b py-6 border-gray-100 dark:border-gray-700">
        <div x-show="sidebarOpen" class="flex items-center space-x-2">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            <span class="text-2xl font-semibold text-gray-800 font-bebas-neue tracking-wide">
                POSTLY
        </div>
        <div x-show="!sidebarOpen" class="flex items-center justify-center h-9 w-9">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </div>
    </div>

    <!-- Menu Items -->
    <div class="my-6 overflow-y-auto h-full custom-scrollbar font-bebas-neue tracking-wider">
        <nav class="px-2 pb-2 h-full">
            <!-- Create Post Menu -->
            @if (Auth::user()->role == 'user')
                <div class="mb-4"
                    :class="sidebarOpen ?
                        'bg-primary/20 shadow-sm border border-gray-200' :
                        'bg-transparent shadow-none border-none mx-0'">
                    <x-nav-link-sidebar href="/dashboard/posts/create" :active="request()->is('dashboard/posts/create')"
                        class="flex items-center justify-center transition-all duration-150">
                        <span x-show="sidebarOpen" class="mr-4 leading-5 tracking-widest">Create <br>New Post</span>
                        <span
                            class="inline-flex items-center justify-center border border-gray-200 bg-primary rounded-xs p-1">
                            <x-heroicon-o-plus class="h-5 w-5 md:h-6 md:w-6 pb-0.5 text-gray-100" />
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
                <x-nav-link-sidebar href="/dashboard/private-posts" :active="request()->is('dashboard/private-posts*')" class="">
                    <span class="grid place-content-center h-8 w-8">
                        <x-carbon-document-protected class="h-5 w-5 md:h-6 md:w-6" />
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
            <!-- Settings Menu -->
        </nav>
    </div>
    <div class="mt-auto px-2">
        <x-nav-link-sidebar
            href="{{ Auth::user()->role == 'admin' ? '/admin/dashboard/settings' : '/dashboard/settings' }}"
            :active="Auth::user()->role == 'admin'
                ? request()->is('admin/dashboard/settings')
                : request()->is('dashboard/settings')" class="">

            <span class="grid place-content-center h-8 w-8">
                <x-elemplus-setting class="h-5 w-5 md:h-6 md:w-6" />
            </span>
            <span x-show="sidebarOpen" class="md:text-base text-[0.9rem] ml-3">Settings</span>
        </x-nav-link-sidebar>
    </div>
</div>
