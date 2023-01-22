@extends('layouts.base')

@section('body')
    <x-page.banner>
        Livestream Tracker
    </x-page.banner>

    <div class="w-full mx-auto px-6 my-20 mt-0 md:mt-20 py-12 text-white space-y-12 space-y-12">
        <div class="max-w-screen-2xl mx-auto grid lg:grid-cols-3 gap-6">
            @foreach($locations as $location)
                <x-tracker.location-rankings
                    :location="$location"
                    :topRankings="$topRankings[$location->id]"
                    :bottomRankings="$bottomRankings[$location->id]"
                />
            @endforeach
        </div>

        <h2 class="text-2xl font-semibold text-center">
            Most Recent Episodes
        </h2>

        <div class="grid lg:grid-cols-4 gap-6">
            @foreach($latestSessions as $session)
                <x-tracker.latest-session-rankings :session="$session"/>
            @endforeach
        </div>
    </div>
@endsection
