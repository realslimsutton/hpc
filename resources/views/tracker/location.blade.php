@extends('layouts.base')

@section('body')
    <x-page.banner>
        Location
    </x-page.banner>

    <div class="w-full mx-auto px-6 my-20 mt-0 md:mt-20 py-12 text-white space-y-12">
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

            <div class="space-y-2">
                <h2 class="text-4xl font-bold text-white">
                    Sessions
                </h2>

                @livewire('tracker.location.historical-sessions-table', ['location' => $location])
            </div>
        </div>
    </div>
@endsection
