@props([
'barClass' => '',
'textClass' => '',
'class' => '',
'size' => '2xl',
])

@php
$sizeClass = 'text-' . $size;
@endphp

<div {{ $attributes->merge([
        'class' => 'flex flex-col gap-y-1 w-fit',
    ])->class([$class]) }}>
    <span {{ $attributes->merge([
                'class' => 'bg-primary w-[20%] h-1',
            ])->class([$barClass]) }}></span>

    <h3 {{ $attributes->merge([
                'class' => "$sizeClass font-semibold text-gray-800 font-bebas-neue tracking-wider text-gray-800 dark:text-gray-200",
            ])->class([$textClass]) }}>
        {{ $slot }}
    </h3>
</div>
