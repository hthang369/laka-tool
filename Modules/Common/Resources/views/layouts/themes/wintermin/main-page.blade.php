@extends(layouts_path('common', 'master'))

@section('content_layout')
    <div class="row navbar-expand-lg">
        <!-- Aside section -->
        @include(layouts_path('common', 'partial.slidebar'))

        <!-- Content section -->
        <div class="main-content col-12 col-lg-10 col-md-9 px-0 d-flex flex-column">
            <x-card no-body class="w-100">
                <x-card-header>
                    <div class="d-flex align-items-center justify-content-between">
                        <span>@lang($headerPage)</span>
                        <small>@include(layouts_path('common', 'partial.breadcrumb'))</small>
                    </div>
                </x-card-header>
                <x-card-body>
                    @yield('content')
                </x-card-body>
            </x-card>

            @include(layouts_path('common', 'partial.footer'))
        </div>
    </div>
    @include('common::layouts.template.loading')
@endsection
