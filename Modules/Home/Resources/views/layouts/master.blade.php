<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="referrer" content="strict-origin"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        @yield('styles_master')
       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/home.css') }}"> --}}

    </head>
    <body>
        @yield('content_master')

        @yield('scripts_master')
        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/home.js') }}"></script> --}}
    </body>
</html>
