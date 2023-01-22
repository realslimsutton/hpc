@props([
    'rankings'
])

<table class="w-full text-center">
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
            @php
                $playerRoute = route('tracker.player', $id);
            @endphp

            <tr>
                <td>
                    <a href="{{ $playerRoute }}" class="block">
                        {{ $loop->iteration }}
                    </a>
                </td>

                <td>
                    <a href="{{ $playerRoute }}" class="block">
                        {{ $data['name'] }}
                    </a>
                </td>

                <td>
                    <a href="{{ $playerRoute }}" class="block">
                        @if($data['net_winnings'] > 0)
                            <span class="text-green-500">
                                {{ \Akaunting\Money\Money::USD($data['net_winnings'] * 100) }}
                            </span>
                        @else
                            <span class="text-rose-500">
                                {{ \Akaunting\Money\Money::USD($data['net_winnings'] * 100) }}
                            </span>
                        @endif
                    </a>
                </td>

                <td>
                    <a href="{{ $playerRoute }}" class="block">
                        {{ number_format($data['vpip']) }}%
                    </a>
                </td>

                <td>
                    <a href="{{ $playerRoute }}" class="block">
                        {{ number_format($data['pfr']) }}%
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
