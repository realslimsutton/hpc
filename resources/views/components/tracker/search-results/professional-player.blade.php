@props([
    'result'
])

<a
    href="#"
    class="w-full py-4 px-6 h-20 flex items-center gap-4"
>
    @if($result->featured_image !== null)
        <div>
            <x-curator-glider :media="$result->featured_image" class="h-16 w-auto rounded-full"/>
        </div>
    @endif

    <div>
        <h3 class="font-medium text-lg">
            {{ $result->name }}
        </h3>

        <p class="text-hpc-gold text-sm font-medium">
            Professional player
        </p>
    </div>
</a>
