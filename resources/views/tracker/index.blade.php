@extends('layouts.base')

@section('body')
    <x-page.banner>
        Livestream Tracker
    </x-page.banner>

    <div class="w-full mx-auto px-6 my-20 mt-0 md:mt-20 py-12 text-white space-y-12">
        <div class="w-full max-w-xl mx-auto flex flex-col items-center justify-center gap-4">
            @livewire('tracker.search')
        </div>

        <x-tracker.locations :locations="$locations" :rankings="$locationRankings" />

        <h2 class="text-2xl font-semibold text-center">
            Most Recent Episodes
        </h2>

        <x-tracker.latest-sessions :sessions="$latestSessions" />

        <h2 class="text-2xl font-semibold text-center text-white">
            Disclaimer
        </h2>

        <div class="w-full max-w-screen-2xl mx-auto text-sm space-y-2">
            <p>
                - Data is collected from the live stream "cumulative winnings" statistics given at the end of each
                livestream. The data provided on this website uses basic addition and averages of that data.
            </p>

            <p>
                - The data provided here does not include any amounts won or lost off stream. The data provided here
                only
                include amounts won or lost on livestream.
            </p>

            <p>
                - Highroll Poker Club is in no way affiliated with any of the livestreams to which we provide data for.
                This
                includes Hustler Casino Live, Live At The Bike, and The Lodge. This is simply a fan-operated statistics
                page.
            </p>
        </div>
    </div>
@endsection
