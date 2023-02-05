@extends('layouts.base')

@push('head.assets')
    @once
        @vite(['resources/css/litepicker.css', 'resources/js/chart.js', 'resources/js/litepicker.js'])
    @endonce
@endpush

@section('body')
    <x-page.banner>
        Player
    </x-page.banner>

    <div class="w-full mx-auto px-6 my-20 mt-0 md:mt-20 py-12 text-white space-y-12">
        <div class="w-full max-w-xl mx-auto flex flex-col items-center justify-center gap-4">
            @livewire('tracker.search')
        </div>

        <div
            class="w-full max-w-screen-2xl mx-auto grid lg:grid-cols-2 gap-12 bg-hpc-red-700 border border-hpc-red-800 rounded-lg p-4"
        >
            <div class="flex items-center gap-4">
                <x-tracker.player.avatar :player="$player"/>

                <div class="space-y-2">
                    <h2 class="font-semibold text-white text-4xl">
                        {{ $player->name }}
                    </h2>

                    <h3 class="font-medium">
                        <span class="text-hpc-gold">Nickname:</span> {{ $player->nickname ?? 'Unknown' }}
                    </h3>

                    <h3 class="font-medium">
                        <span
                            class="text-hpc-gold">Birth Date:</span> {{ $player->date_of_birth?->format('M j, Y') ?? 'Unknown' }}
                    </h3>

                    @if(filled($player->twitter_url) && filled($player->twitter_handle))
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
                {!! Str::markdown($player->biography ?? '') !!}
            </div>
        </div>

        <x-tracker.player.facts :facts="$facts"/>

        <div class="w-full grid lg:grid-cols-2 gap-12">
            <div>
                <x-tracker.player.historical-chart :data="$historicalChart"/>
            </div>

            <x-tracker.player.breakdown-by-location :data="$breakdownByLocation" :sessions="$player->sessions"/>
        </div>

        <div class="w-full space-y-4">
            <h2 class="text-4xl font-bold text-white">
                Session History
            </h2>

            @livewire('tracker.player.historical-session-table', ['player' => $player])
        </div>
    </div>
@endsection
