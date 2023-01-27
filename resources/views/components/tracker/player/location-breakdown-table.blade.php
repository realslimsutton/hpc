@props([
    'data'
])

<table class='table-auto overflow-scroll w-full'>
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
        @php
            $allNetWinnings = 0;
            $allVPip = 0;
            $allPfr = 0;
            $allHoursPlayed = 0;
            $allHourlyNetWinnings = 0;
            $allHourlyBigBlind = 0;
        @endphp

        @forelse($data as $location => $records)
            @php
                $netWinnings = $records->sum('pivot.net_winnings') * 100;
                $vpip = $records->average('pivot.vpip');
                $pfr = $records->average('pivot.pfr');
                $hoursPlayed = $records->sum('pivot.hours_played');
                $hourlyNetWinnings = $records->average(static fn($record) => ($record->pivot->net_winnings * 100) / $record->pivot->hours_played);
                $hourlyBigBlind = $records->average(static fn($record) => (($record->pivot->net_winnings * 100) / $record->stake->big_blind) / $record->pivot->hours_played);

                $allNetWinnings += $netWinnings;
                $allVPip += $vpip;
                $allPfr += $pfr;
                $allHoursPlayed += $hoursPlayed;
                $allHourlyNetWinnings += $hourlyNetWinnings;
                $allHourlyBigBlind += $hourlyBigBlind;
            @endphp
            <tr>
                <td class="p-2 whitespace-nowrap">
                    {{ $location }}
                </td>

                <td class="p-2 whitespace-nowrap">
                    <span class="{{ $netWinnings > 0 ?'text-green-500' : 'text-rose-500' }}">
                        {{ \Akaunting\Money\Money::USD($netWinnings) }}
                    </span>
                </td>

                <td class="p-2 whitespace-nowrap">
                    {{ number_format($vpip) }}%
                </td>

                <td class="p-2 whitespace-nowrap">
                    {{ number_format($pfr) }}%
                </td>

                <td class="p-2 whitespace-nowrap">
                    {{ number_format($hoursPlayed) }}
                </td>

                <td class="p-2 whitespace-nowrap">
                    <span class="{{ $hourlyNetWinnings > 0 ?'text-green-500' : 'text-rose-500' }}">
                        {{ \Akaunting\Money\Money::USD($hourlyNetWinnings) }}
                    </span>
                </td>

                <td class="p-2 whitespace-nowrap">
                    <span class="{{ $hourlyBigBlind > 0 ?'text-green-500' : 'text-rose-500' }}">
                        {{ number_format($hourlyBigBlind / 100, 2) }} BB
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td class="p-2" colspan="6">
                    No results found
                </td>
            </tr>
        @endforelse

        @if($data->isNotEmpty())
            @php
                $count = $data->count();

                $allVPip /= $count;
                $allPfr /= $count;
                $allHourlyNetWinnings /= $count;
                $allHourlyBigBlind /= $count;
            @endphp

            <tr>
                <td></td>

                <td class="p-2 whitespace-nowrap">
                    <span class="{{ $allNetWinnings > 0 ?'text-green-500' : 'text-rose-500' }}">
                        {{ \Akaunting\Money\Money::USD($allNetWinnings) }}
                    </span>
                </td>

                <td class="p-2 whitespace-nowrap">
                    {{ number_format($allVPip) }}%
                </td>

                <td class="p-2 whitespace-nowrap">
                    {{ number_format($allPfr) }}%
                </td>

                <td class="p-2 whitespace-nowrap">
                    {{ number_format($allHoursPlayed) }}
                </td>

                <td class="p-2 whitespace-nowrap">
                    <span class="{{ $allHourlyNetWinnings > 0 ?'text-green-500' : 'text-rose-500' }}">
                        {{ \Akaunting\Money\Money::USD($allHourlyNetWinnings) }}
                    </span>
                </td>

                <td class="p-2 whitespace-nowrap">
                    <span class="{{ $allHourlyBigBlind > 0 ?'text-green-500' : 'text-rose-500' }}">
                        {{ number_format($allHourlyBigBlind / 100, 2) }} BB
                    </span>
                </td>
            </tr>
        @endif
    </tbody>
</table>
