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
            {{ $data->name }}
        </a>
    </td>

    <td>
        <a href="{{ $route }}" class="block">
            @if(filled($data->pivot->net_winnings))
                @if($data->pivot->net_winnings > 0)
                    <span class="text-green-500">
                        {{ \Akaunting\Money\Money::USD($data->pivot->net_winnings) }}
                    </span>
                @else
                    <span class="text-rose-500">
                        {{ \Akaunting\Money\Money::USD($data->pivot->net_winnings) }}
                    </span>
                @endif
            @else
                <span>
                    -
                </span>
            @endif
        </a>
    </td>

    <td>
        <a href="{{ $route }}" class="block">
            @if(filled($data->pivot->vpip))
                {{ number_format($data->pivot->vpip) }}%
            @else
                -
            @endif
        </a>
    </td>

    <td>
        <a href="{{ $route }}" class="block">
            @if(filled($data->pivot->pfr))
                {{ number_format($data->pivot->pfr) }}%
            @else
                -
            @endif
        </a>
    </td>
</tr>
