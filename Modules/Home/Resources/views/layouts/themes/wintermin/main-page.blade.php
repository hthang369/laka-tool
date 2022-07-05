@extends(layouts_path('home', 'master'))

@section('content_layout')
    <div class="row navbar-expand-lg">
        <!-- Aside section -->
        @include(layouts_path('home', 'partial.slidebar'))

        <!-- Content section -->
        <div class="main-content col-12 col-lg-10 col-md-9 px-0 d-flex flex-column">
            <x-card no-body class="w-100">
                <x-card-header>
                    <div class="d-flex align-items-center justify-content-between">
                        <span>@lang($headerPage)</span>
                        <small>@include(layouts_path('home', 'partial.breadcrumb'))</small>
                    </div>
                </x-card-header>
                <x-card-body>
                    @yield('content')
                </x-card-body>
            </x-card>

            @include(layouts_path('home', 'partial.footer'))
        </div>

        @include(Modal::containerView())
    </div>
@endsection
