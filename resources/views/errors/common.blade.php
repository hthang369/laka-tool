@extends(layouts_path('home', 'full-page'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/error-page.css') }}"/>
@endpush

@section('content')
    <div class="notfound d-flex justify-content-center">
        <div class="notfound-bg text-center w-50">
            <h1>Oops!</h1>
            <h2 class="text-danger">{{data_get($data,'status.code')}} - {{data_get($data,'status.name')}}</h2>
            <p class="content">{{$message}}</p>
            <p class="go-back">
                {!! link_to_route('version.index', __('common.go_to_home'), [], ['class' => 'btn btn-danger btn-md']) !!}
            </p>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    (function($) {
        _grids.init();
    })(jQuery);
</script>
@endpush
