<div class="flex flex-col items-center justify-center p-4 gap-4">
    <img
        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->full_name) }}&color=171717&background=FFCD67&bold=true"
        alt="{{ auth()->user()->full_name }}"
        class="w-20 h-auto rounded-full"
    />

    <div class="space-y-1">
        <h2 class="text-2xl font-medium text-center">
            {{ auth()->user()->full_name }}
        </h2>

        <h4 class="text-hpc-gold text-sm font-medium text-center">
            Joined {{ auth()->user()->created_at?->format('M j, Y') }}
        </h4>
    </div>
</div>
