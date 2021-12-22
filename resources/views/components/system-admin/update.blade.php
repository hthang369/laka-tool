@extends('components.system-admin.form')

@section('body_content')
    {!! Form::open(['route' => ["{$sectionCode}.update", request('id')], 'method' => 'PUT']) !!}
        @yield('form_content')

        <div class="form-row d-flex justify-content-center">
        {!! Form::submit(__('common.save'), ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::button(__('common.back'), ['class' => 'btn btn-danger btn-sm ml-2', 'onclick' => "history.back()"]) !!}
        </div>
    {!! Form::close() !!}
@endsection
