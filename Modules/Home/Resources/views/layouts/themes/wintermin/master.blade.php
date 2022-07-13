@extends('home::layouts.master')

@section('title', "Laka Management - {$titlePage}")

@section('styles_master')
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link rel="stylesheet" href="{{asset('css/wintermin.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Css Plugin Scrollbar   -->
    <link rel="stylesheet" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}"/>
    <!-- CSS -->
    @stack('styles')
@endsection

@section('content_master')
    <!-- Header navigaton -->
    @include(layouts_path('home', 'partial.navigation'))

    <div class="wrapper container-fluid">
        <!-- Main section -->
        @yield('content_layout')
    </div>

    <!-- Toasts notification -->
    @include(layouts_path('home', 'partial.toasts'))

    <!-- Back to top -->
    @include(layouts_path('home', 'partial.back_to_top'))

@endsection

@section('scripts_master')
    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/data-grid.js') }}"></script>
    @stack('scripts')
@endsection
