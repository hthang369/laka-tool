@extends('components.system-admin.form')

@section('body_content')
    {!! Form::open(['route' => ["{$sectionCode}.update", request('id')], 'method' => 'PUT']) !!}
        @yield('form_content')

        <div class="form-row d-flex justify-content-center">
        {!! Form::btSubmit(__('common.save'), 'primary', ['class' => 'btn-sm', 'icon' => 'fa-save']) !!}
        {!! bt_link_to_route("{$sectionCode}.index", __('common.back'), 'danger', [], ['class' => 'btn-sm ml-2', 'icon' => 'fa-undo']) !!}
        </div>
    {!! Form::close() !!}
@endsection
