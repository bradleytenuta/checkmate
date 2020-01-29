<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Meta Data -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Checkmate') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- JS Files -->
        <script src="{{ URL::asset('js/app.js') }}" defer></script>

        <!-- CSS Files -->
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- The Dynamic Content -->
        @yield ('dynamic-master-content')
        @include('components.footer')
    </body>
</html>