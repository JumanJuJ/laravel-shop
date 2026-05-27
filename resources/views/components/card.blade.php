@props([
    'icon',
    'title',
    'text',
    'color' => 'dark',
])

@php
    $colors = [
        'dark' => 'bg-zinc-950 text-white dark:bg-white dark:text-zinc-950',
        'blue' => 'bg-blue-600 text-white',
        'green' => 'bg-emerald-600 text-white',
    ];

    $iconClasses = $colors[$color] ?? $colors['dark'];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-lg border border-zinc-200 p-6 dark:border-zinc-800']) }}>
    <div class="flex size-11 items-center justify-center rounded-md {{ $iconClasses }}">
        <flux:icon :name="$icon" class="size-5" />
    </div>

    <h3 class="mt-5 text-lg font-semibold tracking-normal">{{ $title }}</h3>

    <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-300">
        {{ $text }}
    </p>
</div>