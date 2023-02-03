@props([
    'announcements'
])

<x-member.card class="md:col-span-3">
    <h2 class="text-2xl font-medium">
        Announcements
    </h2>

    <div class="mt-8 divide-y divide-hpc-red-800">
        @foreach($announcements as $announcement)
            <x-member.dashboard.announcement :announcement="$announcement"/>
        @endforeach
    </div>
</x-member.card>
