<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full sm:min-h-[80vh] flex flex-col item-center justify-center gap-4">
        <div class="inline-flex font-benne ml-auto sm:mb-auto text-sm tracking-wide text-gray-400">
            Don&backprime;t have an account?&nbsp;
            <a href="/register" class="hover:text-primary hover:underline font-bebas-neue">sign up</a>
        </div>
        <h1 class=" font-bebas-neue text-xl tracking-wide">Sign In</h1>
        <button
            class="inline-flex font-benne rounded-sm items-center justify-center gap-1.5 w-full bg-white border-gray-400 py-2 border">
            <div class="w-4 h-4 mb-1">
                <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#EA4335"
                        d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" />
                    <path fill="#4285F4"
                        d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z" />
                    <path fill="#FBBC05"
                        d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z" />
                    <path fill="#34A853"
                        d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" />
                    <path fill="none" d="M0 0h48v48H0z" />
                </svg>
            </div>
            Sign in with Google
        </button>

        <div class="block relative my-2">
            <p
                class="bg-white text-xs font-bebas-neue px-2.5 tracking-widest text-gray-400 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                or sign in with email</p>
            <hr class="w-full h-1 text-gray-400" />
        </div>

        <form method="POST" action="{{ route('login') }}" class="mt-2 sm:my-8">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="" />
                <x-text-input id="email" type="email" name="email" class="block mt-1 w-full" :has-error="$errors->has('email')"
                    :value="old('email')" required autofocus autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 font-benne" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2 font-benne" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex  font-bebas-neue items-center ">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary shadow-sm focus:ring-primary dark:focus:ring-primary dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex  font-bebas-neue items-center justify-end mt-6 gap-3">
                @if (Route::has('password.request'))
                    <a class="hover:underline text-sm tracking-wide text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="px-8 rounded-xs grid place-content-center">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
