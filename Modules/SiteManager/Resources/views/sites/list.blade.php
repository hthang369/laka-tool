@extends(layouts_path('common', 'main-page'))

@section('content')
    {!! $grid !!}
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('change', 'input[name=document_root]', function(e) {
            console.log(e)
        });

    });
</script>
@endpush
