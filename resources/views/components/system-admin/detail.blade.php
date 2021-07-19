@extends('layouts.system-admin')

@section('title', $titlePage)

@section('content')
    <!-- TITLE -->
    @section('header_page')
        <h2 class="card-header px-0">
            @lang($headerPage)
        </h2>
    @show

    <div class="card-body px-0">
        @yield('message_content')

        @yield('body_content')
    </div>

    @yield('footer_page')
@endsection
