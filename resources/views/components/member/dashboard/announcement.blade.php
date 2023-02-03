@props([
    'announcement'
])

<div class="members-announcement" x-data="{collapsed: true}">
    <button x-on:click.prevent="collapsed = !collapsed" class="flex items-center gap-4 p-4">
        <span class="text-center">
            {{ $announcement->published_at?->format('M j, Y') }}
        </span>

        <span class="text-ellipsis overflow-hidden text-left">
            {{ $announcement->title }}
        </span>
    </button>

    @if(filled($announcement->body))
        <div
            x-show="!collapsed"
            x-collapse
            x-cloak
        >
            <div class="px-8">
                {!! Str::markdown($announcement->body) !!}
            </div>
        </div>
    @endif
</div>
