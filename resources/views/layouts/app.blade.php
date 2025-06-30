<!DOCTYPE html>
<html lang={{ str_replace('_', '-', app()->getLocale()) }}>

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

<body
    class="bg-background dark:bg-background-foreground font-lora flex min-h-screen w-full items-center justify-center text-gray-900 antialiased dark:text-white">
    @yield('content')
</body>

@stack('script')

</html>
