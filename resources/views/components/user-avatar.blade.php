@props(['user', 'size' => '', 'class' => '', 'fallback' => true])

@php
    $defaultClasses = 'rounded-xs object-cover';
    $sizeClasses = match ($size) {
        'xs' => 'w-6 h-6',
        'sm' => 'w-8 h-8',
        'md' => 'w-12 h-12',
        'lg' => 'w-16 h-16',
        'xl' => 'w-24 h-24',
        '2xl' => 'w-32 h-32',
        default => $size,
    };
@endphp

@if ($user)
    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}'s avatar"
        {{ $attributes->merge(['class' => "$defaultClasses $sizeClasses $class"]) }} loading="lazy" />
@endif
