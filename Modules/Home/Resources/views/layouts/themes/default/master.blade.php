@extends('home::layouts.master')

@section('title', "Laka Management - {$titlePage}")

@section('styles_master')
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Css Plugin Scrollbar   -->
    <link rel="stylesheet" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/system-admin.css') }}" />
    <!-- CSS -->
    @stack('styles')
@endsection

@section('content_master')
    <header>
        @include(layouts_path('home', 'partial.navbar'))
    </header>
    <main id="main-container" class="container-fluid navbar-expand-lg">
        <div class="row">
            @yield('content_layout')
        </div>
    </main>

    <!-- Toasts notification -->
    @include(layouts_path('home', 'partial.toasts'))

    <!-- Dialog confirm delete -->
    <div class="modal fade" id="confirmDialogDelete" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
    </div>

    <!-- Back to top -->
    @include(layouts_path('home', 'partial.back_to_top'))

    <!-- Footer -->
    @include(layouts_path('home', 'partial.footer'))
@endsection

@section('scripts_master')
    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/data-grid.js') }}"></script>
    @stack('scripts')
@endsection
