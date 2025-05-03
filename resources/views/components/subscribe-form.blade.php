<section class="h-fit mt-8 px-4 sm:px-6 md:px-8 lg:px-16">
    <div class="flex item-center p-8 pt-16 justify-between gap-4 w-full h-fit bg-white/95 dark:bg-gray-900">
        <div class="flex flex-col w-full items-center justify-center gap-y-6">
            <div class="flex flex-col max-w-fit items-center">
                <h1 class="lg:text-3xl md:text-2xl tracking-wider font-bebas-neue pt-1.5 dark:text-gray-200">
                    Postly ~
                    <span class="text-primary">Never Miss a Post That Matters</span>
                </h1>
            </div>

            <div class="max-w-xl w-full inline-flex items-center justify-between p-4 px-8 bg-primary">
                <div class="text-lg md:text-xl max-w-sm font-bold">
                    <p>Get the latest articles, tips, and exclusive content delivered straight to your inbox every
                        week.</p>
                </div>

                <form method="POST" action="{{ route('login') }}"
                    class="flex items-center justify-center min-w-[35%] rounded-xs gap-1 sm:my-8 bg-white dark:bg-gray-900 p-1">
                    @csrf
                    <div class="w-full">
                        <x-input-label for="input-email-subscribe" :value="__('Email')" class="sr-only" />
                        <x-text-input id="input-email-subscribe"
                            class="block font-bebas-neue tracking-widest w-full !shadow-none drop-shadow-none rounded-xs outline-0 border-0 rounded-e-none"
                            type="email" placeholder="enter your email" name="input-email-subscribe" :value="old('email')"
                            required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 font-benne" />
                    </div>

                    <div class="inline-flex items-center">
                        <x-primary-button
                            class="px-6 mr-0.5 !text-base font-bold grid place-content-center rounded-s-none bg-primary dark:bg-primary">
                            Subscribe
                            <x-fas-arrow-right class="w-4 h-4 font-bold ml-1" />
                        </x-primary-button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
