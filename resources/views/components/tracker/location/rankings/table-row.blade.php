@props([
    'id',
    'data',
    'index'
])

@php
    $route = route('tracker.player', $id);
@endphp

<tr>
    <td>
        <a href="{{ $route }}" class="block">
            {{ $index }}
        </a>
    </td>

    <td>
        <a href="{{ $route }}" class="block">
            {{ $data['player_name'] }}
        </a>
    </td>

    <td>
        <a href="{{ $route }}" class="block">
            @if(filled($data['sum_net_winnings']))
                <span class="{{ $data['sum_net_winnings'] > 0 ?'text-green-500' : 'text-rose-500' }}">
                    {{ \Akaunting\Money\Money::USD($data['sum_net_winnings']) }}
                </span>
            @else
                <span>
                    -
                </span>
            @endif
        </a>
    </td>

    <td>
        <a href="{{ $route }}" class="block">
            @if(filled($data['avg_vpip']))
                {{ number_format($data['avg_vpip']) }}%
            @else
                -
            @endif
        </a>
    </td>

    <td>
        <a href="{{ $route }}" class="block">
            @if(filled($data['avg_pfr']))
                {{ number_format($data['avg_pfr']) }}%
            @else
                -
            @endif
        </a>
    </td>
</tr>
