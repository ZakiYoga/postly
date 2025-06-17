<x-layout>
    <x-slot:title>{{ $post->title }}</x-slot:title>
    <x-headingPost title="Blog" :items="[['label' => 'Home', 'url' => '/'], ['label' => 'Posts', 'url' => '/posts']]" />
    <section class="flex justify-between gap-4 lg:gap-6 w-full h-fit mx-auto mb-4 px-4 py-6 lg:px-8 lg:py-12 shadow-sm bg-white dark:bg-gray-900">
        <div class="flex w-full flex-col gap-y-8">
            <article class="flex flex-col py-2 px-4 lg:px-8 mx-auto w-full md:h-[calc(100vh-6rem)] max-w-lg lg:max-w-xl border-b border-gray-200 dark:border-gray-700">
                @if ($post->cover_image || $post->unsplash_image_url)
                <div class="w-full h-64 lg:h-96 rounded overflow-hidden mb-2">
                    @if ($post->cover_image)
                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Cover image for {{ $post->title }}" class="object-cover object-center w-full h-full" />
                    @else
                    <img src="{{ $post->unsplash_image_url }}" alt="Unsplash image for {{ optional($post->category)->name ?? 'kategori' }}" class="object-cover object-center w-full h-full" />
                    @endif
                </div>
                @endif
                <header class="mb-2">
                    <h1 class="text-3xl font-extrabold leading-tight text-gray-900 lg:text-4xl dark:text-white">
                        {{ $post->title }}
                    </h1>
                    <p class="inline-flex items-center text-sm text-gray-500 dark:text-gray-700">
                        By&nbsp;
                        <a href="/posts?author={{ $post->author->username }}" class="text-gray-600 hover:text-primary hover:underline">
                            {{ $post->author->name }}
                        </a>
                        &nbsp;in&nbsp;
                        <a href="/posts?category={{ $post->category->slug }}" class="text-gray-600 hover:text-primary hover:underline">
                            {{ $post->category->name }},&nbsp;
                        </a>
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </header>
                <p>
                    {{ $post->body }}
                </p>

                <div class="mt-auto py-4 inline-flex items-center gap-2 not-format">
                    <h5 class="pl-2 leading-6 border-l-4 border-primary font-bebas-neue tracking-wider mr-2">
                        SHARE
                    </h5>

                    {{-- Facebook --}}
                    <a href="#" class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150">
                        <x-fab-facebook-f class="w-6 h-6" />
                    </a>

                    {{-- Instagram --}}
                    <a href="#" class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150">
                        <x-fab-instagram class="w-6 h-6" />
                    </a>

                    {{-- X --}}
                    <a href="#" class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150">
                        <x-fab-x-twitter class="w-6 h-6" />
                    </a>

                    {{-- Linkedin --}}
                    <a href="#" class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150">
                        <x-fab-linkedin class="w-6 h-6" />
                    </a>
                </div>
            </article>

            {{-- Comments Section --}}
            <div class="px-4 py-4 lg:px-8 border-b border-gray-200 dark:border-gray-700">
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
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400">No comments yet. Be the first to comment!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Comment Form Section --}}
            <div class="space-y-2 px-4 lg:px-8 py-4">
                @auth
                <h4 class="font-bebas-neue tracking-wider text-lg">Post a comment</h4>
                <form action="{{ route('post.comments.store', $post->slug) }}" method="POST" class="flex flex-col w-full gap-y-2">
                    @csrf
                    <div>
                        <label for="content" class="sr-only">Comment</label>
                        <textarea id="content" name="content" rows="4" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-primary-500 focus:ring-primary-500 @error('content') border-red-500 @enderror" placeholder="Write your comment here..." required>{{ old('content') }}</textarea>
                        @error('content')
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        @enderror
                    </div>
                    <x-primary-button type="submit" class="w-fit">
                        Post Comment
                    </x-primary-button>
                </form>
                @else
                <div class="text-center py-8 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <p class="text-gray-500 dark:text-gray-400 mb-4">
                        Please sign in to post a comment.
                    </p>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-2 dark:text-white font-medium rounded-lg transition-colors">
                        Sign In
                    </a>
                </div>
                @endauth
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="flex flex-col gap-y-6">
            {{-- Search --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-xs w-full lg:w-72">
                <form class="flex items-center mr-auto w-full" action="/posts" method="GET">
                    @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none p-2">
                            <x-elemplus-search class="w-5 h-5 dark:text-gray-600 pb-0.5" />
                        </div>
                        <label for="search" class="sr-only">Search</label>
                        <input type="search" id="search" name="search" class="font-bebas-neue block w-full p-2 pt-2.5 pr-9 text-sm text-gray-900 border-transparent bg-transparent focus:ring-gray-500 focus:border-primary-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="search article" autocomplete="off" />
                    </div>
                </form>
            </div>

            {{-- categories --}}
            <div class="flex flex-col gap-y-4 bg-background dark:bg-background-foreground p-4">
                <x-heading size="xl">Categories</x-heading>
                <ul class="space-y-4">
                    @foreach ($categories as $index => $category)
                    @if ($index < 5) <li class="inline-flex gap-x-0.5 w-full relative border-b border-gray-200 dark:border-gray-700 pb-1 group">
                        <x-eva-corner-down-right class="absolute left-0 opacity-0 hidden transition-all duration-300 group-hover:opacity-100 group-hover:block w-4 h-4" />
                        <a href="/posts?category={{ $category->slug }}" class="w-full group-hover:pl-4 transition-all duration-300 hover:text-primary text-gray-800 dark:text-gray-200">
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
                <div class="inline-flex gap-2">
                    <img src="/images/article-1.png" alt="article" class="object-center object-cover w-14 h-14" />
                    <div class="space-y-1">
                        <h4 class="text-sm leading-4 font-semibold">Lorem ipsum dolor, sit amet consectetur</h4>
                        <div class="flex items-center gap-1 text-gray-400 dark:text-gray-200">
                            <x-heroicon-o-calendar-date-range class="w-5 h-5" />
                            <p class="text-sm">4 days ago</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOLLOW US --}}
            <div class="space-y-4 p-4">
                <x-heading size="xl">Follow us</x-heading>
                <div class="inline-flex items-center gap-x-2.5">

                    {{-- Facebook --}}
                    <a href="#" class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-blue-700">
                        <x-fab-facebook-f class="w-6 h-6 text-white" />
                    </a>


                    {{-- Instagram --}}
                    <a href="#" class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-gradient-to-tr from-pink-500 via-red-500 to-yellow-500">
                        <x-fab-instagram class="w-6 h-6 text-white" />
                    </a>

                    {{-- X --}}
                    <a href="#" class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-gray-950">
                        <x-fab-x-twitter class="w-6 h-6 text-white" />
                    </a>

                    {{-- Youtube --}}
                    <a href="#" class="grid place-content-center hover:cursor-pointer hover:-translate-y-0.5 transition-all duration-150 p-1 rounded-sm bg-red-600">
                        <x-fab-youtube class="w-6 h-6 text-white" />
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
                replyForms: {}
                , repliesVisibility: {},

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
