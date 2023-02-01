@props([
    'data',
])

@php
    $route = route('tracker.player', $data['player_id'])
@endphp

<tr>
    <td>
        <a href="{{ $route }}" class="block" target="_blank">
            {{ $data['player_name'] }}
        </a>
    </td>
    <td>
        <a href="{{ $route }}" class="block" target="_blank">
            @if(filled($data['net_winnings']))
                <span class="{{ $data['net_winnings'] > 0 ? 'text-green-500' : 'text-rose-500' }}">
                    {{ \Akaunting\Money\Money::USD($data['net_winnings']) }}
                </span>
            @else
                <span>
                    -
                </span>
            @endif
        </a>
    </td>
    <td>
        <a href="{{ $route }}" class="block" target="_blank">
            <span>
                @if(filled($data['vpip']))
                    {{ number_format($data['vpip']) }}%
                @else
                    -
                @endif
            </span>
        </a>
    </td>
    <td>
        <a href="{{ $route }}" class="block" target="_blank">
            <span>
                @if(filled($data['pfr']))
                    {{ number_format($data['pfr']) }}%
                @else
                    -
                @endif
            </span>
        </a>
    </td>
    <td>
        <a href="{{ $route }}" class="block" target="_blank">
            <span>
                @if(filled($data['hours_played']))
                    {{ number_format($data['hours_played'], 2) }}
                @else
                    -
                @endif
            </span>
        </a>
    </td>
    <td>
        <a href="{{ $route }}" class="block" target="_blank">
            @if(filled($data['avg_hourly_net_winnings']))
                <span class="{{ $data['avg_hourly_net_winnings'] > 0 ? 'text-green-500' : 'text-rose-500' }}">
                    {{ \Akaunting\Money\Money::USD($data['avg_hourly_net_winnings']) }}
                </span>
            @else
                <span>
                    -
                </span>
            @endif
        </a>
    </td>
    <td>
        <a href="{{ $route }}" class="block" target="_blank">
            @if(filled($data['avg_hourly_bb']))
                <span class="{{ $data['avg_hourly_bb'] > 0 ? 'text-green-500' : 'text-rose-500' }}">
                    {{ number_format($data['avg_hourly_bb'] / 100, 2) }} BB
                </span>
            @else
                <span>
                    -
                </span>
            @endif
        </a>
    </td>
</tr>
