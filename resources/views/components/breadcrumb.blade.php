@props(['items' => []])

<div
    class="flex items-center justify-start bg-white dark:bg-background-foreground rounded-sm shadow px-4 py-2 md:px-6 md:py-4 mb-4">
    <span class="inline-flex items-center gap-1 text-gray-500">
        @foreach ($items as $index => $item)
            @if (!$loop->first)
                <x-ri-arrow-right-double-fill class="w-4 h-4 pb-1" />
            @endif

            @if (isset($item['url']))
                <a href="{{ $item['url'] }}" class="hover:text-primary focus:text-primary">
                    {{ $item['label'] }}
                </a>
            @else
                <span class="text-gray-500">{{ $item['label'] }}</span>
            @endif
        @endforeach
    </span>
</div>
