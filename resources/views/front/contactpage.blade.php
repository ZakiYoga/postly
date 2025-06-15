<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="w-full h-fit my-4 mx-auto px-6 sm:px-8 md:px-10 lg:px-16">
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

        {{-- <div
            class="flex justify-between rounded-xs  p-4 md:p-6 lg:p-8  mx-auto w-full shadow-md border border-gray-200 bg-white dark:bg-gray-900 dark:border-gray-700"> --}}
        <div class="flex justify-between rounded-xs w-full mx-auto mb-6 md:mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 h-fit">
                <div class="p-4 md:p-6 lg:p-8 bg-white dark:bg-gray-900 rounded-xs shadow space-y-4">
                    <div class="mb-4 space-y-0.5">
                        <x-heading size="2xl">Get in touch</x-heading>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Have questions, feedback, or just want to say hello? Fill out the form below and we’ll
                            get back to you as soon as we can.
                        </p>
                    </div>

                    <form method="POST" action="" class="flex flex-col gap-4">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" class="sr-only" />
                            <x-text-input id="name" class="w-full" type="text" name="name"
                                placeholder="Enter your name" :value="old('name')" required autofocus
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="sr-only" />
                            <x-text-input id="email" type="email" name="email" class="w-full"
                                placeholder="Enter your email" :has-error="$errors->has('email')" :value="old('email')" required autofocus
                                autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="message" :value="__('Message')" class="sr-only" />
                            <x-text-area id="message" class="w-full" type="text" message="message"
                                placeholder="Type your message here" :value="old('message')" required autofocus
                                autocomplete="message" />
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div>
                            <x-primary-button class="text-base" type="submit">
                                Send message
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- Subscribe Form -->
                <div class="h-full flex flex-col justify-between lg:gap-4 xl:gap-6">
                    <div class="bg-slate-900 p-4 md:p-6 lg:p-8 rounded-xs shadow space-y-2">
                        <div class="space-y-0.5">
                            <x-heading size="2xl" textClass="text-white">Join Our Newsletter</x-heading>
                            <p class="text-gray-400 dark:text-gray-400 text-sm">
                                Get the latest tips and posts from your favorite creators on
                                <strong class="text-sm font-bebas-neue tracking-wider text-primary">Postly</strong>.
                                Subscribe now:
                            </p>
                        </div>
                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="w-full">
                            @csrf
                            <div class="w-full inline-flex items-center rounded-sm gap-1 bg-slate-800 p-1">
                                <x-input-label for="email" :value="__('Email')" class="sr-only" />
                                <div class="relative flex-1">
                                    <x-heroicon-o-envelope
                                        class="absolute z-10 left-2 top-1/2 -translate-y-1/2 w-5 h-5 mb-0.5 text-gray-500" />

                                    <x-text-input id="email"
                                        class="flex-1 font-bebas-neue tracking-widest text-sm w-full rounded-e-none pl-9 !bg-slate-800 !dark:bg-gray-900 !text-gray-400 !border-none !border-0 !outline-0"
                                        type="email" placeholder="enter your email" name="email" :value="old('email')"
                                        required />
                                </div>


                                <button type="submit"
                                    class="inline-flex font-bebas-neue tracking-wide px-4 py-1.5 rounded-xs rounded-s-none bg-primary dark:bg-primary transition-all duration-300 group">
                                    <span
                                        class="group-hover:-translate-x-0.5 transition-all duration-300">Subscribe</span>
                                    <x-heroicon-o-arrow-long-right
                                        class="w-5 group-hover:w-6 group-hover:translate-x-0.5 h-6 transition-all duration-300" />
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-gray-200/80 p-4 md:p-6 lg:p-8 rounded-xs shadow space-y-2 dark:bg-gray-800">
                        <div class="space-y-0.5">
                            <x-heading size="xl">Let’s Connect</x-heading>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Don’t miss out on new stories and creator updates. Stay in the loop by following us
                                on:
                            </p>
                        </div>

                        <div class="w-full inline-flex flex-wrap gap-4">
                            {{-- Facebook --}}
                            <a href="#"
                                class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-blue-700">
                                <svg class="w-6 h-6 text-gray-100 fill-current" viewBox="0 0 50 50">
                                    <path
                                        d="M32,11h5c0.552,0,1-0.448,1-1V3.263c0-0.524-0.403-0.96-0.925-0.997C35.484,2.153,32.376,2,30.141,2C24,2,20,5.68,20,12.368 V19h-7c-0.552,0-1,0.448-1,1v7c0,0.552,0.448,1,1,1h7v19c0,0.552,0.448,1,1,1h7c0.552,0,1-0.448,1-1V28h7.222 c0.51,0,0.938-0.383,0.994-0.89l0.778-7C38.06,19.518,37.596,19,37,19h-8v-5C29,12.343,30.343,11,32,11z" />
                                </svg>
                            </a>


                            {{-- Instagram --}}
                            <a href="#"
                                class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-gradient-to-tr from-pink-500 via-red-500 to-yellow-500">
                                <svg class="w-6 h-6 text-gray-100 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
                                    <path
                                        d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z">
                                    </path>
                                </svg>
                            </a>

                            {{-- X --}}
                            <a href="#"
                                class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-gray-950">
                                <svg class="w-6 h-6 text-gray-100 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 30 30" width="50px" height="50px">
                                    <path
                                        d="M26.37,26l-8.795-12.822l0.015,0.012L25.52,4h-2.65l-6.46,7.48L11.28,4H4.33l8.211,11.971L12.54,15.97L3.88,26h2.65 l7.182-8.322L19.42,26H26.37z M10.23,6l12.34,18h-2.1L8.12,6H10.23z" />
                                </svg>
                            </a>


                            {{-- Youtube --}}
                            <a href="#"
                                class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-red-600">
                                <svg class="w-6 h-6 text-gray-100 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 50 50" width="50px" height="50px">
                                    <path
                                        d="M 24.402344 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.402344 16.898438 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.902344 40.5 17.898438 41 24.5 41 C 31.101563 41 37.097656 40.5 40.597656 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.097656 35.5 C 45.5 33 46 29.402344 46.097656 24.902344 C 46.097656 20.402344 45.597656 16.800781 45.097656 14.300781 C 44.699219 12.101563 42.800781 10.5 40.597656 10 C 37.097656 9.5 31 9 24.402344 9 Z M 24.402344 11 C 31.601563 11 37.398438 11.597656 40.199219 12.097656 C 41.699219 12.5 42.898438 13.5 43.097656 14.800781 C 43.699219 18 44.097656 21.402344 44.097656 24.902344 C 44 29.199219 43.5 32.699219 43.097656 35.199219 C 42.800781 37.097656 40.800781 37.699219 40.199219 37.902344 C 36.597656 38.601563 30.597656 39.097656 24.597656 39.097656 C 18.597656 39.097656 12.5 38.699219 9 37.902344 C 7.5 37.5 6.300781 36.5 6.101563 35.199219 C 5.300781 32.398438 5 28.699219 5 25 C 5 20.398438 5.402344 17 5.800781 14.902344 C 6.101563 13 8.199219 12.398438 8.699219 12.199219 C 12 11.5 18.101563 11 24.402344 11 Z M 19 17 L 19 33 L 33 25 Z M 21 20.402344 L 29 25 L 21 29.597656 Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
    </section>
</x-layout>
