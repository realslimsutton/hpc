@props([
    'icon'
])

<div class="flex flex-col sm:flex-row text-center sm:text-left items-center justify-center gap-6">
    <div>
        <div
            class="inline-flex items-center justify-center p-4 shadow-[-2px_0_20px_var(--tw-shadow-color)] shadow-hpc-gold rounded-full border-2 border-hpc-gold"
        >
            @svg($icon, 'h-12 w-12 text-hpc-gold')
        </div>
    </div>

    <div>
        <h3 class="text-3xl font-semibold">
            {{ $title }}
        </h3>

        <div class="space-y-4">
            {{ $slot }}
        </div>
    </div>
</div>
