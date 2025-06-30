<x-layout>
    <x-slot:title>{{ $post->title }}</x-slot:title>
    <x-headingPost title="Blog" :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Posts', 'url' => '/posts']]" />
    <section
        class="mx-auto mb-4 flex h-fit w-full justify-between gap-4 bg-white px-4 py-6 shadow-sm lg:gap-6 lg:px-8 lg:py-12 dark:bg-gray-900">
        <div class="flex w-full flex-col gap-y-8">
            <article
                class="mx-auto flex w-full max-w-lg flex-col border-b border-gray-200 px-4 py-2 md:h-[calc(100vh-6rem)] lg:max-w-xl lg:px-8 dark:border-gray-700">
                @if ($post->cover_image || $post->unsplash_image_url)
                    <div class="mb-2 h-64 w-full overflow-hidden rounded lg:h-96">
                        @if ($post->cover_image)
                            <img src="{{ asset('storage/' . $post->cover_image) }}"
                                alt="Cover image for {{ $post->title }}"
                                class="h-full w-full object-cover object-center" />
                        @else
                            <img src="{{ $post->unsplash_image_url }}"
                                alt="Unsplash image for {{ optional($post->category)->name ?? 'kategori' }}"
                                class="h-full w-full object-cover object-center" />
                        @endif
                    </div>
                @endif
                <header class="mb-2">
                    <h1 class="text-3xl font-extrabold leading-tight text-gray-900 lg:text-4xl dark:text-white">
                        {{ $post->title }}
                    </h1>
                    <p class="inline-flex items-center text-sm text-gray-500 dark:text-gray-700">
                        By&nbsp;
                        <a href="/posts?author={{ $post->author->username }}"
                            class="hover:text-primary text-gray-600 hover:underline">
                            {{ $post->author->name }}
                        </a>
                        &nbsp;in&nbsp;
                        <a href="/posts?category={{ $post->category->slug }}"
                            class="hover:text-primary text-gray-600 hover:underline">
                            {{ $post->category->name }},&nbsp;
                        </a>
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </header>
                <p>
                    {{ $post->body }}
                </p>

                <div class="not-format mt-auto inline-flex items-center gap-2 py-4">
                    <h5 class="border-primary font-bebas-neue mr-2 border-l-4 pl-2 leading-6 tracking-wider">
                        SHARE
                    </h5>

                    {{-- Facebook --}}
                    <a href="#"
                        class="grid place-content-center transition-all duration-150 hover:-translate-y-0.5 hover:cursor-pointer">
                        <x-fab-facebook-f class="h-6 w-6" />
                    </a>

                    {{-- Instagram --}}
                    <a href="#"
                        class="grid place-content-center transition-all duration-150 hover:-translate-y-0.5 hover:cursor-pointer">
                        <x-fab-instagram class="h-6 w-6" />
                    </a>

                    {{-- X --}}
                    <a href="#"
                        class="grid place-content-center transition-all duration-150 hover:-translate-y-0.5 hover:cursor-pointer">
                        <x-fab-x-twitter class="h-6 w-6" />
                    </a>

                    {{-- Linkedin --}}
                    <a href="#"
                        class="grid place-content-center transition-all duration-150 hover:-translate-y-0.5 hover:cursor-pointer">
                        <x-fab-linkedin class="h-6 w-6" />
                    </a>
                </div>
            </article>

            {{-- Comments Section --}}
            <div class="border-b border-gray-200 px-4 py-4 lg:px-8 dark:border-gray-700">
                <x-heading size="2xl">Comments ({{ $comments->count() }})</x-heading>

                @if (session('success'))
                    <x-alert type="success" title="Sukses!" :duration="3000">
                        {{ session('success') }}
                    </x-alert>
                @endif

                @if (session('error'))
                    <x-alert type="error" title="Oops!" :duration="3000">
                        {{ session('error') }}
                    </x-alert>
                @endif

                {{-- Comments List --}}
                <div class="mt-6 space-y-6">
                    @forelse($comments as $comment)
                        <x-comment :comment="$comment" :post="$post" />
                    @empty
                        <div class="py-8 text-center">
                            <p class="text-gray-500 dark:text-gray-400">No comments yet. Be the first to comment!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Comment Form Section --}}
            <div class="space-y-2 px-4 py-4 lg:px-8">
                @auth
                    <h4 class="font-bebas-neue text-lg tracking-wider">Post a comment</h4>
                    <form action="{{ route('post.comments.store', $post->slug) }}" method="POST"
                        class="flex w-full flex-col gap-y-2">
                        @csrf
                        <div>
                            <label for="content" class="sr-only">Comment</label>
                            <textarea id="content" name="content" rows="4"
                                class="focus:border-primary-500 focus:ring-primary-500 @error('content') border-red-500 @enderror w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                placeholder="Write your comment here..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            @enderror
                        </div>
                        <x-primary-button type="submit" class="w-fit">
                            Post Comment
                        </x-primary-button>
                    </form>
                @else
                    <div class="rounded-lg bg-gray-50 py-8 text-center dark:bg-gray-800">
                        <p class="mb-4 text-gray-500 dark:text-gray-400">
                            Please sign in to post a comment.
                        </p>
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center rounded-lg px-6 py-2 font-medium transition-colors dark:text-white">
                            Sign In
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="flex flex-col gap-y-6">
            {{-- Search --}}
            <div class="rounded-xs w-full border border-gray-200 lg:w-72 dark:border-gray-700">
                <form class="mr-auto flex w-full items-center" action="/posts" method="GET">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <div class="relative w-full">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center p-2">
                            <x-elemplus-search class="h-5 w-5 pb-0.5 dark:text-gray-600" />
                        </div>
                        <label for="search" class="sr-only">Search</label>
                        <input type="search" id="search" name="search"
                            class="font-bebas-neue focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full border-transparent bg-transparent p-2 pr-9 pt-2.5 text-sm text-gray-900 focus:ring-gray-500 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                            placeholder="search article" autocomplete="off" />
                    </div>
                </form>
            </div>

            {{-- categories --}}
            <div class="bg-background dark:bg-background-foreground flex flex-col gap-y-4 p-4">
                <x-heading size="xl">Categories</x-heading>
                <ul class="space-y-4">
                    @foreach ($categories as $index => $category)
                        @if ($index < 5)
                            <li
                                class="group relative inline-flex w-full gap-x-0.5 border-b border-gray-200 pb-1 dark:border-gray-700">
                                <x-eva-corner-down-right
                                    class="absolute left-0 hidden h-4 w-4 opacity-0 transition-all duration-300 group-hover:block group-hover:opacity-100" />
                                <a href="/posts?category={{ $category->slug }}"
                                    class="hover:text-primary w-full text-gray-800 transition-all duration-300 group-hover:pl-4 dark:text-gray-200">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- popularpost --}}
            <div class="flex flex-col gap-y-4 p-4">
                <x-heading size="xl">
                    Popular Posts
                </x-heading>
                <div class="space-y-4">
                    @foreach ($trending->take(6) as $post)
                        <div class="group flex items-start gap-4">
                            <div class="relative grid h-20 max-w-32 place-content-center overflow-hidden">
                                <x-cover-image :image="$post['unsplash_image_url']" :title="$post['title']" size="large" />
                                <div
                                    class="font-bebas-neue absolute bottom-2 right-2 inline-flex gap-1 bg-gray-900/80 p-1 tracking-wider text-white">
                                    <x-eva-eye class="h-4 w-4" />
                                    <p class="text-sm">{{ $post->view_count }}</p>
                                </div>
                            </div>
                            <div class="flex h-full flex-col gap-y-2">
                                <div class="flex items-center gap-2 text-gray-400 dark:text-gray-200">
                                    <p class="text-sm">{{ $post->category->name }}</p>
                                    <div class="h-0.5 w-0.5 bg-gray-400 dark:text-gray-200"></div>
                                    <p class="text-sm">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                                <a href="/post/{{ $post->slug }}"
                                    class="text-sm font-semibold leading-6">{{ $post['title'] }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- FOLLOW US --}}
                <div class="space-y-4 p-4">
                    <x-heading size="xl">Follow us</x-heading>
                    <div class="inline-flex items-center gap-x-2.5">

                        {{-- Facebook --}}
                        <a href="#"
                            class="grid place-content-center rounded-sm bg-blue-700 p-1 transition-all duration-150 hover:-translate-y-0.5 hover:cursor-pointer">
                            <x-fab-facebook-f class="h-6 w-6 text-white" />
                        </a>


                        {{-- Instagram --}}
                        <a href="#"
                            class="grid place-content-center rounded-sm bg-gradient-to-tr from-pink-500 via-red-500 to-yellow-500 p-1 transition-all duration-150 hover:-translate-y-0.5 hover:cursor-pointer">
                            <x-fab-instagram class="h-6 w-6 text-white" />
                        </a>

                        {{-- X --}}
                        <a href="#"
                            class="grid place-content-center rounded-sm bg-gray-950 p-1 transition-all duration-150 hover:-translate-y-0.5 hover:cursor-pointer">
                            <x-fab-x-twitter class="h-6 w-6 text-white" />
                        </a>

                        {{-- Youtube --}}
                        <a href="#"
                            class="grid place-content-center rounded-sm bg-red-600 p-1 transition-all duration-150 hover:-translate-y-0.5 hover:cursor-pointer">
                            <x-fab-youtube class="h-6 w-6 text-white" />
                        </a>
                    </div>
                </div>
            </div>
    </section>

    @push('script')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('commentSystem', () => ({
                    // State untuk form reply
                    replyForms: {},
                    repliesVisibility: {},

                    // Toggle reply form
                    toggleReplyForm(commentId) {
                        this.replyForms[commentId] = !this.replyForms[commentId];

                        // Focus pada textarea jika form ditampilkan
                        if (this.replyForms[commentId]) {
                            this.$nextTick(() => {
                                const textarea = document.querySelector(
                                    `#reply-form-${commentId} textarea`);
                                if (textarea) textarea.focus();
                            });
                        }
                    },

                    // Toggle replies visibility
                    toggleReplies(commentId) {
                        this.repliesVisibility[commentId] = !this.repliesVisibility[commentId];
                    },

                    // Check if reply form is visible
                    isReplyFormVisible(commentId) {
                        return this.replyForms[commentId] || false;
                    },

                    // Check if replies are visible
                    areRepliesVisible(commentId) {
                        return this.repliesVisibility[commentId] || false;
                    },

                    // Get replies button text
                    getRepliesButtonText(commentId, count) {
                        const isVisible = this.areRepliesVisible(commentId);
                        const action = isVisible ? 'Hide' : 'Show';
                        const plural = count === 1 ? 'reply' : 'replies';
                        return `${action} ${count} ${plural}`;
                    },

                    // Submit form dengan loading state
                    async submitComment(event) {
                        const form = event.target;
                        const submitButton = form.querySelector('button[type="submit"]');
                        const originalText = submitButton.textContent;

                        // Set loading state
                        submitButton.disabled = true;
                        submitButton.textContent = 'Posting...';

                        try {
                            // Form akan di-submit secara normal oleh browser
                            return true;
                        } catch (error) {
                            // Reset state jika ada error
                            submitButton.disabled = false;
                            submitButton.textContent = originalText;
                            console.error('Error submitting comment:', error);
                            return false;
                        }
                    },

                    // Konfirmasi delete
                    confirmDelete() {
                        return confirm('Are you sure you want to delete this comment?');
                    }
                }));
            });
        </script>
    @endpush
</x-layout>
