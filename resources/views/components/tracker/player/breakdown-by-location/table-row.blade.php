@props([
    'location',
    'data'
])

<tr>
    <td class="p-2 whitespace-nowrap">
        {{ $location }}
    </td>

    <td class="p-2 whitespace-nowrap">
        @if(filled($data['sum_net_winnings']))
            <span class="{{ $data['sum_net_winnings'] > 0 ? 'text-green-500' : 'text-rose-500' }}">
                {{ \Akaunting\Money\Money::USD($data['sum_net_winnings']) }}
            </span>
        @else
            <span>
                -
            </span>
        @endif
    </td>

    <td class="p-2 whitespace-nowrap">
        @if(filled($data['avg_vpip']))
            {{ number_format($data['avg_vpip']) }}%
        @else
            -
        @endif
    </td>

    <td class="p-2 whitespace-nowrap">
        @if(filled($data['avg_pfr']))
            {{ number_format($data['avg_pfr']) }}%
        @else
            -
        @endif
    </td>

    <td class="p-2 whitespace-nowrap">
        @if(filled($data['sum_hours_played']))
            {{ number_format($data['sum_hours_played'], 2) }}
        @else
            -
        @endif
    </td>

    <td class="p-2 whitespace-nowrap">
        @if(filled($data['avg_hourly_net_winnings']))
            <span class="{{ $data['avg_hourly_net_winnings'] > 0 ? 'text-green-500' : 'text-rose-500' }}">
                {{ \Akaunting\Money\Money::USD($data['avg_hourly_net_winnings']) }}
            </span>
        @else
            <span>
                -
            </span>
        @endif
    </td>

    <td class="p-2 whitespace-nowrap">
        @if(filled($data['avg_hourly_bb']))
            <span class="{{ $data['avg_hourly_bb'] > 0 ? 'text-green-500' : 'text-rose-500' }}">
                {{ number_format($data['avg_hourly_bb'] / 100, 2) }} BB
            </span>
        @else
            <span>
                -
            </span>
        @endif
    </td>
</tr>
