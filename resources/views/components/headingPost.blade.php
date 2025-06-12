@props(['title', 'items' => []])

<div
    class="flex items-center justify-between w-full p-6 lg:py-8 sm:px-8 md:px-10 lg:px-16 dark:bg-gray-900 dark:border-gray-700">
    <h2 class="mb-2 text-2xl font-bebas-neue tracking-wider lg:text-4xl font-semibold text-gray-900 dark:text-white">
        {{ $title }}
    </h2>
    <div class="inline-flex items-center text-gray-600 dark:text-gray-400 first-letter:uppercase">
        @foreach ($items as $index => $item)
            @if (!$loop->first)
                <x-heroicon-c-slash class="w-5 h-5 pb-1" />
            @endif

            @if (isset($item['url']))
                <a href="{{ $item['url'] }}" class="hover:text-primary focus:text-primary">
                    {{ $item['label'] }}
                </a>
            @else
                <span">{{ $item['label'] }}</span>
            @endif
        @endforeach
    </div>
</div>
