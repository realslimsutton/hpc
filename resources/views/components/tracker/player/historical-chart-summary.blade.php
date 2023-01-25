@php
    $netWinnings = 0;
    $vpip = 0;
    $pfr = 0;
    $hoursPlayed = 0;
    $hourlyNetWinnings = 0;
    $hourlyBigBlind = 0;
    $count = 0;

    foreach($this->getTableRecords() as $record) {
        $netWinnings += $record->net_winnings;
        $vpip += $record->vpip;
        $pfr += $record->pfr;
        $hoursPlayed += $record->hours_played;
        $hourlyNetWinnings += $record->hourly_net_winnings;
        $hourlyBigBlind += $record->hourly_big_blinds;
        $count++;
    }

    if($count > 0) {
        $vpip /= $count;
        $pfr /= $count;
        $hourlyNetWinnings /= $count;
        $hourlyBigBlind /= $count;
    }
@endphp

<tr>
    <td colspan="3"></td>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    <span class="{{ $netWinnings > 0 ? 'text-green-500' : 'text-rose-500' }}">
                        {{ \Akaunting\Money\Money::USD($netWinnings) }}
                    </span>
                </div>
            </div>
        </div>
    </x-tables::cell>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    <span>
                        {{ number_format($vpip * 100) }}%
                    </span>
                </div>
            </div>
        </div>
    </x-tables::cell>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    <span>
                        {{ number_format($pfr * 100) }}%
                    </span>
                </div>
            </div>
        </div>
    </x-tables::cell>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    <span>
                        {{ number_format($hoursPlayed) }}
                    </span>
                </div>
            </div>
        </div>
    </x-tables::cell>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    <span class="{{ $hourlyNetWinnings > 0 ? 'text-green-500' : 'text-rose-500' }}">
                        {{ \Akaunting\Money\Money::USD($hourlyNetWinnings) }}
                    </span>
                </div>
            </div>
        </div>
    </x-tables::cell>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    <span class="{{ $hourlyBigBlind > 0 ? 'text-green-500' : 'text-rose-500' }}">
                        {{ number_format($hourlyBigBlind) }} BB
                    </span>
                </div>
            </div>
        </div>
    </x-tables::cell>
</tr>
