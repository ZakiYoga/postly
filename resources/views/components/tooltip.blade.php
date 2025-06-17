@props([
'content' => '',
'position' => 'right',
'delay' => '500'
])

<div class="relative inline-block group">
    <div {{ $attributes }}>
        {{ $slot }}
    </div>

    <!-- Tooltip -->
    <div class="absolute z-50 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 ease-in-out pointer-events-none" style="transition-delay: {{ $delay }}ms" @switch($position) @case('right') style="left: calc(100% + 12px); top: 50%; transform: translateY(-50%);" @break @case('left') style="right: calc(100% + 12px); top: 50%; transform: translateY(-50%);" @break @case('top') style="bottom: calc(100% + 12px); left: 50%; transform: translateX(-50%);" @break @case('bottom') style="top: calc(100% + 12px); left: 50%; transform: translateX(-50%);" @break @endswitch>
        <!-- Tooltip Content -->
        <div class="bg-gray-900 dark:bg-gray-800 text-white dark:text-gray-200 text-sm font-medium px-3 py-2 rounded-lg shadow-lg whitespace-nowrap border border-gray-700 dark:border-gray-600">
            {{ $content }}

            <!-- Arrow -->
            @switch($position)
            @case('right')
            <div class="absolute top-1/2 -left-1 transform -translate-y-1/2">
                <div class="w-0 h-0 border-t-4 border-b-4 border-r-4 border-transparent border-r-gray-900 dark:border-r-gray-800"></div>
            </div>
            @break
            @case('left')
            <div class="absolute top-1/2 -right-1 transform -translate-y-1/2">
                <div class="w-0 h-0 border-t-4 border-b-4 border-l-4 border-transparent border-l-gray-900 dark:border-l-gray-800"></div>
            </div>
            @break
            @case('top')
            <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2">
                <div class="w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900 dark:border-t-gray-800"></div>
            </div>
            @break
            @case('bottom')
            <div class="absolute -top-1 left-1/2 transform -translate-x-1/2">
                <div class="w-0 h-0 border-l-4 border-r-4 border-b-4 border-transparent border-b-gray-900 dark:border-b-gray-800"></div>
            </div>
            @break
            @endswitch
        </div>
    </div>
</div>
