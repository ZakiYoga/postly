<!-- resources/views/components/alert.blade.php -->
@props([
    'type' => 'info',
    'dismissable' => true,
    'show' => true,
    'title' => null,
    'icon' => null,
])

@php
    $alertStyles = [
        'success' => [
            'bg' => 'bg-green-50',
            'border' => 'border-green-400',
            'text' => 'text-green-800',
            'icon' => $icon ?? 'check-circle',
            'iconColor' => 'text-green-500',
            'buttonColor' => 'text-green-500',
        ],
        'error' => [
            'bg' => 'bg-red-50',
            'border' => 'border-red-400',
            'text' => 'text-red-800',
            'icon' => $icon ?? 'x-circle',
            'iconColor' => 'text-red-500',
            'buttonColor' => 'text-red-500',
        ],
        'warning' => [
            'bg' => 'bg-yellow-50',
            'border' => 'border-yellow-400',
            'text' => 'text-yellow-800',
            'icon' => $icon ?? 'exclamation',
            'iconColor' => 'text-yellow-500',
            'buttonColor' => 'text-yellow-500',
        ],
        'info' => [
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-400',
            'text' => 'text-blue-800',
            'icon' => $icon ?? 'information-circle',
            'iconColor' => 'text-blue-500',
            'buttonColor' => 'text-blue-500',
        ],
    ];

    // Pastikan tipe alert valid
    $type = array_key_exists($type, $alertStyles) ? $type : 'info';
    $style = $alertStyles[$type];
@endphp

<div x-data="{ open: {{ $show ? 'true' : 'false' }} }" x-show="open" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
    class="rounded-lg border p-4 mb-4 flex {{ $style['bg'] }} {{ $style['border'] }} {{ $style['text'] }}"
    role="alert">
    <div class="flex-shrink-0">
        @if ($style['icon'] === 'check-circle')
            <x-heroicon-o-check-circle class="w-5 h-5 {{ $style['iconColor'] }}" />
        @elseif($style['icon'] === 'x-circle')
            <x-heroicon-o-x-circle class="w-5 h-5 {{ $style['iconColor'] }}" />
        @elseif($style['icon'] === 'exclamation')
            <x-heroicon-o-exclamation-circle class="w-5 h-5 {{ $style['iconColor'] }}" />
        @elseif($style['icon'] === 'information-circle')
            <x-heroicon-o-information-circle class="w-5 h-5 {{ $style['iconColor'] }}" />
        @endif
    </div>

    <div class="ml-3 flex-grow">
        @if ($title)
            <h3 class="text-sm font-medium font-bebas-neue tracking-wider">{{ $title }}</h3>
        @endif
        <div class="text-sm mt-1">
            {{ $slot }}
        </div>
    </div>

    @if ($dismissable)
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button type="button" @click="open = false"
                    class="inline-flex rounded-md p-1.5 {{ $style['buttonColor'] }} hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ explode('-', $style['buttonColor'])[1] }}-500"
                    aria-label="Dismiss">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
</div>
