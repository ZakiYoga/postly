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
            class="flex justify-between rounded-xs bg-white p-6 md:py-10 lg:py-12 mx-auto w-full shadow-md border  border-gray-200 dark:bg-gray-900 dark:border-gray-700">
            <div class="w-full max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div>
                        <div class="text-center mb-12">
                            <h2 class="text-3xl font-bold text-gray-900">Get in Touch</h2>
                            <p class="mt-4 text-gray-600">Have questions, feedback, or just want to say hello? Fill out
                                the
                                form
                                below and we’ll get back to you as soon as we can.</p>
                        </div>

                        <form method="POST" action="" class="space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" class="" />
                                <x-text-input id="email" type="email" name="email" class="block mt-1 w-full"
                                    :has-error="$errors->has('email')" :value="old('email')" required autofocus autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 font-benne" />
                            </div>

                            <div>
                                <x-input-label for="message" :value="__('Message')" />
                                <x-text-area id="message" class="block mt-1 w-full" type="text" message="message"
                                    :value="old('message')" required autofocus autocomplete="message" />
                                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            </div>

                            <div>
                                <x-primary-button type="submit">
                                    Send message
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                    <!-- Subscribe Form -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Follow Me</h3>
                        <p class="text-gray-600 mb-6">
                            Stay up to date with the latest posts, updates, and behind-the-scenes stories from creators
                            on <strong>Postly</strong>. Follow us on:
                        </p>

                        <div class="flex flex-col gap-4">
                            {{-- Facebook --}}
                            <div class="inline-flex items-center gap-2">
                                <div
                                    class="grid place-content-center h-fit p-2 rounded-full bg-sla-600 dark:bg-gray-700">
                                    <svg class="w-8 h-8 fill-current text-gray-100 dark:text-gray-200"
                                        stroke-width="1.5" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="50" height="50" viewBox="0 0 50 50">
                                        <path
                                            d="M 30.140625 2 C 26.870375 2 24.045399 2.9969388 22.0625 4.9667969 C 20.079601 6.936655 19 9.823825 19 13.367188 L 19 18 L 13 18 A 1.0001 1.0001 0 0 0 12 19 L 12 27 A 1.0001 1.0001 0 0 0 13 28 L 19 28 L 19 47 A 1.0001 1.0001 0 0 0 20 48 L 28 48 A 1.0001 1.0001 0 0 0 29 47 L 29 28 L 36 28 A 1.0001 1.0001 0 0 0 36.992188 27.125 L 37.992188 19.125 A 1.0001 1.0001 0 0 0 37 18 L 29 18 L 29 14 C 29 12.883334 29.883334 12 31 12 L 37 12 A 1.0001 1.0001 0 0 0 38 11 L 38 3.3457031 A 1.0001 1.0001 0 0 0 37.130859 2.3554688 C 36.247185 2.2382213 33.057174 2 30.140625 2 z M 30.140625 4 C 32.578477 4 34.935105 4.195047 36 4.2949219 L 36 10 L 31 10 C 28.802666 10 27 11.802666 27 14 L 27 19 A 1.0001 1.0001 0 0 0 28 20 L 35.867188 20 L 35.117188 26 L 28 26 A 1.0001 1.0001 0 0 0 27 27 L 27 46 L 21 46 L 21 27 A 1.0001 1.0001 0 0 0 20 26 L 14 26 L 14 20 L 20 20 A 1.0001 1.0001 0 0 0 21 19 L 21 13.367188 C 21 10.22255 21.920305 7.9269075 23.472656 6.3847656 C 25.025007 4.8426237 27.269875 4 30.140625 4 z">
                                        </path>
                                    </svg>
                                </div>
                                <p>
                                    Facebook
                                </p>
                            </div>

                            {{-- Instagram --}}
                            <div class="inline-flex items-center gap-2">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50"
                                    height="50" viewBox="0 0 50 50">
                                    <path
                                        d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z">
                                    </path>
                                </svg>
                                <p>
                                    Instagram
                                </p>
                            </div>

                            {{-- X --}}
                            <div class="">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"
                                    width="50px" height="50px">
                                    <path
                                        d="M26.37,26l-8.795-12.822l0.015,0.012L25.52,4h-2.65l-6.46,7.48L11.28,4H4.33l8.211,11.971L12.54,15.97L3.88,26h2.65 l7.182-8.322L19.42,26H26.37z M10.23,6l12.34,18h-2.1L8.12,6H10.23z" />
                                </svg>
                            </div>

                            {{-- Youtube --}}
                            <div class="">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"
                                    width="50px" height="50px">
                                    <path
                                        d="M 24.402344 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.402344 16.898438 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.902344 40.5 17.898438 41 24.5 41 C 31.101563 41 37.097656 40.5 40.597656 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.097656 35.5 C 45.5 33 46 29.402344 46.097656 24.902344 C 46.097656 20.402344 45.597656 16.800781 45.097656 14.300781 C 44.699219 12.101563 42.800781 10.5 40.597656 10 C 37.097656 9.5 31 9 24.402344 9 Z M 24.402344 11 C 31.601563 11 37.398438 11.597656 40.199219 12.097656 C 41.699219 12.5 42.898438 13.5 43.097656 14.800781 C 43.699219 18 44.097656 21.402344 44.097656 24.902344 C 44 29.199219 43.5 32.699219 43.097656 35.199219 C 42.800781 37.097656 40.800781 37.699219 40.199219 37.902344 C 36.597656 38.601563 30.597656 39.097656 24.597656 39.097656 C 18.597656 39.097656 12.5 38.699219 9 37.902344 C 7.5 37.5 6.300781 36.5 6.101563 35.199219 C 5.300781 32.398438 5 28.699219 5 25 C 5 20.398438 5.402344 17 5.800781 14.902344 C 6.101563 13 8.199219 12.398438 8.699219 12.199219 C 12 11.5 18.101563 11 24.402344 11 Z M 19 17 L 19 33 L 33 25 Z M 21 20.402344 L 29 25 L 21 29.597656 Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto mt-4 px-6 sm:px-8 md:px-10 lg:px-16">
        <div class="flex items-center justify-center rounded-xs overflow-hidden">
            <x-subscribe-form />
        </div>
    </section>

</x-layout>
