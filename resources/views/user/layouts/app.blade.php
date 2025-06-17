<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', default: config('app.name', 'Dashboard'))
    </title>

    <!-- Scripts -->
    @stack('styles')
    @stack('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.1.0/trix.min.css" integrity="..." crossorigin="anonymous">
    <script defer src="/js/toggleTheme.js"></script>
    @vite(['resources/css/app.css', 'resources/css/trix-style.css', 'resources/js/app.js'])
</head>

<body class="bg-primary/20 font-lora antialiased text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <div x-data="{
        sidebarOpen: false,
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', JSON.stringify(this.sidebarOpen));
        }
    }" class="flex h-screen">

        <div class="min-h-screen overflow-hidden flex flex-col transition-transform duration-300 ease-in-out">
            <!-- Sidebar -->
            @include('user.layouts.sidebar')
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('user.layouts.header')


            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-background dark:bg-background-foreground p-6 transition-all duration-300 ">
                {{-- Alert Success --}}
                @if (session('success'))
                <x-alert type="success" title="Sukses!" :duration="3000">
                    {{ session('success') }}
                </x-alert>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>

@stack('script')

</html>
