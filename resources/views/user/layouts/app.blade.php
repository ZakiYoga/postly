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
    @yield(section: 'scripts')
    @yield('style')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-primary/20 font-benne antialiased text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen">

        <!-- Sidebar -->
        @include('user.layouts.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('user.layouts.header')


            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

@yield(section: 'script')

</html>
