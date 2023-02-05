@props([
    'data',
    'sessions',
])

@php
    $netWinnings = $data->sum('sum_net_winnings');
    $vpip = $sessions->average('pivot.vpip');
    $pfr = $sessions->average('pivot.pfr');
    $hoursPlayed = $data->sum('sum_hours_played');
    $hourlyNetWinnings = (filled($hoursPlayed) && $hoursPlayed > 0) ? $netWinnings / $hoursPlayed : null;
    $hourlyBB = $sessions->average(static fn($session) => ($session->pivot->hours_played > 0 && $session->stake->big_blind > 0)
        ? ($session->pivot->net_winnings / $session->stake->big_blind) / $session->pivot->hours_played
        : null
    );
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
