@extends('layouts.base')

@push('head.start')
    @once
        <meta name="robots" content="noindex">
    @endonce
@endpush

@section('body')
    <x-page.banner>
        @yield('banner.title')
    </x-page.banner>

    <div
        class="w-full max-w-screen-2xl mx-auto grid md:grid-cols-4 gap-8 px-6 my-20 mt-0 md:mt-20 py-12 text-white"
    >
        <div class="col-span-1">
            <x-member.left-sidebar />
        </div>

        <div class="md:col-span-3 space-y-8">
            @yield('page-content')
        </div>
    </div>
@endsection
