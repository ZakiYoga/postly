@extends('user.layouts.app')

@section('style')
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
@endsection

@section('title')
    Dashboard - Edit Post
@endsection

@section('content')
    <div class="flex p-6 bg-white dark:bg-background-foreground rounded-sm shadow-md font-benne">
        <div class="flex flex-col w-full max-w-2xl mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 mb-2 font-bebas-neue">Edit Post</h1>
            <span class="inline-flex items-center gap-1 text-gray-500 mb-4">
                <a href="/dashboard" class="hover:text-primary">
                    Dashboard
                </a>
                <x-ri-arrow-right-double-fill class="w-4 h-4 pb-1" />
                Edit Post
            </span>

            <form method="post" action="/dashboard/posts/{{ $post->slug }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="flex flex-col gap-y-4 w-full dark:border-gray-700">

                    {{-- Field Title --}}
                    <div class="flex w-full gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="flex flex-col w-full max-w-md">
                            <x-input-label for="title" :value="__('Title')" class="" />
                            <x-text-input id="title" type="text" name="title" class="block mt-1 w-full"
                                :has-error="$errors->has('title')" :value="old('title', $post->title)" autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Field Slug --}}
                    <div class="flex flex-col max-w-md">
                        <x-input-label for="slug" :value="__('Slug')" class="" />
                        <div class="mt-2">
                            <div
                                class="flex items-center justify-start rounded-sm bg-gray-50 dark:bg-gray-800 pl-3 outline-1 -outline-offset-1 outline-gray-300 dark:outline-gray-600 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-primary">
                                <div
                                    class="text-base font-medium text-gray-500 dark:text-gray-400 select-none sm:text-sm/6">
                                    postly.com/posts/
                                </div>
                                <div class="w-full">
                                    <x-text-input id="slug" type="text" name="slug"
                                        class="ml-1 pl-1 rounded-s-none" :has-error="$errors->has('slug')" :value="old('slug', $post->slug)"
                                        autocomplete="slug" />
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            <small class="text-muted dark:text-gray-400">The slug will be automatically generated from
                                the title, but you can edit it.</small>
                        </div>
                    </div>

                    {{-- Field Body with trix editor --}}
                    <div class="col-span-full">
                        <x-input-label for="body" :value="__('Content')" class="" />
                        <div class="mt-2">
                            <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                            <trix-editor input="body"
                                class="trix-content dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"></trix-editor>
                        </div>
                        @error('body')
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        @enderror
                    </div>

                    {{-- Field Upload Image Cover
                    <div class="col-span-full flex flex-col max-w-sm">
                        <x-input-label for="cover_image" :value="__('Cover Image')" class="" />

                        <div
                            class="mt-2 flex justify-center rounded-lg border-2 border-dashed border-gray-900/25 dark:border-gray-600 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto size-12 text-gray-300 dark:text-gray-600" viewBox="0 0 24 24"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="..." clip-rule="evenodd" />
                                </svg>
                                <div class="mt-4 flex text-sm/6 text-gray-600 dark:text-gray-400">
                                    <label for="cover_image"
                                        class="relative cursor-pointer rounded-sm bg-white dark:bg-gray-800 font-semibold text-primary hover:text-primary/80">
                                        <span>Upload a file</span>
                                        <input id="cover_image" name="cover_image" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs/5 text-gray-600 dark:text-gray-400">PNG, JPG, GIF max size 1MB</p>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Field Category --}}
                    <div class="col-span-full flex flex-col w-fit">
                        <x-input-label for="category" :value="__('Category')" class="" />

                        <div class="mt-2 grid grid-cols-1 relative">
                            <select id="category_id" name="category_id"
                                class="w-full appearance-none rounded-sm bg-white dark:bg-gray-800 py-1.5 pr-8 pl-3 text-base text-gray-900 dark:text-gray-100 outline-1 -outline-offset-1 outline-gray-300 dark:outline-gray-600 focus:outline-2 focus:-outline-offset-2 focus:outline-primary sm:text-sm/6">
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    @if (old('category_id', $post->category_id) == $category->id)
                                        <option value="{{ $category->id }}" selected>
                                            {{ $category->name }}
                                        </option>
                                    @else
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 size-5 text-gray-500 dark:text-gray-400"
                                viewBox="0 0 16 16" fill="currentColor">
                                <path fill-rule="evenodd" d="..." clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    {{-- Field Status --}}
                    <div class="col-span-full">
                        <x-input-label for="status" :value="__('Status')" class="" />
                        <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Set the visibility of your post.
                        </p>
                        <div class="mt-6 space-y-6">
                            @foreach (['published' => 'Public', 'private' => 'Private', 'draft' => 'Draft'] as $value => $label)
                                <div class="flex items-center gap-x-3">
                                    <input id="{{ $value }}" name="status" type="radio"
                                        value="{{ $value }}"
                                        {{ old('status', $post->status) === $value ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 checked:ring-primary checked:bg-primary checked:text-primary focus:ring-primary">

                                    <label for="{{ $value }}"
                                        class="block text-sm/6 font-medium text-gray-900 dark:text-gray-100">{{ $label }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button"
                            class="text-sm/6 font-semibold text-gray-900 dark:text-gray-100">Cancel</button>
                        <button type="submit"
                            class="rounded-sm bg-primary px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-primary/80 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Create
                            Post</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/posts/checkSlug?title=' + encodeURIComponent(title.value))
                .then(response => response.json())
                .then(data => slug.value = data.slug)
                .catch(error => console.error('Error:', error));
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });

        // document.addEventListener('trix-file-accept', function(e) {
        //     const acceptedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
        //     if (!acceptedTypes.includes(e.file.type)) {
        //         e.preventDefault();
        //         alert('Only JPEG, JPG and PNG files are allowed.');
        //     }
        // });

        // if (e.file.size > 2 * 1024 * 1024) {
        //     e.preventDefault();
        //     alert('Ukuran file maksimal adalah 2MB!');
        // }
    </script>
@endsection
