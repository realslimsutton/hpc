@props([
    'location',
    'rankings'
])

<div
    class="bg-hpc-red-700 border border-hpc-red-800 rounded-lg p-4 text-white"
    x-data="{showWinners: true}"
>
    <div class="flex items-center flex-wrap gap-8">
        @if($location['featured_image'] !== null)
            <div>
                <x-curator-glider :media="new \Awcodes\Curator\Models\Media($location['featured_image'])" class="rounded-full"/>
            </div>
        @endif

        <div>
            <h3 class="text-xl font-semibold">
                {{ $location['name'] }}
            </h3>

            <h4 class="text-hpc-gold">
                70k subscribers
            </h4>
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
            <x-tracker.location-rankings.table :rankings="$rankings['highest']"/>
        </div>

        <div
            class="w-full text-sm"
            x-show="!showWinners"
            x-cloak
        >
            <x-tracker.location-rankings.table :rankings="$rankings['lowest']"/>
        </div>
    </div>
</div>
