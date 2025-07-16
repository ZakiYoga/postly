<!-- resources/views/components/alert.blade.php -->
@props([
    'type' => 'info',
    'dismissable' => true,
    'show' => true,
    'title' => null,
    'icon' => null,
    'duration' => null,
    'position' => 'top', // top, bottom, top-left, bottom-left
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

    // Posisi alert
    $positionStyles = [
        'top' => 'fixed top-4 left-1/2 transform -translate-x-1/2 z-50',
        'bottom' => 'fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50',
        'top-left' => 'fixed top-4 left-4 z-50',
        'bottom-left' => 'fixed bottom-4 left-4 z-50',
    ];

    // Pastikan tipe alert valid
    $type = array_key_exists($type, $alertStyles) ? $type : 'info';
    $style = $alertStyles[$type];

    // Pastikan posisi valid
    $position = array_key_exists($position, $positionStyles) ? $position : 'top';
    $positionClass = $positionStyles[$position];
@endphp

<div x-data="{
    open: {{ $show ? 'true' : 'false' }},
    init() {
        @if ($duration) setTimeout(() => this.open = false, {{ $duration }}); @endif
    }
}" x-init="init()" x-show="open" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
    class="{{ $style['bg'] }} {{ $style['border'] }} {{ $style['text'] }} {{ $positionClass }} flex w-full max-w-sm rounded-lg border p-4 shadow-lg sm:max-w-md"
    role="alert">
    <div class="flex-shrink-0">
        @if ($style['icon'] === 'check-circle')
            <x-heroicon-o-check-circle class="{{ $style['iconColor'] }} h-5 w-5" />
        @elseif($style['icon'] === 'x-circle')
            <x-heroicon-o-x-circle class="{{ $style['iconColor'] }} h-5 w-5" />
        @elseif($style['icon'] === 'exclamation')
            <x-heroicon-o-exclamation-circle class="{{ $style['iconColor'] }} h-5 w-5" />
        @elseif($style['icon'] === 'information-circle')
            <x-heroicon-o-information-circle class="{{ $style['iconColor'] }} h-5 w-5" />
        @endif
    </div>

    <div class="ml-3 flex-grow">
        @if ($title)
            <h3 class="font-bebas-neue text-sm font-medium tracking-wider">{{ $title }}</h3>
        @endif
        <div class="mt-1 text-sm">
            {{ $slot }}
        </div>
    </div>

    @if ($dismissable)
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button type="button" @click="open = false"
                    class="{{ $style['buttonColor'] }} focus:ring-{{ explode('-', $style['buttonColor'])[1] }}-500 inline-flex rounded-md p-1.5 hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2"
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
