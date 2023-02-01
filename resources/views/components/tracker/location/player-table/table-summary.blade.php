@php
    $records = $this->getTableRecords();

    $netWinnings = $records->sum('net_winnings');
    $vpip = $records->avg('vpip');
    $pfr = $records->avg('pfr');
    $hoursPlayed = $records->sum('hours_played');
    $hourlyNetWinnings = (filled($hoursPlayed) && $hoursPlayed > 0) ? $netWinnings / $hoursPlayed : null;
    $hourlyBB = $records->avg('hourly_bb');
@endphp

<tr>
    <td></td>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    @if(filled($netWinnings))
                        <span class="{{ $netWinnings > 0 ? 'text-green-500' : 'text-rose-500' }}">
                            {{ \Akaunting\Money\Money::USD($netWinnings) }}
                        </span>
                    @else
                        <span>
                            -
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </x-tables::cell>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    <span>
                        @if(filled($vpip))
                            {{ number_format($vpip) }}%
                        @else
                            -
                        @endif
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
                        @if(filled($pfr))
                            {{ number_format($pfr) }}%
                        @else
                            -
                        @endif
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
                        @if(filled($hoursPlayed))
                            {{ number_format($hoursPlayed, 2) }}
                        @else
                            -
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </x-tables::cell>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    @if(filled($hourlyNetWinnings))
                        <span class="{{ $hourlyNetWinnings > 0 ? 'text-green-500' : 'text-rose-500' }}">
                            {{ \Akaunting\Money\Money::USD($hourlyNetWinnings) }}
                        </span>
                    @else
                        <span>
                            -
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </x-tables::cell>

    <x-tables::cell>
        <div class="filament-tables-column-wrapper">
            <div class="filament-tables-text-column px-4 py-3">
                <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    @if(filled($hourlyBB))
                        <span class="{{ $hourlyBB > 0 ? 'text-green-500' : 'text-rose-500' }}">
                            {{ number_format($hourlyBB, 2) }} BB
                        </span>
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>
    </x-tables::cell>
</tr>
