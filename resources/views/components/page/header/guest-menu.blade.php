<x-filament::dropdown placement="bottom-end">
    <x-slot:trigger>
        <span class="text-white uppercase font-semibold transition-colors hover:text-hpc-gold">
            {{ $slot }}
        </span>
    </x-slot:trigger>

    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item
            icon="heroicon-o-login"
            :href="route('auth.login')"
        >
            Login
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item
            icon="heroicon-o-user-add"
            :href="route('auth.register')"
        >
            Register
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>
