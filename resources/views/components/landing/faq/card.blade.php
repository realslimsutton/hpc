@props([
    'id'
])

<div
    class="text-white w-full"
>
    <button
        class="w-full bg-hpc-red rounded-md p-4 flex items-center justify-between"
        x-bind:class="expanded === {{ $id }} ? 'rounded-b-none' : ''"
        x-on:click.prevent="expanded = expanded === {{ $id }} ? -1 : {{ $id }}"
    >
        <h4 class="font-medium text-left">
            {{ $title }}
        </h4>

        <span
            x-show="expanded !== {{ $id }}"
        >
            @svg('heroicon-s-plus-sm', 'h-6 w-6')
        </span>

        <span
            x-show="expanded === {{ $id }}"
            x-cloak
        >
            @svg('heroicon-s-minus-sm', 'h-6 w-6')
        </span>
    </button>

    <div
        x-show="expanded === {{ $id }}"
        x-collapse
        x-cloak
    >
        <div class="border border-hpc-red p-4 text-left">
            {{ $slot }}
        </div>
    </div>
</div>
