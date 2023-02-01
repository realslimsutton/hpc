<x-filament::dropdown :attributes="$attributes">
    <x-slot:trigger>
        <span
            @class([
                'flex items-center justify-center gap-0.5 p-4 lg:p-0 text-white uppercase font-semibold transition-colors hover:text-hpc-gold focu:text-hpc-gold',
                '!text-hpc-gold' => in_array(Route::currentRouteName(), [
                    'promotions.loyalty-program',
                    'promotions.freeroll-tournaments',
                    'promotions.giveaways',
                    'promotions.first-deposit-bonus',
                    'promotions.referral-program'
                 ])
            ])
        >
            <span>
                Promotions
            </span>

            <span class="hidden lg:block">
                @svg('heroicon-s-chevron-down', 'h-6 w-6')
            </span>
        </span>
    </x-slot:trigger>

    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item tag="a" :href="route('promotions.loyalty-program')">
            Loyalty Program
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('promotions.freeroll-tournaments')">
            Freeroll Tournaments
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('promotions.giveaways')">
            Giveaways
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('promotions.first-deposit-bonus')">
            First Time Deposit Bonus
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item tag="a" :href="route('promotions.referral-program')">
            Referral Program
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>
