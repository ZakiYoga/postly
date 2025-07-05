<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Session Status -->
    <x-auth-session-status class="mb-2" :status="session('status')" />

    <div class="w-ful min-h-11/12 flex flex-col item-center gap-4">
        @if (session('error'))
            <x-alert type="error" title="Error!" :duration="3000">
                {{ session('error') }}
            </x-alert>
        @endif
        <div class="inline-flex ml-auto sm:mb-auto text-gray-400 leading-4">
            Don&backprime;t have an account?&nbsp;
            <a href="/register" class="hover:text-primary hover:underline font-bebas-neue tracking-wide">sign up</a>
        </div>
        <h1 class=" font-bebas-neue text-xl tracking-wide">Sign In</h1>
        <a href="/auth/google/redirect"
            class="inline-flex text-sm rounded-sm items-center justify-center gap-1.5 w-full bg-white border-gray-400 py-2 dark:bg-gray-800 border dark:border-gray-900 hover:bg-gray-200 dark:hover:bg-gray-800/60">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 48 48">
                <path fill="#FFC107"
                    d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                </path>
                <path fill="#FF3D00"
                    d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                </path>
                <path fill="#4CAF50"
                    d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                </path>
                <path fill="#1976D2"
                    d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                </path>
            </svg>
            Sign in with Google
        </a>

        <div class="block relative my-2">
            <p
                class="bg-white dark:bg-gray-900 text-xs font-bebas-neue px-2.5 tracking-widest text-gray-400 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
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
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
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

                <x-primary-button
                    class="px-8 rounded-xs grid place-content-center hover:bg-primary/60 dark:hover:text-white dark:hover:bg-gray-200">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
