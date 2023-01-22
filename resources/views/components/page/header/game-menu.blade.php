<x-filament::dropdown :attributes="$attributes">
    <x-slot:trigger>
        <span
            @class([
                'flex items-center justify-center gap-0.5 p-4 lg:p-0 text-white uppercase font-semibold transition-colors hover:text-hpc-gold focu:text-hpc-gold',
                '!text-hpc-gold' => in_array(Route::currentRouteName(), [
                    'games.no-limit-holdem',
                    'games.pot-limit-omaha',
                    'games.hand-rankings',
                    'games.tournaments',
                    'games.payout-structure'
                 ])
            ])
        >
            <span>
                Games
            </span>

            <span class="hidden lg:block">
                @svg('heroicon-s-chevron-down', 'h-6 w-6')
            </span>
        </span>
    </x-slot:trigger>

    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item tag="a" :href="route('games.no-limit-holdem')">
            No Limit Holdem
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('games.pot-limit-omaha')">
            Pot Limit Omaha
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('games.hand-rankings')">
            Hand Rankings
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('games.tournaments')">
            Tournaments
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('games.payout-structure')">
            Payout Structure
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>
