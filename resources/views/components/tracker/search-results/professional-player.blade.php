@props([
    'result'
])

<a
    href="{{ route('tracker.player', $result->id) }}"
    class="w-full py-4 px-6 h-20 flex items-center gap-4"
>
    <div>
        @if($result->featured_image !== null)
            <x-curator-glider :media="$result->featured_image" class="h-16 w-16 rounded-full"/>
        @else
            <img
                src="https://ui-avatars.com/api/?name={{ urlencode($result->name) }}&color=FFCD67&background=5A0410"
                class="h-16 w-16 rounded-full"
            />
        @endif
    </div>

    <div>
        <h3 class="font-medium text-lg">
            {{ $result->name }}
        </h3>

        <p class="text-hpc-gold text-sm font-medium">
            {{ $result->profession ?? 'Player' }}
        </p>
    </div>
</a>
