@props([
    'index',
    'title'
])

<div class="flex items-center gap-4">
    <div>
        <div class="h-16 w-16 bg-gray-900 rounded-full text-2xl text-white font-bold flex items-center justify-center">
            {{ $index }}
        </div>
    </div>

    <div class="space-y-2 flex-shrink">
        <h3 class="text-xl font-medium">
            {{ $title }}
        </h3>

        {{ $slot }}
    </div>
</div>
