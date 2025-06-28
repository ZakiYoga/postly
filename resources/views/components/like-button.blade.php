@props([
    'post',
    'containerClass' => 'flex items-center',
    'buttonClass' => 'flex items-center space-x-1 p-1 rounded transition-colors disabled:opacity-50',
    'iconSize' => 'w-5 h-5',
    'likedColor' => 'text-red-500',
    'unlikedColor' => 'text-gray-400',
    'hoverColor' => 'hover:text-red-500',
    'countLikedClass' => 'text-red-500 font-medium',
    'countUnlikedClass' => 'text-gray-600',
    'loadingClass' => 'w-4 h-4 border-2 border-gray-300 border-t-blue-600 rounded-full animate-spin',
])

<div x-data="likeButton('{{ $post->slug }}', {{ $post->isLikedByUser(auth()->user()) ? 'true' : 'false' }}, {{ $post->likes_count }})" class="{{ $containerClass }}">

    <button @click="toggleLike()" :disabled="loading" {{ $attributes->merge(['class' => $buttonClass]) }}>

        {{-- Heart Icon --}}
        <div :class="isLiked ? '{{ $likedColor }}' : '{{ $unlikedColor }} {{ $hoverColor }} transition-color duration-300'"
            class="transition-colors">
            <template x-if="isLiked">
                <x-eva-heart class="{{ $iconSize }}" />
            </template>
            <template x-if="!isLiked">
                <x-eva-heart class="{{ $iconSize }}" />
            </template>
        </div>

        {{-- Count --}}
        <span x-text="likesCount"
            :class="isLiked ? '{{ $countLikedClass }}' : '{{ $countUnlikedClass }} transition-color duration-300'">
        </span>

        {{-- Loading spinner --}}
        <div x-show="loading" class="{{ $loadingClass }}">
        </div>
    </button>
</div>

@once
    <script>
        function likeButton(postSlug, initialIsLiked, initialLikesCount) {
            return {
                postSlug: postSlug,
                isLiked: initialIsLiked,
                likesCount: initialLikesCount,
                loading: false,

                async toggleLike() {
                    if (this.loading) return;

                    @guest
                    alert('Silakan login terlebih dahulu untuk memberikan like');
                    window.location.href = '{{ route('login') }}';
                    return;
                @endguest

                this.loading = true;

                try {
                    const response = await fetch(`/posts/${this.postSlug}/like`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();

                    if (data.success) {
                        this.isLiked = data.is_liked;
                        this.likesCount = data.likes_count;
                    } else {
                        alert(data.message || 'Terjadi kesalahan');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses like');
                } finally {
                    this.loading = false;
                }
            }
        }
        }
    </script>
@endonce
