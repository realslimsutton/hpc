@props([
    'tag' => 'button',
    'size' => 'md',
    'inverted' => false
])

@php
    $classes = [
        'inline-flex items-center gap-2 ring ring-transparent font-semibold transition-colors',
        'px-4 py-1 rounded-md' => $size === 'sm',
        'px-4 py-2 rounded-md' => $size === 'md',
        'p-4 rounded-lg' => $size === 'lg',
        'text-gray-900 bg-hpc-gold hover:bg-gray-900 hover:text-hpc-gold hover:ring-hpc-gold' => !$inverted,
        'bg-gray-900 text-hpc-gold hover:bg-hpc-gold hover:text-gray-900 hover:ring-gray-900' => $inverted
    ];
@endphp

@if($tag === 'a')
    <a
        {{ $attributes->class($classes) }}
    >
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->class($classes) }}
    >
        {{ $slot }}
    </button>
@endif
