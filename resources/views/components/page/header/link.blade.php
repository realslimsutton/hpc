@props([
    'to' => '#'
])

<li>
    <a {{ $attributes->merge(['href' => $to])->class('flex lg:inline-flex items-center justify-center text-white uppercase font-semibold transition-colors w-full p-4 lg:p-0 lg:w-auto hover:text-hpc-gold') }}>
        {{ $slot }}
    </a>
</li>
