@extends(layouts_path('home', 'main-page'))

@section('content')
<x-card header="Deploy enviroment: {{ ucfirst(data_get($data, 'modal.model.environment')) }}">
{!! Form::open(['url' => data_get($data, 'modal.route'), 'id' => 'frm-deploy']) !!}
{!! $data['form'] !!}
{!! Form::hidden('environment', data_get($data, 'modal.model.environment')) !!}
{!! Form::close() !!}
</x-card>
@endsection

@push('scripts')
<script>
    let list_server = @json(data_get($data, 'modal.model.serverArray'))

    $('select[name=server]').change(function() {
        $('div[name=version] span').html(list_server[$(this).val()].version)
    });
    $('.btn-deploy').click(function() {
        let data = JSON.stringify($('#frm-deploy').serializeObject())
        $api.post("{{data_get($data, 'modal.route')}}", data, {
            'targetLoading': '.btn-deploy',
            'pjaxContainer': '#frm-deploy',
            'contentType': 'application/json'
        });
    })
</script>
@endpush
