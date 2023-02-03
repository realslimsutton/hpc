@props([
    'title',
    'routes' => []
])

<li>
    <a {{ $attributes->class([
        'flex items-center justify-center p-4 font-medium text-center transition-colors hover:bg-hpc-gold hover:text-gray-900 focus:bg-hpc-gold focus:text-gray-900',
        'bg-hpc-gold text-gray-900' => in_array(Route::currentRouteName(), $routes)
    ]) }}>
        {{ $title }}
    </a>
</li>
