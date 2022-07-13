@extends('documents::layouts.master')

@section('content')
    <div class="">
        <header>
            <h2>{{ $data['name'] }}</h2>
            <span>{{ $data['summary'] }}</span>
        </header>

        @yield('content_components')

        {!! $grid !!}
    </div>
@endsection
