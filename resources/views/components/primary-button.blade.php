@props([
    'class' => '',
    'size' => 'sm',
])

@php
    $sizeClass = 'text-' . $size;
@endphp

<button
    {{ $attributes->merge([
            'type' => 'submit',
            'class' => "$sizeClass inline-flex items-center rounded-xs font-bebas-neue px-4 py-2 bg-primary dark:bg-gray-200 border dark:border-gray-900 shadow-[3px_3px_0px_#000] dark:shadow-[2px_2px_0px_#111827] active:translate-0.5 active:shadow-none dark:text-gray-800 uppercase tracking-widest hover:bg-primary/80 dark:hover:bg-gray-700 active:bg-primary/80 dark:active:bg-gray-300 focus:outline-none transition ease-in-out duration-150",
        ])->class([$class]) }}>
    {{ $slot }}
</button>
