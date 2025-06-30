<section id="subscribe" class="h-fit w-full">
    <div class="item-center flex h-fit w-full justify-center gap-4 bg-slate-800 p-12">
        <div class="flex w-full max-w-sm flex-col items-center gap-y-6 px-4 md:max-w-md lg:max-w-lg">
            <div class="flex max-w-fit flex-col items-center">
                <h1 class="font-bebas-neue pt-1.5 tracking-wider text-gray-200 md:text-2xl lg:text-3xl">
                    Postly ~
                    <span class="text-primary">Never Miss a Post That Matters</span>
                </h1>
            </div>

            <div
                class="md:w-md lg:w-lg bg-primary dark:bg-primary/80 flex w-full flex-col items-start justify-between gap-x-8 overflow-hidden p-6 pt-8 md:flex-row md:px-8">
                <div class="w-full text-center text-xl font-bold md:max-w-[30rem] md:text-xl lg:text-left">
                    <p>Get the latest articles, tips, and exclusive content delivered straight to your inbox every
                        week.</p>
                </div>
                <div class="w-full sm:w-fit">
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="w-full space-y-2"
                        class="">
                        @csrf
                        <div
                            class="rounded-xs relative flex flex-col items-center gap-1 bg-slate-800 p-1 sm:flex-row dark:bg-gray-900">

                            <x-input-label for="email" :value="__('Email')" class="sr-only" />
                            <x-text-input id="email"
                                class="font-bebas-neue !dark:bg-gray-900 block w-full rounded-e-none !border-0 !border-none !bg-slate-800 pl-8 text-sm tracking-widest !text-gray-400 !outline-0"
                                type="email" placeholder="enter your email" name="email" :value="old('email')"
                                required />
                            <x-heroicon-o-envelope class="absolute left-2 mb-0.5 h-7 w-6 text-gray-500" />

                            <button type="submit"
                                class="font-bebas-neue rounded-xs bg-primary dark:bg-primary group inline-flex w-fit rounded-s-none px-4 py-1.5 tracking-wide transition-all duration-300">
                                <span class="transition-all duration-300 group-hover:-translate-x-0.5">Subscribe</span>
                                <x-heroicon-o-arrow-long-right
                                    class="h-6 w-5 transition-all duration-300 group-hover:w-6 group-hover:translate-x-0.5" />
                            </button>
                        </div>
                    </form>

                    <div
                        class="newsletter-form-footer mx-auto mt-2 max-w-screen-sm text-left text-sm text-gray-600 dark:text-gray-300">
                        We care about the protection of your data.
                        <a href="#" class="text-primary-600 dark:text-primary-500 font-medium hover:underline">
                            Read our Privacy Policy
                        </a>.
                    </div>

                    <x-input-error :messages="$errors->get('email')" class="font-benne mt-2 text-sm text-red-500" />

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
