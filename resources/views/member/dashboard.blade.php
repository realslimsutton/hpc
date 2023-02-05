@extends('layouts.member')

@section('banner.title', 'Member Dashboard')

@section('page-content')
    <x-member.dashboard.announcements :announcements="$announcements"/>

    <div class="grid lg:grid-cols-3 gap-8">
        <x-member.dashboard.widgets.balance :user="$user"/>

        <x-member.dashboard.widgets.total-deposits/>

        <x-member.dashboard.widgets.total-withdrawals/>
    </div>
@endsection
