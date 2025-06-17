@props(['comment', 'post', 'level' => 0])

<div class="flex items-start gap-x-4 {{ $level > 0 ? 'ml-8 mt-4' : '' }}" x-data="commentSystem()">
    {{-- Avatar --}}
    <img class="w-10 h-10 rounded-full flex-shrink-0" src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=6366f1&color=ffffff" alt="avatar-{{ $comment->user->username }}" />

    <div class="flex flex-col items-start gap-y-2 flex-1">
        {{-- Header info --}}
        <div class="inline-flex items-center gap-2 leading-4">
            <p class="font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</p>
            <span class="w-1 h-1 rounded-full bg-gray-400"></span>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
        </div>

        {{-- Comment content --}}
        <div class="text-gray-700 dark:text-gray-200 break-words">{{ $comment->content }}</div>

        {{-- Actions --}}
        <div class="inline-flex items-center text-sm gap-x-4 text-gray-500 dark:text-gray-400">
            @auth
            <button @click="toggleReplyForm({{ $comment->id }})" class="inline-flex items-center hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                <x-eva-corner-down-right class="w-4 h-4 mr-1" />
                Reply
            </button>
            @endauth

            @if ($comment->replies->count() > 0)
            <button @click="toggleReplies({{ $comment->id }})" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors" x-text="getRepliesButtonText({{ $comment->id }}, {{ $comment->replies->count() }})">
            </button>
            @endif

            {{-- Delete button untuk owner atau admin --}}
            @if (Auth::check() && (Auth::id() === $comment->user_id || Auth::user()->is_admin ?? false))
            <form method="POST" action="{{ route('post.comments.destroy', $comment) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" @click="return confirmDelete()" class="text-red-500 hover:text-red-700 transition-colors">
                    Delete
                </button>
            </form>
            @endif
        </div>

        {{-- Reply form --}}
        @auth
        <div x-show="isReplyFormVisible({{ $comment->id }})" x-transition class="w-full mt-2">
            <form action="{{ route('post.comments.store', $post->slug) }}" method="POST" class="flex flex-col gap-y-2" @submit="submitComment">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <x-text-area id="content" name="content" class="w-full" type="text" message="content" placeholder="Write a reply..." :value="old('content')" required />
                <div class="flex gap-2 justify-between">
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    <div class="ml-auto space-x-1">
                        <button type="button" @click="toggleReplyForm({{ $comment->id }})" class=" text-sm px-3 py-1.5 inline-flex items-center rounded-xs font-bebas-neue bg-transparent dark:bg-gray-200 dark:hover:text-gray-200 border dark:border-gray-900 shadow-[3px_3px_0px_#000] dark:shadow-[2px_2px_0px_#111827] active:translate-0.5 active:shadow-none dark:text-gray-800 uppercase tracking-widest hover:bg-gray-100 dark:hover:bg-gray-700 active:bg-gray-100 dark:active:bg-gray-300 focus:outline-none transition ease-in-out duration-150">
                            Cancel
                        </button>
                        <x-primary-button class="!px-3 !py-1.5 ">Reply</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
        @endauth

        {{-- Replies --}}
        @if ($comment->replies->count() > 0)
        <div x-show="areRepliesVisible({{ $comment->id }})" x-transition class="w-full">
            @foreach ($comment->replies as $reply)
            <x-comment :comment="$reply" :post="$post" :level="$level + 1" />
            @endforeach
        </div>
        @endif
    </div>
</div>
