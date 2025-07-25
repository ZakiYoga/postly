<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="w-full min-h-[80vh] flex flex-col item-center justify-center gap-4">
        <h1 class=" font-bebas-neue text-xl tracking-wide">Sign Up</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4 gap-3">
                <div class="inline-flex items-center font-benne text-sm tracking-wide text-gray-400">
                    Already registered?&nbsp;
                    <a href="{{ route('login') }}" class="hover:text-primary hover:underline font-bebas-neue">sign
                        in</a>
                </div>
                <x-primary-button
                    class="px-8 grid place-content-center hover:bg-primary/60 dark:hover:text-white dark:hover:bg-gray-200">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-guest-layout>
