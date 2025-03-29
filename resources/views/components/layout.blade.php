<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="/js/toggleTheme.js"></script>
    </script>
    </script>
</head>

<body class="bg-background dark:bg-background-foreground font-benne">
    @yield('content')
    <x-header>{{ $title }}</x-header>
    <main class="@container mb-8">
        {{ $slot }}
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
