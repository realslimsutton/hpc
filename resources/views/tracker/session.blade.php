@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-screen-2xl mx-auto px-6 mb-20 py-12 text-white space-y-12">
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
            class="w-full max-w-screen-2xl mx-auto text-white"
        >
            <div class="mb-8">
                <a
                    href="{{ route('tracker.location', $session->location->id) }}"
                    class="inline-flex items-center gap-1 font-medium text-hpc-gold hover:underline focus:underline"
                >
                    <span>
                        @svg('heroicon-o-chevron-left', 'h-5 w-5')
                    </span>

                    <span>
                        Go back to {{ $session->location->name }}
                    </span>
                </a>
            </div>

            <div class="flex items-center flex-wrap gap-8 mb-8">
                @if($session->location->featured_image !== null)
                    <div>
                        <x-curator-glider :media="$session->location->featured_image" class="rounded-full"/>
                    </div>
                @endif

                <div>
                    <a
                        href="{{ route('tracker.location', $session->location->id) }}"
                        class="text-4xl font-bold transition-colors hover:text-hpc-gold focus:text-hpc-gold"
                        target="_blank"
                    >
                        {{ $session->location->name }}
                    </a>

                    <h3 class="text-lg font-semibold text-hpc-gold">
                        {{ $session->name }}
                    </h3>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                <div class="space-y-4 lg:col-span-1">
                    <h4 class="text-xl font-semibold">
                        <span class="text-hpc-gold">
                            Date:
                        </span>

                        <span>
                            {{ $session->date->format('M j, Y') }}
                        </span>
                    </h4>

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

                    <div class="space-y-2 overflow-x-auto">
                        <h2 class="text-4xl font-bold text-white">
                            Session Stats
                        </h2>

                        <x-tracker.session.table :data="$tableData"/>
                    </div>
                </div>

                <div>
                    @if(filled($embedUrl))
                        <iframe
                            class="w-full h-auto min-h-[24rem]"
                            src="{{ $embedUrl }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                        ></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
