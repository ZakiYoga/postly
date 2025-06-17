@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium lg:text-lg font-bebas-neue text-gray-700 dark:text-gray-300 tracking-wider']) }}>
    {{ $value ?? $slot }}
</label>
