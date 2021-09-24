@extends('components.system-admin.detail')

@section('message_content')
    @if(session()->has('saved'))
        <div class="alert alert-success">
            <strong>@lang('custom_message.saved')</strong>
        </div>
    @endif
@endsection

@section('body_content')
    @foreach (['name', 'email', 'phone', 'address'] as $key)
    <div class="form-row">
        {!! Form::label($key, __("users.fields.{$key}"), ['class' => 'col-2 font-weight-bold']) !!}
        {!! Form::label($key, $data[$key], ['class' => 'col-10']) !!}
    </div>
    @endforeach
    <div class="form-row">
        {!! Form::label('role', 'Role', ['class' => 'col-2 font-weight-bold']) !!}
        <div class="col-10">
        @foreach($data['roles'] as $role)
            <x-badge type="primary" class="mr-2">{{$role}}</x-badge>
        @endforeach
        </div>
    </div>

@endsection
