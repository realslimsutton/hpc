<x-filament::dropdown :attributes="$attributes">
    <x-slot:trigger>
        <span class="flex items-center justify-center gap-0.5 p-4 lg:p-0 text-white uppercase font-semibold transition-colors hover:text-hpc-gold">
            <span>
                Games
            </span>

            <span class="hidden lg:block">
                @svg('heroicon-s-chevron-down', 'h-6 w-6')
            </span>
        </span>
    </x-slot:trigger>

    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item href="#">
            No Limit Holdem
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item href="#">
            Pot Limit Omaha
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item href="#">
            Hand Rankings
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item href="#">
            Tournaments
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item href="#">
            Payout Structure
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>
