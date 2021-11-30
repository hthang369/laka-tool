@extends('layouts.master')

@section('content_layout')
    <!-- Sidebar -->
{{--    <div class="col-lg-2 pr-0">--}}
{{--        @include('components.system-admin.menu')--}}
{{--    </div>--}}
    <!-- Main content -->
    <div class="col-lg-12 px-0">
        <div class="card px-3">
            @yield('content')
        </div>
    </div>
@endsection

