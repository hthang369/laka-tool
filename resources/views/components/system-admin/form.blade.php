@extends('layouts.main-page')

@section('content')

    <div class="card-body px-0">
        @yield('message_content')

        @yield('body_content')

        @yield('body_button')
    </div>

    @yield('footer_page')
@endsection
