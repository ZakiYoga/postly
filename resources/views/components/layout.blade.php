<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'Postly - ' . $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="/js/toggleTheme.js"></script>
    <script defer src="/js/slidderCategories.js"></script>
    @stack('styles')
    @stack('scripts')

</head>

<body class="bg-background dark:bg-background-foreground font-lora text-gray-900 dark:text-gray-100">
    <x-navbar.header />

    <main>
        {{ $slot }}
    </main>

    <x-footer.footer />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

@stack('script')

</html>
