@props([
    'session',
])

<div
    class="bg-hpc-red-700 border border-hpc-red-800 rounded-lg p-4 text-white space-y-6"
    x-data="{showWinners: true}"
>
    <div>
        <h3 class="text-xl font-semibold">
            {{ $session->name }}
        </h3>

        <h4 class="font-medium">
            <span class="text-hpc-gold">Table Stakes:</span> {{ $session->stake->name }}
        </h4>

        <h4 class="font-medium">
            <span class="text-hpc-gold">Game Played:</span> {{ $session->game_rules->name }}
        </h4>

        <h4 class="font-medium">
            <span class="text-hpc-gold">Location:</span> {{ $session->location->name }}
        </h4>

        <h4 class="font-medium">
            <span class="text-hpc-gold">Date:</span> {{ $session->date->format('M j, Y') }}
        </h4>

        @if(filled($session->stream_url))
            <a
                href="{{ $session->stream_url }}"
                class="block font-medium text-hpc-gold transition-colors hover:text-white"
            >
                View Stream
            </a>
        @endif
    </div>

    <x-tracker.session.rankings.table :session="$session"/>
</div>
