@extends(layouts_path('home', 'master'))

@section('content_layout')
<!-- Main content -->
<div class="col px-0">
    <div class="card px-3">
        @yield('content')
    </div>
</div>
@endsection
