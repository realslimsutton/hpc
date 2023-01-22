@props([
    'to' => '#',
    'routes' => []
])

<li>
    <a {{ $attributes->merge(['href' => $to])->class([
        'flex lg:inline-flex items-center justify-center text-white uppercase font-semibold transition-colors w-full p-4 lg:p-0 lg:w-auto hover:text-hpc-gold focus:text-hpc-gold',
        '!text-hpc-gold' => in_array(Route::currentRouteName(), $routes)
    ]) }}>
        {{ $slot }}
    </a>
</li>
