@props([
    'disabled' => false,
    'hasError' => false,
    'class' => '',
])

<div class="{{ $class ?? '' }} relative">
    <input @disabled($disabled)
        {{ $attributes->class([
                'block w-full rounded-xs px-3 py-1.5 text-base',
                'bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100',
                'placeholder:text-gray-400 dark:placeholder:text-gray-500',
                'outline-1 -outline-offset-1 pr-10',
                'transition duration-150 ease-in-out',
                $hasError
                    ? 'outline-red-500 focus:outline-red-500'
                    : 'outline-gray-300 dark:outline-gray-600 focus:outline-2 focus:-outline-offset-2 focus:outline-primary',
            ])->merge() }} />

    @if ($hasError)
        <div class="pointer-events-none absolute inset-y-0 bottom-0 right-0 flex items-center pr-3">
            <x-heroicon-o-exclamation-triangle class="size-5 text-red-500 dark:text-red-400" />
        </div>
    @endif
</div>
