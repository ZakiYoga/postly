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

    // Debug the image URL
    $imageUrl = null;
    if ($image) {
        // Check if it's an external URL (Unsplash, etc.)
    if (filter_var($image, FILTER_VALIDATE_URL)) {
        $imageUrl = $image;
    } elseif (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://', '//'])) {
        $imageUrl = $image;
    } else {
        // Local storage file
        $imageUrl = asset('storage/' . $image);
        }
    }
@endphp

@if ($imageUrl)
    <div
        {{ $attributes->merge([
            'class' => "rounded-xs {$sizeClasses[$size]} overflow-hidden",
        ]) }}>
        <img src="{{ $imageUrl }}" alt="{{ $title }}"
            class="h-full w-full object-cover object-center transition-all duration-300 group-hover:scale-110"
            onerror="this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-full bg-gray-100 border-2 border-dashed border-gray-300\'><div class=\'text-center\'><svg class=\'{{ $iconSizes[$size] }} mx-auto mb-2 text-gray-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg><p class=\'{{ $textSizes[$size] }} font-medium text-gray-500\'>Failed to load image</p></div></div>'">
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

{{-- Debug information (remove in production) --}}
{{-- 
@if (config('app.debug'))
    <div class="mt-2 text-xs text-gray-500">
        <strong>Debug:</strong> {{ $imageUrl ?? 'No image URL' }}
    </div>
@endif --}}
