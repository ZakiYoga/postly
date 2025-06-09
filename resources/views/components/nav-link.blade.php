@props(['active' => false])

@php
    $base = 'relative inline-flex items-center tracking-wider p-2 font-bebas-neue font-medium leading-6 transition duration-300 ease-in-out 
            after:absolute after:bottom-0 after:left-1/2 after:w-0 after:h-[2px] after:bg-gray-300 dark:after:bg-dark-700 after:transition-all after:duration-300 after:ease-in-out after:-translate-x-1/2 ';

    $classes = $active
        ? $base . ' text-primary border-b-2 border-primary dark:text-primary dark:border-primary'
        : $base .
            ' text-gray-500 dark:text-gray-400 border-transparent hover:after:left-0 hover:after:w-full hover:after:translate-x-0
                  hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
