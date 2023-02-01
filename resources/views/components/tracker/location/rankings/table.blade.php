@props([
    'rankings'
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
            @foreach($rankings as $id => $data)
                <x-tracker.location.rankings.table-row :id="$id" :data="$data" :index="$loop->iteration"/>
            @endforeach
        </tbody>
    </table>
</div>
