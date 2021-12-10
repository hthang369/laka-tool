@extends('layouts.master')

@section('title', $titlePage)

@section('content_layout')
    <!-- Sidebar-->
    <section id="section-sidebar" class="col-md-2 px-0">
        @include('components.system-admin.sidebar')
    </section>
    <!--      End  Sidebar-->
    <!-- Main content -->
    <div class="col-md-10">
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

