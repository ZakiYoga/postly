<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    {{-- Title --}}
    @yield('title', config('app.name', 'Postly'))

    {{-- Fonts --}}


    {{-- Styles --}}
    @yield('styles')

    {{-- Scripts --}}
    @yield('scripts')

    {{-- Vite --}}

</head>

<body>
    {{-- Navbar --}}
    @yield('navbar')

    {{-- Page Heading --}}

    <main>
        @yield('content')

        {{-- Footer --}}
    </main>

    {{-- Footer --}}
    @yield('footer')

    {{-- Script --}}
    @yield('script')
</body>

</html>

<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="/js/toggleTheme.js"></script>
</head>

<body class="bg-background dark:bg-background-foreground font-benne">
    <x-navbar.header>{{ $title ?? 'Postly' }}</x-navbar.header>
    <main class="@container mb-8">
        {{ $slot }}
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
