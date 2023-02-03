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
        {{ auth()->user()->full_name }}
    </x-filament::dropdown.header>

    <x-filament::dropdown.list>
        @can('page_Dashboard')
            <x-filament::dropdown.list.item
                icon="heroicon-o-shield-check"
                color="success"
                tag="a"
                :href="Filament\Facades\Filament::getUrl()"
                target="_blank"
            >
                Admin panel
            </x-filament::dropdown.list.item>
        @endcan

        <x-filament::dropdown.list.item
            icon="heroicon-o-view-grid"
            tag="a"
            href="{{ route('member.dashboard') }}"
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
