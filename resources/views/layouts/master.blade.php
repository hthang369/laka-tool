<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="referrer" content="strict-origin"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laka Management - @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Css Plugin Scrollbar   -->
    <link rel="stylesheet" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/system-admin.css') }}" />
    <!-- CSS -->
    @stack('styles')

</head>
<body>
    <header>
        @include('components.system-admin.navbar')
    </header>
    <main id="main-container" class="container-fluid navbar-expand-lg">
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

    <!-- Back to top -->
    @include('components.system-admin.back_to_top')

    <!-- Footer -->
    @include('components.system-admin.footer')

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/data-grid.js') }}"></script>
    @stack('scripts')
</body>
</html>
