<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'Postly - ' . $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- App Scripts -->
    <script src="{{ asset('js/utils/sweet-alert-config.js') }}"></script>
    <script src="{{ asset('js/utils/api-client.js') }}"></script>
    <script src="{{ asset('js/components/post-manager.js') }}"></script>
    <script defer src="/js/toggleTheme.js"></script>

    @stack('styles')
    @stack('scripts')

</head>

<body class="bg-background dark:bg-background-foreground font-lora text-gray-900 dark:text-gray-100">
    <x-navbar.header />

    <main>
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
        {{ $slot }}
    </main>

    <x-footer.footer />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

@stack('script')
<script>
    // Function untuk navigate (yang sudah ada)
    function navigateToSection(sectionId) {
        const currentPath = window.location.pathname;

        if (currentPath === '/') {
            // Update hash untuk active state
            window.location.hash = sectionId;

            // Jika sudah di home, scroll ke section
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        } else {
            // Jika di route lain, redirect ke home dengan hash
            window.location.href = `/#${sectionId}`;
        }
    }

    function handleCategoryClick() {
        navigateToSection('category-section');
    }

    // Active state handler
    document.addEventListener('DOMContentLoaded', function() {
        const categoriesNav = document.getElementById('categories-nav');

        function updateActiveNav() {
            const hash = window.location.hash;

            if (hash === '#category-section') {
                categoriesNav.classList.add('active-nav');
            } else {
                categoriesNav.classList.remove('active-nav');
            }
        }

        // Update saat page load
        updateActiveNav();

        // Update saat hash berubah
        window.addEventListener('hashchange', updateActiveNav);

        // Optional: Intersection Observer untuk auto-detect saat scroll
        const categorySection = document.getElementById('category-section');
        if (categorySection) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && entry.intersectionRatio > 0.6) {
                        // Update hash dan active state
                        history.replaceState(null, null, '#category-section');
                        categoriesNav.classList.add('active-nav');
                    }
                });
            }, {
                threshold: 0.6,
                rootMargin: '-10% 0px -10% 0px'
            });

            observer.observe(categorySection);
        }
    });
</script>

</html>
