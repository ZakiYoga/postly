@extends('user.layouts.app')

@section('title')
    Dashboard | Create Post
@endsection

@section('content')
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => '/dashboard'],
        ['label' => 'Posts', 'url' => '/dashboard/posts'],
        ['label' => 'Create Post'],
    ]" />

    <div class="flex p-6 bg-white dark:bg-background-foreground rounded-sm shadow-md font-benne">
        <div class="flex flex-col w-full max-w-2xl mx-auto">
            <x-heading>
                Create Post
            </x-heading>

            <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-y-4 w-full dark:border-gray-700">

                    {{-- Field Title --}}
                    <div class="flex w-full gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="flex flex-col w-full max-w-md">
                            <x-input-label for="title" :value="__('Title')" class="" />
                            <x-text-input id="title" type="text" name="title" class="block mt-1 w-full"
                                :has-error="$errors->has('title')" :value="old('title')" autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Field Slug --}}
                    <div class="col-span-full flex flex-col max-w-md">
                        <x-input-label for="slug" :value="__('Slug')" class="" />
                        <small class="text-muted leading-6 dark:text-gray-400">
                            The slug will be automatically generated from
                            the title, but you can edit it.
                        </small>
                        <div class="mt-2">
                            <div
                                class="flex items-center justify-start rounded-sm bg-gray-50 dark:bg-gray-800 pl-3 outline-1 -outline-offset-1 outline-gray-300 dark:outline-gray-600 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-primary">
                                <div
                                    class="text-base font-medium text-gray-500 dark:text-gray-400 select-none sm:text-sm/6">
                                    postly.com/posts/
                                </div>
                                <div class="w-full">
                                    <x-text-input id="slug" type="text" name="slug"
                                        class="ml-1 pl-1 rounded-s-none" :has-error="$errors->has('slug')" :value="old('slug')"
                                        autocomplete="slug" />
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>
                    </div>


                    {{-- File Upload Input with Preview --}}
                    <div class="col-span-full max-w-sm">
                        <x-input-label for="cover_image" :value="__('Cover Post Image')" />
                        <div class="mt-2 flex flex-col items-start">
                            {{-- Hidden actual file input --}}
                            <input type="file" id="cover_image" name="cover_image" accept="image/*" class="hidden"
                                onchange="previewImage()" />

                            {{-- Custom upload button --}}
                            <button type="button" onclick="document.getElementById('cover_image').click()"
                                class="rounded-sm bg-white dark:bg-gray-800 px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                Select Cover Image
                            </button>

                            {{-- File name display --}}
                            <p id="file-name" class="mt-2 text-sm text-gray-500 dark:text-gray-400">No file selected</p>

                            {{-- Preview container --}}
                            <div id="preview-container" class="mt-4 hidden w-full">
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

                                    {{-- Preview image --}}
                                    <img id="preview-image" src="#" alt="Image preview"
                                        class="max-h-72 h-auto w-full scale-100 group-hover:scale-110 transition-all ease-in-out duration-300 rounded-sm border border-gray-200 dark:border-gray-700 object-cover shadow-sm" />
                                </div>
                            </div>
                            @error('cover_image')
                                <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                            @enderror
                        </div>
                    </div>

                    {{-- Field Body with trix editor --}}
                    <div class="col-span-full max-w-md">
                        <x-input-label for="body" :value="__('Content')" class="" />
                        <div class="mt-2 relative ">
                            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                            <trix-editor input="body"
                                class="trix-content @error('body') !border-red-500 @enderror border dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 outline-gray-300 dark:outline-gray-600 !focus:-outline-offset-2 !focus:outline-primary">
                            </trix-editor>
                            @error('body')
                                <x-heroicon-o-exclamation-triangle
                                    class="absolute right-2.5 bottom-2.5 z-10 size-5 text-red-500 dark:text-red-400" />
                            @enderror
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
                                <option disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" class="space-y-0.5 text-[{{ $category->color }}]"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 size-5 text-gray-500 dark:text-gray-400"
                                            viewBox="0 0 16 16" fill="currentColor">
                                            <path fill-rule="evenodd" d="..." clip-rule="evenodd" />
                                        </svg>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 size-5 text-gray-500 dark:text-gray-400"
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
                        <x-input-label for="visibility" :value="__('Visibility')" class="" />
                        <small class="text-muted dark:text-gray-400">
                            Set the visibility of your post.
                        </small>
                        <div class="mt-6 space-y-6">
                            @foreach (['public' => 'Public', 'private' => 'Private'] as $value => $label)
                                <div class="flex items-center gap-x-3">
                                    <input id="{{ $value }}" name="visibility" type="radio"
                                        value="{{ $value }}"
                                        {{ old('visibility', 'public') === $value ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 checked:ring-primary checked:bg-primary checked:text-primary focus:ring-primary">

                                    <label for="{{ $value }}"
                                        class="block text-sm/6 font-medium text-gray-900 dark:text-gray-100">{{ $label }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-4">
                        <a href="{{ route('user.dashboard') }}"
                            class="rounded-sm bg-transparent px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-300 border border-gray-300">Cancel</a>
                        <button type="submit"
                            class="rounded-sm bg-primary px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-primary/80 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Create
                            Post</button>
                    </div>
            </form>

        </div>
    </div>

@section('script')
    <script src="/js/checkSlug.js"></script>
    <script src="/js/previewImage.js"></script>
@endsection

<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    });
</script>
@endsection
