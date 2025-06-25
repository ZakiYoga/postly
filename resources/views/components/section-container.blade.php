@props([
'title' => '',
'link' => null,
'linkText' => 'View All',
])

<section {{ $attributes->merge(['class' => 'w-full px-4 sm:px-6 md:px-8 lg:px-16 md:py-4 xl:py-6 lg:py-8 bg-white/95 dark:bg-slate-900 md:bg-transparent md:bg-transparent']) }}>
    <div class="flex flex-col gap-4 w-full min-h-[80vh] p-6 lg:p-8 bg-white/95 dark:bg-slate-900 dark:text-gray-200 rounded-md md:shadow-sm">
        <div class="flex w-full justify-between items-center">
            <x-heading>{{ $title }}</x-heading>
            @if ($link)
            <a href="{{ $link }}" class="font-bebas-neue hover:underline-offset-2 hover:underline hover:text-primary tracking-wide">
                {{ $linkText }}
            </a>
            @endif
        </div>
        <div class="mt-2">
            {{ $slot }}
        </div>
    </div>
</section>
