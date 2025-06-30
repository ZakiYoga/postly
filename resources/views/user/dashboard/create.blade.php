@extends('layouts.dashboard.app')

@section('title')
    Dashboard | Create Post
@endsection

@section('content')
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => '/dashboard'],
        ['label' => 'Posts', 'url' => '/dashboard/posts'],
        ['label' => 'Create Post'],
    ]" />

    <div class="font-benne flex rounded-sm bg-white p-6 shadow-md dark:bg-slate-900">
        <div class="mx-auto flex w-full max-w-2xl flex-col">
            <x-heading class="mb-4">
                Create Post
            </x-heading>

            <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
                @csrf
                <div class="flex w-full flex-col gap-y-4 dark:border-gray-700">

                    {{-- Field Title --}}
                    <div class="flex w-full gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="flex w-full max-w-md flex-col">
                            <x-input-label for="title" :value="__('Title')"
                                class="after:pb-5 after:text-sm after:text-red-500 after:content-['*']" />
                            <x-text-input id="title" type="text" name="title" class="mt-1 block w-full"
                                :has-error="$errors->has('title')" :value="old('title')" autofocus required autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Field Slug --}}
                    <div class="col-span-full flex max-w-md flex-col">
                        <x-input-label for="slug" :value="__('Slug')"
                            class="after:pb-5 after:text-sm after:text-red-500 after:content-['*']" />
                        <p class="text-muted text-sm leading-4 dark:text-gray-400">
                            The slug will be automatically generated from
                            the title, but you can edit it.
                        </p>
                        <div class="mt-2">
                            <div
                                class="focus-within:outline-primary flex items-center justify-start rounded-sm bg-gray-50 pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 dark:bg-gray-800 dark:outline-gray-600">
                                <div
                                    class="select-none text-base font-medium text-gray-500 sm:text-sm/6 dark:text-gray-400">
                                    postly.com/posts/
                                </div>
                                <div class="w-full">
                                    <x-text-input id="slug" type="text" name="slug"
                                        class="ml-1 rounded-s-none pl-1" :has-error="$errors->has('slug')" :value="old('slug')" required
                                        autocomplete="slug" />
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>
                    </div>


                    {{-- File Upload Input with Preview --}}
                    <div class="col-span-full max-w-sm">
                        <label
                            class="font-bebas-neue block font-medium tracking-wider text-gray-700 after:pb-5 after:text-sm after:text-red-500 after:content-['*'] lg:text-lg dark:text-gray-300">
                            Featured Image
                        </label>
                        <p class="text-muted text-sm leading-4 dark:text-gray-400">
                            Toggle <span class="font-medium">'ON'</span> to auto-generate an image from Unsplash based on
                            the
                            category.
                        </p>
                        <div x-data="{ generate_unsplash: true }" class="mt-2 flex flex-col items-start">
                            {{-- Hidden actual file input --}}
                            <input type="file" id="cover_image" name="cover_image" accept="image/*" class="hidden"
                                onchange="previewImage()" />

                            {{-- Custom upload button --}}
                            <div class="mb-4">
                                <!-- Toggle Switch -->
                                <div class="flex items-center gap-3">
                                    <label class="relative inline-flex cursor-pointer">
                                        <!-- Hidden Checkbox untuk Form Submission -->
                                        <input type="checkbox" id="generate_unsplash" name="generate_unsplash"
                                            x-model="generate_unsplash" @change="handleToggleChange($event)"
                                            class="sr-only">

                                        <!-- Custom Toggle Design -->
                                        <div :class="generate_unsplash ? 'bg-primary' : 'bg-gray-300'"
                                            class="focus-within:ring-primary relative inline-flex h-8 w-16 items-center rounded-full transition-colors duration-200 ease-in-out focus-within:ring-2 focus-within:ring-offset-2">
                                            <span :class="generate_unsplash ? 'translate-x-9' : 'translate-x-1'"
                                                class="inline-block h-6 w-6 transform rounded-full bg-white shadow-lg transition-transform duration-200 ease-in-out">
                                            </span>
                                            <span
                                                :class="generate_unsplash ? 'left-2.5 text-white' :
                                                    'right-2.5 text-gray-400 dark:text-gray-600'"
                                                class="absolute text-xs font-semibold transition-all duration-200"
                                                x-text="generate_unsplash ? 'ON' : 'OFF' ">
                                            </span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div x-show="!generate_unsplash" x-transition:enter="transition ease-out duration-300 transform"
                                x-transition:enter-start="opacity-0 -translate-y-4"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-200 transform"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-4"
                                class="inline-flex w-full items-center gap-2">

                                <button type="button" id="btn-upload"
                                    onclick="document.getElementById('cover_image').click()"
                                    class="item-center inline-flex gap-0.5 rounded-sm px-4 py-2 text-sm font-semibold text-gray-600 shadow-sm ring-1 ring-inset ring-gray-300 transition-colors duration-150 hover:bg-gray-50 dark:text-gray-100 dark:hover:text-gray-800">
                                    Select Featured Image
                                </button>

                                {{-- File name display --}}
                                <p id="file-name" class="mt-2 text-sm text-gray-500 dark:text-gray-400">No file selected</p>
                            </div>


                            {{-- Preview container --}}
                            <div id="preview-container" class="mt-4 hidden w-full">
                                <div class="group relative overflow-hidden">
                                    {{-- Remove button --}}
                                    <div
                                        class="inset-shadow-neutral-500 absolute z-10 hidden h-full w-full items-center justify-center rounded-sm bg-black/30 group-hover:flex">
                                        <button type="button" onclick="removeImage()"
                                            class="rounded-xs absolute left-1/2 top-1/2 z-10 hidden -translate-x-1/2 -translate-y-1/2 items-center justify-center bg-red-500 px-3 py-2 text-white transition-all duration-300 ease-in-out hover:bg-red-600 focus:outline-none group-hover:inline-flex"
                                            aria-label="Remove image">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            remove image
                                        </button>
                                    </div>

                                    {{-- Preview image --}}
                                    <img id="preview-image" src="#" alt="Image preview"
                                        class="h-auto max-h-72 w-full scale-100 rounded-sm border border-gray-200 object-cover shadow-sm transition-all duration-300 ease-in-out group-hover:scale-110 dark:border-gray-700" />
                                </div>
                            </div>
                            @error('cover_image')
                                <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                            @enderror
                        </div>
                    </div>

                    {{-- Field Body with trix editor --}}
                    <div class="col-span-full max-w-md">
                        <x-input-label for="body" :value="__('Content')"
                            class="after:pb-5 after:text-sm after:text-red-500 after:content-['*']" />
                        <div class="relative mt-2">
                            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                            <trix-editor input="body"
                                class="trix-content @error('body') !border-red-500 @enderror !focus:-outline-offset-2 !focus:outline-primary border outline-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:outline-gray-600">
                            </trix-editor>
                            @error('body')
                                <x-heroicon-o-exclamation-triangle
                                    class="absolute bottom-2.5 right-2.5 z-10 size-5 text-red-500 dark:text-red-400" />
                            @enderror
                        </div>
                        @error('body')
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        @enderror
                    </div>

                    {{-- Field Category --}}
                    <div class="col-span-full flex w-fit flex-col">
                        <x-input-label for="category" :value="__('Category')"
                            class="after:pb-5 after:text-sm after:text-red-500 after:content-['*']" />
                        <div class="relative mt-2 grid grid-cols-1">
                            <select id="category_id" name="category_id"
                                class="focus:outline-primary w-full appearance-none rounded-sm bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 sm:text-sm/6 dark:bg-gray-800 dark:text-gray-100 dark:outline-gray-600"
                                required>
                                <option disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" class="space-y-0.5 text-[{{ $category->color }}]"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        <svg class="pointer-events-none absolute right-3 top-1/2 size-5 -translate-y-1/2 text-gray-500 dark:text-gray-400"
                                            viewBox="0 0 16 16" fill="currentColor">
                                            <path fill-rule="evenodd" d="..." clip-rule="evenodd" />
                                        </svg>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="pointer-events-none absolute right-3 top-1/2 size-5 -translate-y-1/2 text-gray-500 dark:text-gray-400"
                                viewBox="0 0 16 16" fill="currentColor">
                                <path fill-rule="evenodd" d="..." clip-rule="evenodd" />
                            </svg>
                            @error('category_id')
                                <x-input-error :messages="__('The category field is required')" class="mt-2" />
                            @enderror
                        </div>
                    </div>

                    {{-- Field visibility --}}
                    <div class="col-span-full">
                        <x-input-label for="visibility" :value="__('Visibility')"
                            class="after:pb-5 after:text-sm after:text-red-500 after:content-['*']" />
                        <p class="text-muted dark:text-gray-400">
                            Set the visibility of your post.
                        </p>
                        <div class="mt-6 space-y-6">
                            @foreach (['public' => 'Public', 'private' => 'Private'] as $value => $label)
                                <div class="flex items-center gap-x-3">
                                    <input id="{{ $value }}" name="visibility" type="radio"
                                        value="{{ $value }}"
                                        {{ old('visibility', 'public') === $value ? 'checked' : '' }}
                                        class="checked:ring-primary checked:bg-primary checked:text-primary focus:ring-primary h-4 w-4 appearance-none">

                                    <label for="{{ $value }}"
                                        class="block text-sm/6 font-medium text-gray-900 dark:text-gray-100">{{ $label }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-4">
                        <a href="{{ route('posts.index') }}"
                            class="shadow-xs rounded-sm border border-gray-300 bg-transparent px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-300 dark:text-gray-100 dark:hover:bg-gray-700">
                            Cancel
                        </a>
                        <button type="submit"
                            class="bg-primary shadow-xs hover:bg-primary/80 focus-visible:outline-primary rounded-sm px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2">
                            Create Post
                        </button>
                    </div>
            </form>

        </div>
    </div>

    @push('script')
        <script src="/js/checkSlug.js"></script>
        <script src="/js/previewImage.js"></script>
        <script>
            document.addEventListener('trix-file-accept', function(e) {
                e.preventDefault();
            });
        </script>
    @endpush
@endsection
