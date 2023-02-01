@extends('layouts.base')

@section('body')
    <x-page.banner>
        Session
    </x-page.banner>

    <div class="w-full mx-auto px-6 my-20 mt-0 md:mt-20 py-12 text-white space-y-12">
        <div class="w-full max-w-xl mx-auto flex flex-col items-center justify-center gap-4">
            @livewire('tracker.search')

            @if(filled($session->created_at) || filled($session->updated_at))
                <div>
                    <h2 class="text-lg font-semibold text-center">
                        Last updated: {{ ($session->updated_at ?? $session->created_at)->diffForHumans() }}
                    </h2>
                </div>
            @endif
        </div>

        <div
            class="w-full max-w-screen-2xl mx-auto grid lg:grid-cols-2 gap-12 text-white"
        >
            <div class="space-y-4 lg:col-span-1">
                <div class="flex items-center flex-wrap gap-8 mb-8">
                    @if($session->location->featured_image !== null)
                        <div>
                            <x-curator-glider :media="$session->location->featured_image" class="rounded-full"/>
                        </div>
                    @endif

                    <h2 class="text-4xl font-bold">
                        {{ $session->location->name }}
                    </h2>
                </div>

                <h3 class="text-2xl font-semibold">
                    {{ $session->name }}
                </h3>

                <h4 class="text-xl font-semibold">
                    <span class="text-hpc-gold">
                        Game Type:
                    </span>

                    <span>
                        {{ $session->game_rules->name }}
                    </span>
                </h4>

                <h4 class="text-xl font-semibold">
                    <span class="text-hpc-gold">
                        Stakes Played:
                    </span>

                    <span>
                        {{ $session->stake->name }}
                    </span>
                </h4>

                @if(filled($embedUrl))
                    <div>
                        <iframe
                            class="w-full h-auto min-h-[24rem]"
                            src="{{ $embedUrl }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                        ></iframe>
                    </div>
                @endif
            </div>

            <div class="space-y-2 overflow-x-auto">
                <h2 class="text-4xl font-bold text-white">
                    Session Stats
                </h2>

                <x-tracker.session.table :data="$tableData"/>
            </div>
        </div>
    </div>
@endsection
