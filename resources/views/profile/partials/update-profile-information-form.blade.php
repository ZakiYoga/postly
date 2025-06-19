<section>
    <header>
        <x-heading>
            {{ __('Profile Information') }}
        </x-heading>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" enctype="multipart/form-data"
        action="{{ Auth::user()->role === 'admin' ? route('admin.settings.update') : route('settings.update') }}"
        class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Avatar Section -->
        <div>
            <x-input-label for="avatar" class="w-fit" :value="__('Avatar')" />
            <div class="mt-2 flex items-center space-x-4">
                <div class="max-w-20">
                    <div class="w-20 h-20 object-center rounded-sm overflow-hidden">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                </div>
                <div
                    class="flex flex-col gap-2 {{ Auth::user()->avatar && !Str::startsWith(Auth::user()->avatar, 'avatars/laravolt') ? 'mt-auto' : 'mt-0' }}">
                    <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden"
                        onchange="previewAvatar(this)">
                    <label for="avatar"
                        class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-sm shadow-sm text-xs leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Change Avatar') }}
                    </label>
                    @if (Auth::user()->avatar && !Str::startsWith(Auth::user()->avatar, 'avatars/laravolt'))
                        <button type="button" onclick="deleteAvatar()"
                            class="bg-red-600 py-2 px-3 border border-transparent rounded-sm shadow-sm text-xs font-medium leading-4 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            {{ __('Delete') }}
                        </button>
                    @endif
                </div>
            </div>
            <p id="avatar-name" class="text-sm mt-2"></p>

            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)"
                required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <!-- Delete Avatar Form (Hidden) -->
    <form id="delete-avatar-form" action="{{ route('profile.avatar.delete') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</section>
