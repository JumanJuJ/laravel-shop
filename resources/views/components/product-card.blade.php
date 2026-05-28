@props([
    'name',
    'summary',
    'image',
])

<div class="rounded-lg border border-zinc-200 p-4 dark:border-zinc-800">
    <img src="{{ asset($image) }}" alt="{{ $name }}" class="h-48 w-full object-cover rounded-md" />

    <h3 class="mt-4 text-lg font-semibold tracking-normal">{{ $name }}</h3>

    <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-300">
        {{ $summary }}
    </p>