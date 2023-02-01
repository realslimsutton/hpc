@props([
    'location',
    'rankings',
])

@php
    $route = route('tracker.location', $location->id);
@endphp

<div
    class="bg-hpc-red-700 border border-hpc-red-800 rounded-lg p-4 text-white space-y-8"
    x-data="{showWinners: true}"
>
    <div class="flex items-center flex-wrap gap-8">
        @if($location->featured_image !== null)
            <div>
                <a href="{{ $route }}">
                    <x-curator-glider :media="$location->featured_image" class="rounded-full"/>
                </a>
            </div>
        @endif

        <div>
            <a
                href="{{ $route }}"
                class="text-xl font-semibold transition-colors hover:text-hpc-gold focus:text-hpc-gold"
            >
                {{ $location->name }}
            </a>

            @if(filled($location->subscriber_count))
                <h4 class="text-hpc-gold">
                    {{ $location->subscriber_count }} subscribers
                </h4>
            @endif
        </div>
    </div>

    <div class="w-full grid md:grid-cols-2 gap-4">
        <div>
            <button
                class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-md font-semibold ring ring-transparent transition-colors"
                x-on:click.prevent="showWinners = true"
                x-bind:class="showWinners ? 'bg-hpc-red-900': 'text-gray-400'"
            >
                Top winners
            </button>
        </div>

        <div>
            <button
                class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-md font-semibold ring ring-transparent transition-colors"
                x-on:click.prevent="showWinners = false"
                x-bind:class="!showWinners ? 'bg-hpc-red-900': 'text-gray-400'"
            >
                Most unlucky
            </button>
        </div>
    </div>

    <div x-show="showWinners" class="w-full text-sm">
        <x-tracker.location.rankings.table :rankings="$rankings['high']"/>
    </div>

    <div
        class="w-full text-sm"
        x-show="!showWinners"
        x-cloak
    >
        <x-tracker.location.rankings.table :rankings="$rankings['low']"/>
    </div>
</div>
