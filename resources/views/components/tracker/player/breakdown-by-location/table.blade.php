@props([
    'data',
    'sessions'
])

<div class="overflow-x-auto">
    <table class="table-auto w-full text-center">
        <thead>
        <tr>
            <th class="text-hpc-gold">
                Livestream
            </th>

            <th class="text-hpc-gold">
                Net Winnings
            </th>

            <th class="text-hpc-gold">
                VPIP (%)
            </th>

            <th class="text-hpc-gold">
                PFR (%)
            </th>

            <th class="text-hpc-gold">
                Hours Played
            </th>

            <th class="text-hpc-gold">
                Hourly $
            </th>

            <th class="text-hpc-gold">
                BB/Hour
            </th>
        </tr>
        </thead>

        <tbody>
        @forelse($data as $locationId => $row)
            <x-tracker.player.breakdown-by-location.table-row :location-id="$locationId" :data="$row"/>
        @empty
            <x-tracker.player.breakdown-by-location.table-empty/>
        @endforelse

        @if($data->isNotEmpty())
            <x-tracker.player.breakdown-by-location.table-summary :data="$data" :sessions="$sessions"/>
        @endif
        </tbody>
    </table>
</div>
