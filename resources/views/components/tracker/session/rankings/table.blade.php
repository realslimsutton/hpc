@props([
    'session',
])

<div class="overflow-x-auto">
    <table class="table-auto w-full text-center">
        <thead>
        <tr>
            <th colspan="2"></th>

            <th>
                Net winnings
            </th>

            <th>
                VPIP (%)
            </th>

            <th>
                PFR (%)
            </th>
        </tr>
        </thead>

        <tbody>
        @foreach($session->players as $player)
            <x-tracker.session.rankings.table-row :id="$player->id" :data="$player" :index="$loop->iteration"/>
        @endforeach
        </tbody>
    </table>
</div>
