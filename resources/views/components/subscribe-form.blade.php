<section id="subscribe" class="h-fit mt-8 px-4 sm:px-6 md:px-8 lg:px-16">
    <div class="flex item-center p-8 pt-16 justify-between gap-4 w-full h-fit bg-white/95 dark:bg-gray-900">
        <div class="flex flex-col w-full items-center justify-center gap-y-6">
            <div class="flex flex-col max-w-fit items-center">
                <h1 class="lg:text-3xl md:text-2xl tracking-wider font-bebas-neue pt-1.5 dark:text-gray-200">
                    Postly ~
                    <span class="text-primary">Never Miss a Post That Matters</span>
                </h1>
            </div>

            <div
                class="max-w-xl w-full md:min-h-36 inline-flex items-center justify-between p-4 px-6 md:px-8 bg-primary">
                <div class="text-lg md:text-xl max-w-sm font-bold">
                    <p>Get the latest articles, tips, and exclusive content delivered straight to your inbox every
                        week.</p>
                </div>
                <div class="block">

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-2" class="">
                        @csrf
                        <div class="relative inline-flex items-center rounded-xs gap-1 bg-white dark:bg-gray-900 p-1">

                            <x-input-label for="email" :value="__('Email')" class="sr-only" />
                            <x-text-input id="email"
                                class="min-w-56 block font-bebas-neue tracking-widest text-sm w-full rounded-e-none pl-8"
                                type="email" placeholder="enter your email" name="email" :value="old('email')"
                                required />
                            <x-heroicon-o-envelope class="absolute left-2 w-6 h-7 text-gray-500 mb-0.5" />

                            <x-primary-button
                                class="px-4 !py-1.5 mr-0.5 !text-sm font-bold grid place-content-center rounded-s-none bg-primary dark:bg-primary">
                                Subscribe
                            </x-primary-button>
                        </div>
                    </form>

                    <x-input-error :messages="$errors->get('email')" class="mt-2 font-benne text-red-500 text-sm" />

                    @if (session('success'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-show="show"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="mt-1 text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
