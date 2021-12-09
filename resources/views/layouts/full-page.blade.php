@extends('layouts.master')

@section('title', $titlePage)

@section('content_layout')
<!-- Main content -->
<div class="col px-0">
    <div class="card px-3">
        @yield('content')
    </div>
</div>
@endsection
