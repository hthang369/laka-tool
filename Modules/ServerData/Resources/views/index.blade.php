@extends('serverdata::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('serverdata.name') !!}
    </p>
@endsection
