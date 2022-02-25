@extends('layouts.master')

@section('title', $titlePage)

@section('content_layout')
    <!-- Sidebar-->
    <section class="collapse navbar-sidebar navbar-collapse col-lg-2 col-md-3 px-0" id="navbarNavDropdown">
        <div id="section-sidebar">
            @include('components.system-admin.sidebar')
        </div>
    </section>

    <!--      End  Sidebar-->
    <!-- Main content -->
    <div class="main-content col-12 col-lg-10 col-md-9">
        <div class="card">
            @section('header_page')
            <!-- TITLE -->
            <h2 class="card-header px-4 bg-light">
                @lang($headerPage)
            </h2>
            <!-- End title-->
            @show

            <!-- Content -->
            <div class="px-4">
                @yield('content')
            </div>
            <!-- End content -->
        </div>
    </div>
@endsection

