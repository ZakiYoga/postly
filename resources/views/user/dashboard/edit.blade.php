@extends('user.layouts.app')

@push('style')
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
@endpush

@section('title')
    Dashboard - Edit Post
@endsection

@section('content')
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => '/dashboard'],
        ['label' => 'Posts', 'url' => '/dashboard/posts'],
        ['label' => 'Edit Post'],
    ]" />

    <div class="flex p-6 bg-white dark:bg-background-foreground rounded-sm shadow-md font-benne">
        <div class="flex flex-col w-full max-w-2xl mx-auto">
            <x-heading>
                Edit Post

            </x-heading>
            <form method="post" action="/dashboard/posts/{{ $post->slug }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="flex flex-col gap-y-4 w-full dark:border-gray-700">

                    {{-- Field Title --}}
                    <div class="flex w-full gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="flex flex-col w-full max-w-md">
                            <x-input-label for="title" :value="__('Title')" class="" />
                            <x-text-input id="title" type="text" name="title" class="block mt-1 w-full"
                                :has-error="$errors->has('title')" :value="old('title', $post->title)" autocomplete="title" />
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

                    {{-- File Upload Input with Preview --}}
                    <div class="col-span-full max-w-sm">
                        <x-input-label for="cover_image" :value="__('Cover Post Image')" />
                        <div class="mt-2 flex flex-col items-start">
                            <input type="hidden" id="remove_image" name="remove_image" value="0">
                            {{-- Old Image --}}
                            <input type="hidden" name="oldCover_Image"
                                value="{{ $post->cover_image ?? ($post->unsplash_image_url ?? '') }}">

                            {{-- Hidden actual file input --}}
                            <input type="file" id="cover_image" name="cover_image" accept="image/*" class="hidden"
                                onchange="previewImage()" />
                            <div class="inline-flex items-center gap-2">

                                {{-- Custom upload button --}}
                                <button id="btn-upload" type="button"
                                    onclick="document.getElementById('cover_image').click()"
                                    class="inline-flex justify-center items-center gap-0.5 rounded-sm bg-white dark:bg-gray-800 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.8" stroke="#2F3A4A" class="w-5 h-5 pb-0.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16V4m0 0l-5 5m5-5l5 5M4 16v4a1 1 0 001 1h14a1 1 0 001-1v-4" />
                                    </svg>
                                    <span class="text-sm/6 pt-1">Select Image</span>
                                </button>
                            </div>

                            {{-- File name display --}}
                            <p id="file-name" class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                @if ($post->cover_image || $post->unsplash_image_url)
                                    Current image loaded
                                @else
                                    No file selected
                                @endif
                            </p>

                            {{-- Preview container --}}
                            <div id="preview-container" class="mt-2 w-full hidden">
                                <div class="relative group overflow-hidden">
                                    {{-- Remove button --}}
                                    <div
                                        class="absolute w-full h-full hidden items-center justify-center inset-shadow-neutral-500 bg-black/30 z-10 rounded-sm group-hover:flex">
                                        <button type="button" onclick="removeImage()"
                                            class="hidden z-10 absolute px-3 py-2 group-hover:inline-flex -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 items-center justify-center rounded-xs bg-red-500 text-white focus:outline-none hover:bg-red-600 transition-all ease-in-out duration-300"
                                            aria-label="Remove image">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            remove image
                                        </button>
                                    </div>

                                    {{-- Preview image - --}}
                                    @if ($post->cover_image)
                                        <img id="preview-image" src="{{ asset('storage/' . $post->cover_image) }}"
                                            alt="Image preview"
                                            class="max-h-72 h-auto w-full scale-100 group-hover:scale-110 transition-all ease-in-out duration-300 rounded-sm border border-gray-200 dark:border-gray-700 object-cover shadow-sm" />
                                    @elseif ($post->unsplash_image_url)
                                        <img id="preview-image" src="{{ $post->unsplash_image_url }}" alt="Image preview"
                                            class="max-h-72 h-auto w-full scale-100 group-hover:scale-110 transition-all ease-in-out duration-300 rounded-sm border border-gray-200 dark:border-gray-700 object-cover shadow-sm" />
                                    @else
                                        <img id="preview-image" alt="Image preview"
                                            class="max-h-72 h-auto w-full scale-100 group-hover:scale-110 transition-all ease-in-out duration-300 rounded-sm border border-gray-200 dark:border-gray-700 object-cover shadow-sm" />
                                    @endif
                                </div>
                            </div>

                            <img id="preview-image" src="{{ old('cover_image') }}" class="w-64 mt-2"
                                style="display: {{ old('cover_image') ? 'block' : 'none' }};">

                            @error('cover_image')
                                <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                            @enderror
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

                    {{-- Field visibility --}}
                    <div class="col-span-full">
                        <x-input-label for="visibility" :value="__('Visibility')" class="" />
                        <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Set the visibility of your post.
                        </p>
                        <div class="mt-6 space-y-6">
                            @foreach (['public' => 'Public', 'private' => 'Private'] as $value => $label)
                                <div class="flex items-center gap-x-3">
                                    <input id="{{ $value }}" name="visibility" type="radio"
                                        value="{{ $value }}"
                                        {{ old('visibility', $post->visibility) === $value ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 checked:ring-primary checked:bg-primary checked:text-primary focus:ring-primary">

                                    <label for="{{ $value }}"
                                        class="block text-sm/6 font-medium text-gray-900 dark:text-gray-100">{{ $label }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <a href="{{ route('posts.index') }}"
                            class="rounded-sm bg-transparent px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-300 border border-gray-300">
                            Cancel
                        </a>
                        <button type="submit"
                            class="rounded-sm bg-primary px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-primary/80 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                            Edit Post
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    @push('script')
        <script src="/js/checkSlug.js"></script>
        <script src="/js/previewImage.js"></script>
        <script src="/js/showImageEdit.js"></script>
    @endpush
@endsection
