@props([
    'session'
])

<div
    class="bg-hpc-red-700 border border-hpc-red-800 rounded-lg p-4 text-white"
    x-data="{showWinners: true}"
>
    <div>
        <h3 class="text-xl font-semibold">
            {{ $session['name'] }}
        </h3>

        <h4 class="font-medium">
            <span class="text-hpc-gold">Table Stakes:</span> {{ $session['stake']['name'] }}
        </h4>

        <h4 class="font-medium">
            <span class="text-hpc-gold">Game Played:</span> {{ $session['poker_game']['name'] }}
        </h4>

        <h4 class="font-medium">
            <span class="text-hpc-gold">Location:</span> {{ $session['location']['name'] }}
        </h4>

        <h4 class="font-medium">
            <span class="text-hpc-gold">Date:</span> {{ Carbon\Carbon::parse($session['date'])->format('M j, Y') }}
        </h4>

        <a
            href="{{ $session['stream_url'] }}"
            class="font-medium text-hpc-gold transition-colors hover:text-white"
        >
            View Stream
        </a>
    </div>

    <div class="overflow-x-auto">
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
                @foreach($session['players'] as $player)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $player['name'] }}
                        </td>

                        <td>
                            @if($player['pivot']['net_winnings'] > 0)
                                <span class="text-green-500">
                                    {{ \Akaunting\Money\Money::USD($player['pivot']['net_winnings'] * 100) }}
                                </span>
                            @else
                                <span class="text-rose-500">
                                    {{ \Akaunting\Money\Money::USD($player['pivot']['net_winnings'] * 100) }}
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ number_format($player['pivot']['vpip']) }}%
                        </td>

                        <td>
                            {{ number_format($player['pivot']['pfr']) }}%
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
