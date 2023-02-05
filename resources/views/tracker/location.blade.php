@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
        <div class="w-full max-w-xl mx-auto flex flex-col items-center justify-center gap-4">
            @livewire('tracker.search')
        </div>

        <div
            class="w-full max-w-screen-2xl mx-auto space-y-12"
        >
            <div class="flex items-center flex-wrap gap-8">
                @if($location->featured_image !== null)
                    <div>
                        <x-curator-glider :media="$location->featured_image" class="rounded-full"/>
                    </div>
                @endif

                <div>
                    <h2 class="text-4xl font-bold">
                        {{ $location->name }}
                    </h2>

                    @if(filled($location->subscriber_count))
                        <h3 class="text-lg font-semibold text-hpc-gold">
                            {{ $location->subscriber_count }} subscribers
                        </h3>
                    @endif
                </div>
            </div>

            <div
                class="space-y-2"
                x-data="{
                    showSessions: true,
                    playersLoaded: false,
                    toggleShowSessions() {
                        this.showSessions = !this.showSessions;

                        if(!this.playersLoaded && !this.showSessions) {
                            window.livewire.emit('showPlayers');
                        }
                    },
                    onPlayersLoaded() {
                        this.playersLoaded = true;
                    }
                }"
                x-on:players-loaded.window="onPlayersLoaded"
            >
                <div class="flex items-center justify-between gap-8 flex-wrap">
                    <h2 class="text-4xl font-bold text-white">
                        <span x-show="showSessions">
                            Sessions
                        </span>

                        <span x-show="!showSessions" x-cloak>
                            Players
                        </span>
                    </h2>

                    <x-button x-on:click.prevent="toggleShowSessions" wire:loading.attr="disabled">
                        <span x-show="showSessions">
                            Show players
                        </span>

                        <span x-show="!showSessions" x-cloak>
                            Show sessions
                        </span>
                    </x-button>
                </div>

                <div
                    x-show="showSessions"
                >
                    @livewire('tracker.location.historical-sessions-table', ['location' => $location])
                </div>

                <div
                    x-show="!showSessions"
                    x-cloak
                >
                    <div
                        class="flex items-center justify-center text-lg font-medium"
                        x-show="!playersLoaded"
                    >
                        Loading...
                    </div>

                    @livewire('tracker.location.player-table', ['location' => $location])
                </div>
            </div>
        </div>
    </div>
@endsection
