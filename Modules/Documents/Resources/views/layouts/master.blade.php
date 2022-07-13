<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laka Management Docs</title>

       {{-- Laravel Mix - CSS File --}}
       <link rel="stylesheet" href="{{asset('css/app.css')}}" />

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">@include('documents::layouts.partial.slidebar')</div>
                <div class="col-md-9">@yield('content')</div>
            </div>
        </div>
        {{-- Laravel Mix - JS File --}}
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
