<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @stack('head.start')

        <title>{{ config('app.name') }}</title>

        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset_version('apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset_version('apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset_version('apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset_version('apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset_version('apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset_version('apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset_version('apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset_version('apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset_version('apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset_version('android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset_version('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset_version('favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset_version('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset_version('manifest.json') }}">
        <meta name="msapplication-TileColor" content="#5A0410">
        <meta name="msapplication-TileImage" content="{{ asset_version('ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#5A0410">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap"
            rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('head.end')
    </head>
    <body class="antialiased">
        @stack('body.start')

        <x-page.header/>

        @yield('body')

        <x-page.footer/>

        @stack('body.end')
    </body>
</html>
