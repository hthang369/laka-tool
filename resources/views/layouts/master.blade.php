<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="referrer" content="strict-origin"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laka Management - @yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>
    <!-- pjax js (required) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
    <script src="{{ asset('js/grid.js') }}"></script>
    <script src="{{ asset('js/jquery.fileDownload.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- FONT AWESOME -->
    {{--    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">--}}
    {{--    <link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/3.2.1/assets/font-awesome/css/font-awesome.css">--}}
    <link rel="stylesheet" href="{{ asset('css/system-admin.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/sidebar/style.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Css Plugin Scrollbar   -->
    <link rel="stylesheet" href="{{asset('css/sidebar/jquery.mCustomScrollbar.css')}}" />
    <!-- CSS -->
    @yield('style-css')

</head>
<body>
<header>
    @include('components.system-admin.navbar')
</header>
<aside>
    <div class="wrapper d-flex align-items-stretch">

        <!-- Sidebar-->
        <section id="section-sidebar">
            @include('components.system-admin.sidebar')
        </section>
        <!--      End  Sidebar-->

        <section id="content" class="content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content_layout')
                </div>
            </div>
        </section>

    </div>

</aside>

<!-- Toasts notification -->
@include('components.system-admin.toasts')
<!-- Dialog confirm delete -->
<div class="modal fade" id="confirmDialogDelete" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
</div>
<!-- Footer -->
@include('components.system-admin.footer')

<!-- Script -->
@stack('scripts')
@stack('styles')
</body>
</html>
