<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="referrer" content="strict-origin"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laka Management - @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/system-admin.css') }}" />

    <!-- CSS -->
    @stack('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/sidebar/style.css') }}"/> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/navbar/style.css') }}"/> --}}
    <!-- Css Plugin Scrollbar   -->
    {{-- <link rel="stylesheet" href="{{asset('css/sidebar/jquery.mCustomScrollbar.css')}}"/> --}}
</head>
<body>
    <header>
        @include('components.system-admin.navbar')
    </header>
    <main id="main-container" class="container-fluid m-0 pl-0">
        <div class="row">
            @yield('content_layout')
        </div>
    </main>

    <!-- Toasts notification -->
    @include('components.system-admin.toasts')

    <!-- Dialog confirm delete -->
    <div class="modal fade" id="confirmDialogDelete" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
    </div>

    <!-- Footer -->
    @include('components.system-admin.footer')

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/grid.js') }}"></script>
    @stack('scripts')
</body>
</html>
