<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="referrer" content="strict-origin"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laka Management - @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/system-admin.css') }}" /> --}}

    <!-- CSS -->
    @stack('styles')
</head>
<body>

<div id="page-container">
    <!-- Navbar -->
    @include('components.system-admin.navbar')

    <!-- Dialog confirm delete -->
    <div class="modal fade" id="confirmDialogDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    </div>

    <!-- Toasts notification -->
    @include('components.system-admin.toasts')

    <div id="main-container" class="container-fluid m-0 pl-0">
        <div class="row">
            @yield('content_layout')
        </div>
    </div>

    <!-- Footer -->
    @include('components.system-admin.footer')

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/grid.js') }}"></script>
    @stack('scripts')

</div>

</body>
</html>
