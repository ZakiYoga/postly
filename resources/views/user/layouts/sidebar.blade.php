<!-- Sidebar -->
<div x-cloak :class="sidebarOpen ? 'w-56' : 'w-20'"
    class="bg-white transition-all duration-300 shadow-lg overflow-x-hidden ">

    <!-- Logo -->
    <div class="flex items-center justify-center h-16 border-b border-gray-200 dark:border-gray-700">
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
    <div class="py-6">
        <nav class="font-bebas-neue tracking-wider text-base">

            <!-- Create Post Menu -->
            <div class="mb-4"
                :class="sidebarOpen ?
                    'bg-primary/20 shadow-sm border border-gray-200 mx-4' :
                    'bg-transparent shadow-none border-none mx-0'">
                <x-nav-link-sidebar href="/dashboard/posts/create" :active="request()->is('dashboard/posts*')"
                    class="flex items-center justify-center px-4 rounded-xs text-gray-700 hover:bg-primary/35 transition-all duration-150">
                    <span x-show="sidebarOpen" class="mr-4 leading-5 tracking-widest">Create <br>New Post</span>
                    <span
                        class="inline-flex items-center justify-center h-8 w-8 border border-gray-200 bg-primary rounded-xs p-1">
                        <x-heroicon-o-plus class="h-6 w-6 pb-0.5 text-gray-800" />
                    </span>
                </x-nav-link-sidebar>
            </div>

            <!-- Dashboard Menu -->
            <x-nav-link-sidebar href="/dashboard" :active="request()->is('dashboard')" class="">
                <span class="inline-flex items-center justify-center h-10 w-10">
                    <x-eva-grid-outline class="h-6 w-6" />
                </span>
                <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
            </x-nav-link-sidebar>

            {{-- <!-- Editor Menu -->
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary/10 hover:text-primary">
                <span class="inline-flex items-center justify-center h-10 w-10">
                    <x-far-pen-to-square class="h-5 w-5" />
                </span>
                <span x-show="sidebarOpen" class="ml-3">Editor</span>
            </a> --}}

            {{-- <!-- User Menu -->
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary/10 hover:text-primary">
                <span class="inline-flex items-center justify-center h-10 w-10">
                    <x-heroicon-o-user-group class="h-6 w-7" />
                </span>
                <span x-show="sidebarOpen" class="ml-3">Draft</span>
            </a> --}}

            <!-- Leads Menu -->
            <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary/10 hover:text-primary">
                <span class="inline-flex items-center justify-center h-10 w-10">
                    <x-eva-archive-outline class="h-6 w-6" />
                </span>
                <span x-show="sidebarOpen" class="ml-3">Draft</span>
            </a>

            <!-- Trash Menu -->
            <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary/10 hover:text-primary">
                <span class="inline-flex items-center justify-center h-10 w-10">
                    <x-heroicon-o-trash class="h-6 w-6" />
                </span>
                <span x-show="sidebarOpen" class="ml-3">Trash</span>
            </a>

            <!-- Settings Menu -->
            <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary/10 hover:text-primary">
                <span class="inline-flex items-center justify-center h-10 w-10">
                    <x-elemplus-setting class="h-6 w-6" />
                </span>
                <span x-show="sidebarOpen" class="ml-3">Settings</span>
            </a>
        </nav>
    </div>
</div>
