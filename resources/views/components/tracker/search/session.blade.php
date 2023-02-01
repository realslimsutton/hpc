@props([
    'result'
])

<a
    href="{{ route('tracker.session', $result->id) }}"
    class="w-full py-4 px-6 h-20 flex items-center gap-4"
    x-data
>
    @if($result->location->featured_image !== null)
        <div>
            <x-curator-glider :media="$result->location->featured_image" class="h-16 w-auto rounded-full"/>
        </div>
    @endif

    <div class="flex-grow flex justify-between flex-wrap">
        <div>
            <h3 class="font-medium text-lg">
                {{ $result->name }}
            </h3>

            <p class="text-hpc-gold text-sm font-medium">
                Livestream
            </p>
        </div>

        <x-button
            class="text-sm"
            size="sm"
            x-on:click.prevent="window.open('{{ $result->stream_url }}', '_blank').focus()"
        >
            View stream
        </x-button>
    </div>
</a>
