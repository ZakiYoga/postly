@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center px-4 py-2 text-gray-700 hover:bg-primary/10 hover:text-primary bg-primary/10 text-primary'
            : 'flex items-center px-4 py-2 text-gray-700 hover:bg-primary/10 hover:text-primary';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
