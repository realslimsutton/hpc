@props([
    'data',
    'sessions'
])

<div class="space-y-12 overflow-x-hidden">
    <div class="w-full space-y-4 overflow-x-hidden">
        <h2 class="text-4xl font-bold text-white">
            Breakdown by Livestream
        </h2>

        <div class="relative bg-hpc-red-700 rounded-xl border border-hpc-red-800 p-4 overflow-x-auto">
            <x-tracker.player.breakdown-by-location.table :data="$data" :sessions="$sessions"/>
        </div>
    </div>
</div>
