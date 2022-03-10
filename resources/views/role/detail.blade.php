@extends('components.system-admin.detail')

@section('message_content')
    @if(session()->has('saved'))
        <div class="alert alert-success">
            <strong>@lang('custom_message.saved')</strong>
        </div>
    @endif
@endsection

@section('body_content')
    @foreach (['level', 'name', 'role_rank', 'description'] as $key)

    <div class="form-row">
        {!! Form::label($key, __("role.fields.{$key}"), ['class' => 'col-2 font-weight-bold']) !!}
        {!! Form::label('', $data[$key], ['class' => 'col-10']) !!}
    </div>
    @endforeach

@endsection
