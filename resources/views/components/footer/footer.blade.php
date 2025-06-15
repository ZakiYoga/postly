<footer class="bg-white dark:bg-gray-900/50 dark:text-gray-200">
    <div class="container mx-auto px-6 pt-10 pb-6">
        <!-- Logo and Slogan -->
        <div class="flex flex-col md:flex-row justify-between">
            <div class="mb-6 md:mb-0">
                <x-heading textClass="text-xl sm:text-2xl lg:text-3xl">Postly</x-heading>
                <p class="text-sm sm:text-base mt-2 text-gray-400">Blogging Simplified, Impact Magnified</p>
            </div>

            <!-- Quick Links -->
            <div class="flex flex-wrap md:flex-nowrap gap-x-2 md:gap-x-4 mt-6 md:mt-0">
                <div>
                    <h2 class="text-lg font-bebas-neue tracking-wider font-medium mb-4 text-gray-500 dark:text-gray-200">
                        Quick Links</h2>
                    <ul class="space-y-2 text-sm text-gray-400 ">
                        <li><a href="/"
                                class="hover:text-gray-500 dark:hover:text-white transition duration-150">Home</a>
                        </li>
                        <li><a href="/about"
                                class="hover:text-gray-500 dark:hover:text-white transition duration-150">About</a>
                        </li>
                        <li><a href="/posts"
                                class="hover:text-gray-500 dark:hover:text-white transition duration-150">Blog</a>
                        </li>
                        <li><a href="/contact"
                                class="hover:text-gray-500 dark:hover:text-white transition duration-150">Contact</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2
                        class="text-lg font-bebas-neue tracking-wider font-medium mb-4 text-gray-500 dark:text-gray-200">
                        Resources</h2>
                    <ul class="space-y-2 text-sm  gap-x-2 md:gap-x-4 text-gray-400">
                        <li><a href="/help-center"
                                class="hover:text-gray-500 dark:hover:text-white transition duration-150">Help
                                Center</a></li>
                        <li><a href="/privacy-policy"
                                class="hover:text-gray-500 dark:hover:text-white transition duration-150">Privacy
                                Policy</a></li>
                        <li><a href="/term-of-service"
                                class="hover:text-gray-500 dark:hover:text-white transition duration-150">Terms of
                                Service</a></li>
                        <li><a href="/faq"
                                class="hover:text-gray-500 dark:hover:text-white transition duration-150">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div
            class="mt-6 pt-6 w-full border-t inline-flex items-center justify-between border-gray-300 text-center md:text-left">
            <p class="text-sm text-gray-400">© {{ date('Y') }} Postly. All rights reserved.</p>
            <div class="flex justify-center md:justify-start space-x-6">
                <a href="#" class="text-gray-400 hover:text-primary transition duration-150">
                    <x-icon name="bi-globe" class="w-6 h-6" />
                </a>
                <a href="#" class="text-gray-400 hover:text-primary transition duration-150">
                    <x-icon name="bi-facebook" class="w-6 h-6" />
                </a>
                <a href="#" class="text-gray-400 hover:text-primary transition duration-150">
                    <x-icon name="bi-twitter" class="w-6 h-6" />
                </a>
                <a href="#" class="text-gray-400 hover:text-primary transition duration-150">
                    <x-icon name="bi-instagram" class="w-6 h-6" />
                </a>
                <a href="#" class="text-gray-400 hover:text-primary transition duration-150">
                    <x-icon name="bi-youtube" class="w-6 h-6" />
                </a>
            </div>
        </div>
    </div>
</footer>
