@props(['active' => false])

@php
    $classes =
        'flex px-4 py-2.5 items-center p-2.5 text-gray-700 hover:bg-primary/10 hover:text-primary transition-colors duration-300 ease-in-out';

    if ($active) {
        $classes .= ' bg-primary/10 text-primary';
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
