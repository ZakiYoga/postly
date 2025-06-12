<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="w-full h-fit mt-4 mx-auto px-6 sm:px-8 md:px-10 lg:px-16">
        <div
            class="mx-auto w-full bg-white rounded-xs text-center py-6 lg:py-8 px-4 lg:px-8 lg:mb-4 mb-2 shadow-md border border-gray-200 dark:bg-gray-900 dark:border-gray-700">
            <h2
                class="mb-2 text-2xl font-bebas-neue tracking-wider lg:text-4xl font-semibold text-gray-900 dark:text-white">
                {{ $title }}
            </h2>
            <div class="inline-flex items-center mt-4 text-gray-500 dark:text-gray-400 first-letter:uppercase">
                <a href="/" class="hover:text-primary focus:text-primary">
                    Home
                </a>
                <x-ri-arrow-right-double-fill class="w-4 h-4 pb-0.5" />
                <p> {{ $title }}</p>
            </div>
        </div>

        <div
            class="flex  flex-col rounded-xs mb-4 md:mb-6 lg:mb-8 p-4 md:p-6 lg:p-8  mx-auto w-full shadow-md border border-gray-200 bg-white dark:bg-gray-900 dark:border-gray-700">
            <div class="flex justify-center flex-row-reverse gap-4">
                <div class="max-w-md space-y-2">
                    <x-heading size="2xl" barClass="!w-[5%]">
                        Exploring Ideas. Empowering Tech Voices.
                    </x-heading>
                    <p class="text-gray-600 dark:text-gray-400">
                        <a href="/"
                            class="text-sm font-bebas-neue tracking-wider hover:text-primary hover:underline">
                            Postly
                        </a> is a modern blogging platform focused on the world of technology and innovation. We
                        exist to spotlight ideas, insights, and stories from the ever-evolving tech landscape — whether
                        it's AI, web development, digital tools, or the next big trend.
                        Built with creators in mind, Postly offers a clean, performance-driven space where writers and
                        tech enthusiasts can share, grow, and connect. We believe that clarity in content leads to
                        clarity in thinking — and that great ideas deserve to be heard.
                    </p>
                </div>
                <div class="grid place-items-center">
                    <img src="{{ asset('images/about.png') }}" alt="Postly Logo"
                        class="w-52 h-52 object-cover object-center" />
                </div>
            </div>

        </div>
    </section>
</x-layout>
