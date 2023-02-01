@props([
    'locations',
    'rankings'
])

<div class="w-full max-w-screen-2xl mx-auto grid lg:grid-cols-3 gap-6">
    @foreach($locations as $location)
        <x-tracker.location.rankings :location="$location" :rankings="$rankings[$location->id]"/>
    @endforeach
</div>
