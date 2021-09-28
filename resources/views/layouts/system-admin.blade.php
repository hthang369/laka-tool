@extends('layouts.master')

@section('content_layout')
    <!-- Sidebar -->
    <div class="col-lg-2 pr-0">
        @include('components.system-admin.sidebar')
    </div>
    <!-- Main content -->
    <div class="col-lg-10 px-0">
        <div class="card px-3">
            @if (session('messCommon'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('messCommon') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('errorCommon'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('errorCommon') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
@endsection

