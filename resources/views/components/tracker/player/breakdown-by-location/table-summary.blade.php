@props([
    'data'
])

@php
    $netWinnings = $data->sum('sum_net_winnings');
    $vpip = $data->average('avg_vpip');
    $pfr = $data->average('avg_pfr');
    $hoursPlayed = $data->sum('sum_hours_played');
    $hourlyNetWinnings = (filled($hoursPlayed) && $hoursPlayed > 0) ? $netWinnings / $hoursPlayed : null;
    $hourlyBB = $data->average('avg_hourly_bb');
@endphp

<tr>
    <td></td>

    <td class="p-2 whitespace-nowrap">
        <span class="{{ $netWinnings > 0 ? 'text-green-500' : 'text-rose-500' }}">
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
        {{ number_format($hoursPlayed, 2) }}
    </td>

    <td class="p-2 whitespace-nowrap">
        <span class="{{ $hourlyNetWinnings > 0 ? 'text-green-500' : 'text-rose-500' }}">
            {{ \Akaunting\Money\Money::USD($hourlyNetWinnings) }}
        </span>
    </td>

    <td class="p-2 whitespace-nowrap">
        <span class="{{ $hourlyBB > 0 ? 'text-green-500' : 'text-rose-500' }}">
            {{ number_format($hourlyBB / 100, 2) }} BB
        </span>
    </td>
</tr>
