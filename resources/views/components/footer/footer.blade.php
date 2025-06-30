<footer class="mt-4 bg-white py-4 lg:py-6 dark:bg-gray-900 dark:text-gray-200">
    <div class="px-4 sm:px-6 md:px-8 lg:px-16">
        <!-- Logo and Slogan -->
        <div class="flex flex-col justify-between md:flex-row">
            <div class="mb-6 md:mb-0">
                <x-heading textClass="text-xl sm:text-2xl lg:text-3xl">Postly</x-heading>
                <p class="mt-2 text-sm text-gray-400 sm:text-base">Blogging Simplified, Impact Magnified</p>
            </div>

            <!-- Quick Links -->
            <div class="mt-6 flex flex-wrap gap-x-2 md:mt-0 md:flex-nowrap md:gap-x-4 lg:gap-x-8">
                <div>
                    <h2 class="font-bebas-neue mb-4 text-lg font-medium tracking-wider text-gray-500 dark:text-gray-200">
                        Quick Links</h2>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/"
                                class="transition duration-150 hover:text-gray-500 dark:hover:text-white">Home</a>
                        </li>
                        <li><a href="/about"
                                class="transition duration-150 hover:text-gray-500 dark:hover:text-white">About</a>
                        </li>
                        <li><a href="/posts"
                                class="transition duration-150 hover:text-gray-500 dark:hover:text-white">Blog</a>
                        </li>
                        <li><a href="/contact"
                                class="transition duration-150 hover:text-gray-500 dark:hover:text-white">Contact</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2
                        class="font-bebas-neue mb-4 text-lg font-medium tracking-wider text-gray-500 dark:text-gray-200">
                        Resources</h2>
                    <ul class="gap-x-2 space-y-2 text-sm text-gray-400 md:gap-x-4">
                        <li><a href="/help-center"
                                class="transition duration-150 hover:text-gray-500 dark:hover:text-white">Help
                                Center</a></li>
                        <li><a href="{{ route('privacy.policy') }}"
                                class="transition duration-150 hover:text-gray-500 dark:hover:text-white">Privacy
                                Policy</a></li>
                        <li><a href="/term-of-service"
                                class="transition duration-150 hover:text-gray-500 dark:hover:text-white">Terms of
                                Service</a></li>
                        <li><a href="/faq"
                                class="transition duration-150 hover:text-gray-500 dark:hover:text-white">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div
            class="mt-6 inline-flex w-full items-center justify-between border-t border-gray-300 pt-6 text-center md:text-left">
            <p class="text-sm text-gray-400">© {{ date('Y') }} Postly. All rights reserved.</p>
            <div class="flex justify-center space-x-6 md:justify-start">
                <a href="#" class="hover:text-primary text-gray-400 transition duration-150">
                    <x-icon name="bi-globe" class="h-6 w-6" />
                </a>
                <a href="#" class="hover:text-primary text-gray-400 transition duration-150">
                    <x-icon name="bi-facebook" class="h-6 w-6" />
                </a>
                <a href="#" class="hover:text-primary text-gray-400 transition duration-150">
                    <x-icon name="bi-twitter" class="h-6 w-6" />
                </a>
                <a href="#" class="hover:text-primary text-gray-400 transition duration-150">
                    <x-icon name="bi-instagram" class="h-6 w-6" />
                </a>
                <a href="#" class="hover:text-primary text-gray-400 transition duration-150">
                    <x-icon name="bi-youtube" class="h-6 w-6" />
                </a>
            </div>
        </div>
    </div>
</footer>
