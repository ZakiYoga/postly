@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center tracking-wider p-2 border-b-2 border-primary font-bebas-neue dark:border-primary font-medium leading-6 text-primary focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center tracking-wider p-2 border-b-2 border-transparent font-bebas-neue font-medium leading-6 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:bg-gray-900 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
