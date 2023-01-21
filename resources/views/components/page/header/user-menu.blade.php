<x-filament::dropdown placement="bottom-end">
    <x-slot:trigger>
        <span class="text-white uppercase font-semibold transition-colors hover:text-hpc-gold">
            {{ $slot }}
        </span>
    </x-slot:trigger>

    <x-filament::dropdown.header
        color="secondary"
        icon="heroicon-o-user-circle"
        tag="div"
    >
        {{ auth()->user()->name }}
    </x-filament::dropdown.header>

    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item
            icon="heroicon-o-view-grid"
            href="#"
        >
            Dashboard
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item
            icon="heroicon-o-cog"
            color="secondary"
            href="#"
        >
            Account settings
        </x-filament::dropdown.list.item>

        <x-filament::dropdown.list.item
            color="danger"
            icon="heroicon-o-logout"
            :action="route('filament.auth.logout')"
            method="post"
            tag="form"
        >
            Logout
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>
