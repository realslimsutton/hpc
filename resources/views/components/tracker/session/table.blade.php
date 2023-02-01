@props([
    'data'
])

<div class="relative bg-hpc-red-700 rounded-xl border border-hpc-red-800 p-4 overflow-x-auto">
    <table class="table-auto w-full text-center">
        <thead>
        <tr>
            <th class="text-hpc-gold">
                Player
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
            @foreach($data as $record)
                <x-tracker.session.table-row :data="$record"/>
            @endforeach
        </tbody>
    </table>
</div>
