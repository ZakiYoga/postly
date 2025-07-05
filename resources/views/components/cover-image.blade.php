@props([
    'image' => null,
    'title' => '',
    'size' => 'default', // default, small, large
    'placeholder' => 'No preview yet',
])

@php
    $sizeClasses = [
        'small' => 'h-32 w-full sm:h-20 sm:w-32',
        'default' => 'h-full min-h-36 w-full',
        'large' => 'h-64 w-full sm:h-36 sm:w-56',
    ];

    $iconSizes = [
        'small' => 'h-8 w-8',
        'default' => 'h-12 w-12',
        'large' => 'h-16 w-16',
    ];

    $textSizes = [
        'small' => 'text-xs',
        'default' => 'text-xs',
        'large' => 'text-sm',
    ];
@endphp

@if ($image)
    <div
        {{ $attributes->merge([
            'class' => "rounded-xs {$sizeClasses[$size]} overflow-hidden",
        ]) }}>
        <img src="{{ $image }}" alt="{{ $title }}"
            class="aspect-square h-full w-full object-cover object-center transition-all duration-300 group-hover:scale-110">
    </div>
@else
    <div
        {{ $attributes->merge([
            'class' => "rounded-xs {$sizeClasses[$size]} flex items-center justify-center overflow-hidden border-2 border-dashed border-gray-300 bg-gray-100",
        ]) }}>
        <div class="text-center">
            <x-heroicon-o-photo class="{{ $iconSizes[$size] }} mx-auto mb-2 text-gray-400" />
            <p class="{{ $textSizes[$size] }} font-medium text-gray-500">{{ $placeholder }}</p>
        </div>
    </div>
@endif
