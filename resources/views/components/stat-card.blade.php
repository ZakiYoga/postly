@props(['value', 'label', 'color' => null, 'bgColor' => null, 'iconColor' => null, 'icon' => 'heroicon-o-eye'])

@php
    $bgClass =
        $bgColor ??
        match ($color) {
            'yellow' => 'bg-yellow-100',
            'indigo' => 'bg-indigo-100',
            'orange' => 'bg-orange-100',
            'pink' => 'bg-pink-100',
            'green' => 'bg-green-100',
            'red' => 'bg-red-100',
            'blue' => 'bg-blue-100',
            default => 'bg-gray-100',
        };

    $iconClass =
        $iconColor ??
        match ($color) {
            'yellow' => 'bg-yellow-200 text-yellow-600',
            'indigo' => 'bg-indigo-200 text-indigo-600',
            'orange' => 'bg-orange-200 text-orange-600',
            'pink' => 'bg-pink-200 text-pink-600',
            'green' => 'bg-green-200 text-green-600',
            'red' => 'bg-red-200 text-red-600',
            'blue' => 'bg-blue-200 text-blue-600',
            default => 'bg-gray-200 text-gray-600',
        };
@endphp

<div class="{{ $bgClass }} rounded-sm p-4 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <div class="text-3xl font-bold text-gray-800 font-bebas-neue tracking-wide">{{ $value }}</div>
            <div class="text-gray-600 leading-6">{{ $label }}</div>
        </div>
        <div class="{{ $iconClass }} p-2 rounded-full">
            <x-dynamic-component :component="$icon" class="h-6 w-6" />
        </div>
    </div>
</div>
