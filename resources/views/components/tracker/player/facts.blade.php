@props([
    'facts',
])

<div class="grid md:grid-cols-4 lg:grid-cols-8">
    <x-tracker.player.fact
        title="Hometown"
        class="rounded-tl-lg rounded-tr-lg md:rounded-tr-none rounded-bl-none lg:rounded-bl-lg"
    >
        {{ $facts['hometown'] ?? 'Unknown' }}
    </x-tracker.player.fact>

    <x-tracker.player.fact title="Nationality">
        @if($facts['country'] !== null)
            <span>
                @svg('hpc-country-flags.4x3.' . $facts['country']->code_2, 'h-6 w-6')
            </span>
        @endif

        <span>
            {{ $facts['country']?->name ?? 'Unknown' }}
        </span>
    </x-tracker.player.fact>

    <x-tracker.player.fact title="Profession">
        {{ $facts['profession'] ?? 'Unknown' }}
    </x-tracker.player.fact>

    <x-tracker.player.fact title="Net Winnings" class="md:rounded-tr-lg lg:rounded-tr-none">
        {{ \Akaunting\Money\Money::USD($facts['sum_net_winnings']) }}
    </x-tracker.player.fact>

    <x-tracker.player.fact title="Sessions" class="md:rounded-bl-lg lg:rounded-bl-none">
        {{ number_format($facts['sessions_count']) }}
    </x-tracker.player.fact>

    <x-tracker.player.fact title="Hours played">
        {{ number_format($facts['sum_hours_played']) }}
    </x-tracker.player.fact>

    <x-tracker.player.fact title="Stakes Played">
        {{ $facts['most_played_stake'] ?? 'Unknown' }}
    </x-tracker.player.fact>

    <x-tracker.player.fact
        title="First Session"
        class="rounded-br-lg rounded-bl-lg md:rounded-bl-none lg:rounded-tr-lg"
    >
        {{ $facts['first_session_date']?->format('M j, Y') ?? 'Unknown' }}
    </x-tracker.player.fact>
</div>
