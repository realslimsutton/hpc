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
        @foreach($rankings as $name => $data)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $name }}
                </td>

                <td>
                    @if($data['net_winnings'] > 0)
                        <span class="text-green-500">
                            {{ \Akaunting\Money\Money::USD($data['net_winnings'] * 100) }}
                        </span>
                    @else
                        <span class="text-rose-500">
                            {{ \Akaunting\Money\Money::USD($data['net_winnings'] * 100) }}
                        </span>
                    @endif
                </td>

                <td>
                    {{ number_format($data['vpip']) }}%
                </td>

                <td>
                    {{ number_format($data['pfr']) }}%
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
