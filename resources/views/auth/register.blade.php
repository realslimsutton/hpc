@extends('layouts.base')

@section('body')
    <x-page.banner/>

    <div class="w-full max-w-3xl mx-auto px-6 py-13">
        @livewire('auth.register')
    </div>
@endsection
