@props(['value', 'label', 'color' => null, 'bgColor' => null, 'iconColor' => null, 'icon' => 'heroicon-o-eye'])

@php
$bgClass =
$bgColor ??
match ($color) {
'yellow' => 'bg-yellow-100 dark:bg-yellow-100/90',
'indigo' => 'bg-indigo-100 dark:bg-indigo-100/90',
'orange' => 'bg-orange-100 dark:bg-orange-100/90',
'pink' => 'bg-pink-100 dark:bg-pink-100/90',
'green' => 'bg-green-100 dark:bg-green-100/90',
'red' => 'bg-red-100 dark:bg-red-100/90',
'blue' => 'bg-blue-100 dark:bg-blue-100/90',
default => 'bg-gray-100 dark:bg-gray-100/90',
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

<div class="{{ $bgClass }} rounded-sm p-4 shadow-sm group hover:-translate-y-1 hover:cursor-pointer transition-all duration-200">
    <div class="flex items-center justify-between">
        <div>
            <div class="text-3xl font-bold text-gray-800 font-bebas-neue tracking-wide">{{ $value }}</div>
            <div class="text-gray-500 leading-6">{{ $label }}</div>
        </div>
        <div class="{{ $iconClass }} p-2 rounded-full shadow-md">
            <x-dynamic-component :component="$icon" class="h-6 w-6" />
        </div>
    </div>
</div>
