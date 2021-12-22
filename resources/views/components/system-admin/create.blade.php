@extends('components.system-admin.form')

@section('body_content')
    {!! Form::open(['route' => "{$sectionCode}.store", 'method' => 'POST']) !!}
        @yield('form_content')

        <div class="form-row align-items-center justify-content-center">
        {!! Form::submit(__('common.save'), ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::button(__('common.back'), ['class' => 'btn btn-danger btn-sm ml-2', 'onclick' => "history.back()"]) !!}
        </div>
    {!! Form::close() !!}
@endsection
