@props([
    'user' => $user
])

<x-member.card>
    <div class="flex flex-col justify-center gap-2">
        <h4 class="text-lg font-medium">
            ClubGG Balance
        </h4>

        <h3 class="text-4xl font-semibold">
            {{ \Akaunting\Money\Money::USD($user->balance) }}
        </h3>
    </div>
</x-member.card>
