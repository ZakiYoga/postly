<div x-data="likeButton('{{ $post->slug }}', {{ $post->isLikedByUser(auth()->user()) ? 'true' : 'false' }}, {{ $post->likes_count }})" class="flex items-center">
    <button @click="toggleLike()" :disabled="loading" class="flex items-center space-x-1 rounded p-1 transition-colors disabled:opacity-50">

        {{-- Heart Icon --}}
        <div :class="isLiked ? 'text-red-500' :
            'text-gray-400 hover:text-red-500 group-hover:text-white transition-color duration-300'" class="transition-colors">
            <template x-if="isLiked">
                <x-eva-heart class="h-5 w-5" />
            </template>
            <template x-if="!isLiked">
                <x-eva-heart class="h-5 w-5" />
            </template>
        </div>

        {{-- Count --}}
        <span x-text="likesCount" :class="isLiked ? 'text-red-500 font-medium' : 'group-hover:text-white text-gray-600 transition-color duration-300'">
        </span>

        {{-- Loading spinner --}}
        <div x-show="loading" class="h-4 w-4 animate-spin rounded-full border-2 border-gray-300 border-t-blue-600">
        </div>
    </button>
</div>

@php
$loginUrl = route('login');
@endphp

<script>
    function likeButton(postSlug, initialIsLiked, initialLikesCount) {
        return {
            postSlug: postSlug
            , isLiked: initialIsLiked
            , likesCount: initialLikesCount
            , loading: false,

            async toggleLike() {
                if (this.loading) return;

                @guest
                alert('Silakan login terlebih dahulu untuk memberikan like');
                window.location.href = "{{ $loginUrl }}";
                return;
                @endguest

                this.loading = true;

                try {
                    const response = await fetch(`/posts/${this.postSlug}/like`, {
                        method: 'POST'
                        , headers: {
                            'Content-Type': 'application/json'
                            , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            , 'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        this.isLiked = data.liked;
                        this.likesCount = data.likesCount;
                    } else {
                        console.error(data.message);
                    }
                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                } finally {
                    this.loading = false;
                }
            }
        }
    }

</script>
