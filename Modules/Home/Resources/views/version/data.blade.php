@extends(layouts_path('common', 'main-page'))

@section('content')
    <div class="card-body px-0">
        {!! $data['data'] !!}
    </div>
@endsection

