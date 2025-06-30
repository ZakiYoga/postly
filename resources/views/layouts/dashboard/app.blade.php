<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', $title ?? config('app.name', 'Dashboard'))
    </title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    @stack('styles')
    @stack('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.1.0/trix.min.css" integrity="..."
        crossorigin="anonymous">
    <script defer src="/js/toggleTheme.js"></script>
    @vite(['resources/css/app.css', 'resources/css/trix-style.css', 'resources/js/app.js'])
</head>

<body class="bg-primary/20 font-lora text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100">
    <div x-data="{
        sidebarOpen: false,
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', JSON.stringify(this.sidebarOpen));
        }
    }" class="flex h-screen">

        <div class="flex min-h-screen flex-col overflow-hidden transition-transform duration-300 ease-in-out">
            <!-- Sidebar -->
            @include('layouts.dashboard.sidebar')
        </div>

        <!-- Main Content Area -->
        <div class="flex flex-1 flex-col overflow-hidden">
            <!-- Header -->
            @include('layouts.dashboard.header')


            <!-- Main Content -->
            <main
                class="bg-background dark:bg-background-foreground flex-1 overflow-y-auto p-6 transition-all duration-300">
                {{-- Alert Success --}}
                @if (session('success'))
                    <x-alert type="success" title="Sukses!" :duration="3000">
                        {{ session('success') }}
                    </x-alert>
                @endif
                @if (session('error'))
                    <x-alert type="error" title="Error!" :duration="3000">
                        {{ session('error') }}
                    </x-alert>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>

@stack('script')


<script>
    function previewAvatar(input) {
        const filename = document.getElementById("avatar-name");
        @@ - 79, 5 + 66, 4 @@

        function deleteAvatar() {}
    }
</script>

</html>
