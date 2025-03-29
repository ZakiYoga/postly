@props([
    'active' => false,
    'class' => '',
])

<a @click="isOpen = false"
    {{ $attributes->merge([
        'class' => implode(' ', [
            $active ? 'text-primary' : 'text-gray-900 dark:text-white',
            'font-semibold',
            'p-1.5',
            'px-3',
            'hover:text-primary',
            'border-primary',
            'hover:border-b',
            'flex',
            'items-center',
            'gap-4',
            'font-bebas-neue',
            'tracking-widest',
            $class,
        ]),
    ]) }}>
    @isset($leftIcon)
        <div class="text-gray-400 mr-2">
            {{ $leftIcon }}
        </div>
    @endisset

    {{ $slot }}

    @isset($rightIcon)
        <div class="text-gray-400 ml-2">
            {{ $rightIcon }}
        </div>
    @endisset
</a>
