<x-filament::dropdown :attributes="$attributes">
    <x-slot:trigger>
        <span class="flex items-center justify-center gap-0.5 p-4 lg:p-0 text-white uppercase font-semibold transition-colors hover:text-hpc-gold">
            <span>
                Promotions
            </span>

            <span class="hidden lg:block">
                @svg('heroicon-s-chevron-down', 'h-6 w-6')
            </span>
        </span>
    </x-slot:trigger>

    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item href="#">
            Loyalty Program
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item href="#">
            Freeroll Tournaments
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item href="#">
            Giveaways
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item href="#">
            First Time Deposit Bonus
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item href="#">
            Referral Program
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>
