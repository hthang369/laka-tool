@extends('layouts.master')

@section('content_layout')
    <!-- Main content -->
    <div class="col-lg-12 px-0">
        <div class="card">
            <!-- TITLE -->
            <h2 class="card-header px-4 bg-light">
                @lang($headerPage)
            </h2>
            <!-- End title-->

            <!-- Content -->
            <div class="px-4">
                @yield('content')
            </div>
            <!-- End content -->
        </div>
    </div>
@endsection

