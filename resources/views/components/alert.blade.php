@props([
    'type' => 'info',
    'message' => '',
])

@php
    $colors = [
        'success' =>
            'bg-green-100 text-green-800 border-green-200 dark:bg-green-800/20 dark:text-green-400 dark:border-green-600',
        'error' => 'bg-red-100 text-red-800 border-red-200 dark:bg-red-800/20 dark:text-red-400 dark:border-red-600',
        'warning' =>
            'bg-yellow-100 text-yellow-800 border-yellow-200 dark:bg-yellow-800/20 dark:text-yellow-400 dark:border-yellow-600',
        'info' =>
            'bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-800/20 dark:text-blue-400 dark:border-blue-600',
    ];

    $icons = [
        'success' => 'check-circle',
        'error' => 'x-circle',
        'warning' => 'exclamation-triangle',
        'info' => 'information-circle',
    ];
@endphp

@if ($message)
    <div class="flex items-start gap-3 rounded-md border px-4 py-3 text-sm {{ $colors[$type] }}">
        <x-heroicon-o-{{ $icons[$type] }} class="mt-0.5 h-5 w-5 shrink-0" />
        <div class="flex-1">
            {{ $message }}
        </div>
    </div>
@endif
