<div
    class="w-full relative"
    x-data="{expanded: false}"
>
    <div>
        <input
            type="text"
            class="w-full p-4 rounded-lg bg-hpc-red-700 border !border-hpc-red-800 text-white font-lg font-medium transition-colors focus:ring-0"
            placeholder="Search"
            wire:model.debounce.500ms="search"
            x-on:click.stop="expanded = true"
        />
    </div>

    @if($results !== null)
        <div
            class="absolute top-[90%] inset-x-0 max-h-60 shadow-md bg-hpc-red-700 border-l border-r border-b border-hpc-red-800 rounded-b-lg overflow-y-auto divide-y divide-hpc-red-800 hpc-scrollbar"
            x-show="expanded"
            x-on:click.away="expanded = false"
            x-cloak
            x-ref="resultsContainer"
            x-on:reset-scroll.window="$refs.resultsContainer.scrollTop = 0"
        >
            @forelse($results as $result)
                @php
                    $component = match(get_class($result)) {
                        \App\Models\Tracker\Player::class => 'tracker.search.player',
                        \App\Models\Tracker\Session::class => 'tracker.search.session',
                        \App\Models\Tracker\Location::class => 'tracker.search.location',
                        default => null
                    }
                @endphp

                @if($component !== null)
                    <x-dynamic-component :component="$component" :result="$result"/>
                @endif
            @empty
                <div class="w-full py-4 px-6 h-20 flex items-center justify-center font-medium text-lg">
                    No results found
                </div>
            @endforelse

            @if($results->isNotEmpty())
                <div class="flex items-center justify-between flex-wrap px-6 py-2">
                    <div>
                        @if($this->currentPage > 1)
                            <x-tracker.search.button target="previousPage">
                                Previous
                            </x-tracker.search.button>
                        @endif
                    </div>

                    <div class="text-sm text-gray-400">
                        Page {{ $this->currentPage }}
                    </div>

                    <div>
                        @if($results->hasMorePages())
                            <x-tracker.search.button target="nextPage">
                                Next
                            </x-tracker.search.button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
