@extends('layouts.base')

@section('body')
    <x-page.banner>
        Member Login
    </x-page.banner>

    <div class="w-full max-w-md mx-auto px-4 py-13">
        @livewire('auth.login')
    </div>
@endsection
