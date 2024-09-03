@extends(layouts_path('common', 'main-page'))

@section('content')
    {!! $grid !!}
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        ServiceInstance.init();
    });
</script>
@endpush
