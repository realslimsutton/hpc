@props([
    'sessions'
])

<div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
    @foreach($sessions as $session)
        <x-tracker.session.rankings :session="$session"/>
    @endforeach
</div>
