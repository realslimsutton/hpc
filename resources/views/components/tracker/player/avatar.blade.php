@props([
    'player'
])

<div>
    @if($player->featured_image !== null)
        <x-curator-glider :media="$player->featured_image" class="h-32 w-32 rounded-full"/>
    @else
        <img
            src="https://ui-avatars.com/api/?name={{ urlencode($player->name) }}&color=FFCD67&background=5A0410"
            class="h-32 w-32 rounded-full"
            alt="{{ $player->name }}"
        />
    @endif
</div>
