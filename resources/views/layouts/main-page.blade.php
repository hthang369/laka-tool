@extends('layouts.master')

@section('title', $titlePage)

@section('content_layout')
    <!-- Sidebar -->
    <div class="col-lg-2 pr-0">
        @include('components.system-admin.sidebar')
    </div>
    <!-- Main content -->
    <div class="col-lg-10 px-0">
        <div class="card px-3">
            <!-- TITLE -->
            @section('header_page')
                <h2 class="card-header px-0">
                    @lang($headerPage)
                </h2>
            @show

            <div class="card-body px-0">
                @yield('content')
            </div>

            @yield('footer_page')
        </div>
    </div>
@endsection

