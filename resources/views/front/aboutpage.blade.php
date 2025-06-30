<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="mx-auto my-4 h-fit w-full px-6 sm:px-8 md:px-10 lg:px-16">
        <div
            class="rounded-xs mx-auto mb-2 w-full border border-gray-200 bg-white px-4 py-6 text-center shadow-md lg:mb-4 lg:px-8 lg:py-8 dark:border-gray-700 dark:bg-gray-900">
            <h2
                class="font-bebas-neue mb-2 text-2xl font-semibold tracking-wider text-gray-900 lg:text-4xl dark:text-white">
                {{ $title }}
            </h2>
            <div class="mt-4 inline-flex items-center text-gray-500 first-letter:uppercase dark:text-gray-400">
                <a href="/" class="hover:text-primary focus:text-primary">
                    Home
                </a>
                <x-ri-arrow-right-double-fill class="h-4 w-4 pb-0.5" />
                <p> {{ $title }}</p>
            </div>
        </div>

        <div
            class="rounded-xs mx-auto flex w-full flex-col border border-gray-200 bg-white p-4 shadow-md md:p-6 lg:p-8 dark:border-gray-700 dark:bg-gray-900">
            <div class="inline-flex flex-col items-center justify-evenly gap-4 md:flex-row">
                <div class="">
                    <img src="{{ asset('images/about.png') }}" alt="Postly Logo"
                        class="h-52 w-52 object-cover object-center" />
                </div>
                <div class="max-w-md space-y-2">
                    <x-heading size="2xl" barClass="!w-[5%]">
                        Exploring Ideas. Empowering Tech Voices.
                    </x-heading>
                    <p class="text-gray-600 dark:text-gray-400">
                        <a href="/"
                            class="font-bebas-neue hover:text-primary pr-0.5 tracking-wider hover:underline">
                            Postly
                        </a> is a modern blogging platform focused on the world of technology and innovation. We
                        exist to spotlight ideas, insights, and stories from the ever-evolving tech landscape — whether
                        it's AI, web development, digital tools, or the next big trend.
                        Built with creators in mind, Postly offers a clean, performance-driven space where writers and
                        tech enthusiasts can share, grow, and connect. We believe that clarity in content leads to
                        clarity in thinking — and that great ideas deserve to be heard.
                    </p>
                </div>

            </div>

        </div>
    </section>
</x-layout>
