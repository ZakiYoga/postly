<section id="subscribe" class="w-full h-fit">
    <div class="flex item-center justify-center p-12 gap-4 w-full h-fit bg-slate-800">
        <div class="flex flex-col w-full items-center gap-y-6 px-4 max-w-sm md:max-w-md lg:max-w-lg">
            <div class="flex flex-col max-w-fit items-center">
                <h1 class="lg:text-3xl md:text-2xl tracking-wider font-bebas-neue pt-1.5 text-gray-200">
                    Postly ~
                    <span class="text-primary">Never Miss a Post That Matters</span>
                </h1>
            </div>

            <div class="w-full md:w-md lg:w-lg inline-flex items-start justify-between gap-x-8 p-6 pt-8 md:px-8 bg-primary dark:bg-primary/80 dark:">
                <div class="text-xl md:text-xl max-w-[30rem] font-bold">
                    <p>Get the latest articles, tips, and exclusive content delivered straight to your inbox every
                        week.</p>
                </div>
                <div class="flex items-center justify-center flex-col">
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class=" w-full space-y-2" class="">
                        @csrf
                        <div class="relative inline-flex items-center rounded-xs gap-1 bg-slate-800 dark:bg-gray-900 p-1">

                            <x-input-label for="email" :value="__('Email')" class="sr-only" />
                            <x-text-input id="email" class="min-w-56 block font-bebas-neue tracking-widest text-sm w-full rounded-e-none pl-8 !bg-slate-800 !dark:bg-gray-900 !text-gray-400 !border-none !border-0 !outline-0" type="email" placeholder="enter your email" name="email" :value="old('email')" required />
                            <x-heroicon-o-envelope class="absolute left-2 w-6 h-7 text-gray-500 mb-0.5" />

                            <button type="submit" class="inline-flex font-bebas-neue tracking-wide px-4 py-1.5 rounded-xs rounded-s-none bg-primary dark:bg-primary transition-all duration-300 group">
                                <span class="group-hover:-translate-x-0.5 transition-all duration-300">Subscribe</span>
                                <x-heroicon-o-arrow-long-right class="w-5 group-hover:w-6 group-hover:translate-x-0.5 h-6 transition-all duration-300" />
                            </button>
                        </div>
                    </form>

                    <div class="mt-2 mx-auto max-w-screen-sm text-sm text-left text-gray-600 newsletter-form-footer dark:text-gray-300">
                        We care about the protection of your data.
                        <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">
                            Read our Privacy Policy
                        </a>.
                    </div>

                    <x-input-error :messages="$errors->get('email')" class="mt-2 font-benne text-red-500 text-sm" />

                    @if (session('success'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-1 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
