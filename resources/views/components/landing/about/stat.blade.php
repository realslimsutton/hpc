@props([
    'title',
    'body'
])

<div class="flex flex-col items-center justify-center text-white gap-4">
    <div>
        {{ $icon }}
    </div>

    <div>
        <h3 class="text-6xl">
            {{ $title }}
        </h3>
    </div>

    <div>
        <h4 class="text-lg font-medium">
            {{ $body }}
        </h4>
    </div>
</div>
