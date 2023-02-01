@props([
    'title'
])

<div {{ $attributes->class(['bg-hpc-red-700 border border-hpc-red-800 text-white font-lg font-medium p-4']) }}>
    <h3 class="text-xl font-semibold">
        {{ $title }}
    </h3>

    <p class="text-hpc-gold flex items-center gap-1">
        {{ $slot }}
    </p>
</div>
