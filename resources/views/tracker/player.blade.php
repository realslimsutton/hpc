@extends('layouts.base')

@push('head.assets')
    @once
        @vite(['resources/css/litepicker.css', 'resources/js/chart.js', 'resources/js/litepicker.js'])
    @endonce
@endpush

@section('body')
    <x-page.banner>
        Professional Player
    </x-page.banner>

    <div class="w-full mx-auto px-6 my-20 mt-0 md:mt-20 py-12 text-white space-y-12 space-y-12">
        <div class="w-full max-w-xl mx-auto flex flex-col items-center justify-center gap-4">
            @livewire('tracker.search')
        </div>

        <div class="w-full max-w-screen-2xl mx-auto grid lg:grid-cols-2 gap-12 bg-hpc-red-700 border border-hpc-red-800 rounded-lg p-4">
            <div class="flex items-center gap-4">
                @if($player->featured_image !== null)
                    <x-curator-glider :media="$player->featured_image" class="h-32 w-32 rounded-full"/>
                @else
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($player->name) }}&color=FFCD67&background=5A0410"
                        class="h-32 w-32 rounded-full"
                    />
                @endif

                <div class="space-y-2">
                    <h2 class="font-semibold text-white text-4xl">
                        {{ $player->name }}
                    </h2>

                    <h3 class="font-medium">
                        <span class="text-hpc-gold">Nickname:</span> {{ $player->nickname ?? 'Unknown' }}
                    </h3>

                    <h3 class="font-medium">
                        <span class="text-hpc-gold">Birth Date:</span> {{ $player->date_of_birth?->format('M j, Y') ?? 'Unknown' }}
                    </h3>

                    @if($player->twitter_url !== null)
                        <p>
                            <a
                                href="{{ $player->twitter_url }}"
                                class="inline-flex items-center gap-1 transition-colors hover:text-hpc-gold"
                                target="_blank"
                            >
                                <span class="text-hpc-gold">
                                    @svg('hpc-social.twitter', 'h-6 w-6')
                                </span>

                                <span>
                                    {{ '@' . $player->twitter_handle }}
                                </span>
                            </a>
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex flex-col justify-center space-y-2">
                {!! Str::markdown($player->biography) !!}
            </div>
        </div>

        <div class="grid md:grid-cols-4 lg:grid-cols-8">
            <x-tracker.player.player-fact title="Hometown" class="rounded-l-lg">
                {{ $player->hometown ?? 'Unknown' }}
            </x-tracker.player.player-fact>

            <x-tracker.player.player-fact title="Nationality">
                @if($country !== null)
                    <span>
                        @svg('hpc-country-flags.4x3.' . $country->code_2, 'h-6 w-6')
                    </span>
                @endif

                <span>
                    {{ $country?->name ?? 'Unknown' }}
                </span>
            </x-tracker.player.player-fact>

            <x-tracker.player.player-fact title="Profession">
                {{ $player->profession ?? 'Unknown' }}
            </x-tracker.player.player-fact>

            <x-tracker.player.player-fact title="Net Winnings">
                {{ \Akaunting\Money\Money::USD($totalWinnings * 100) }}
            </x-tracker.player.player-fact>

            <x-tracker.player.player-fact title="Sessions Played">
                {{ number_format($sessionsPlayed) }}
            </x-tracker.player.player-fact>

            <x-tracker.player.player-fact title="Hours played">
                {{ number_format($hoursPlayed) }}
            </x-tracker.player.player-fact>

            <x-tracker.player.player-fact title="Stakes Played">
                {{ $mostPlayedStake ?? 'Unknown' }}
            </x-tracker.player.player-fact>

            <x-tracker.player.player-fact title="First Session" class="rounded-r-lg">
                {{ $firstSession?->format('M j, Y') ?? 'Unknown' }}
            </x-tracker.player.player-fact>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <div>
                <x-tracker.player.historical-chart :chart-data="$chartData"/>
            </div>

            <div class="space-y-12">
                <div class="w-full space-y-4">
                    <h2 class="text-4xl font-bold text-white">
                        Breakdown by Livestream
                    </h2>

                    <div class="relative bg-hpc-red-700  rounded-xl border border-hpc-red-800 p-4">
                        <x-tracker.player.location-breakdown-table :data="$breakdownByLocation"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full space-y-4">
            <h2 class="text-4xl font-bold text-white">
                Session History
            </h2>

            @livewire('tracker.player-session-history', ['player' => $player])
        </div>
    </div>
@endsection
