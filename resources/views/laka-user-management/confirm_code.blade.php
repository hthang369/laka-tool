@extends('components.system-admin.form')

@section('message_content')
    @if (session('isAlert') || session('errors'))
        <x-alert type="{{session()->get('errors') ? 'danger' : 'success'}}" dismissible="true">
            {{session('message') ?? $message}}
        </x-alert>
    @endif
@endsection
@section('body_content')

    @foreach (['name', 'email'] as $key)
        <div class="form-group row">
            {!! Form::label($key, __("users.laka.fields.{$key}"), ['class' => 'col-3 col-form-label font-weight-bold']) !!}
            {!! Form::label($key, $data[$key], ['class' => 'col-9 col-form-label']) !!}
        </div>
    @endforeach
    {!! Form::open(['method' => 'POST']) !!}
    <div class="form-group row">
        {!! Form::label($key, __("users.laka.label_confirm_code"), ['class' => 'col-3 col-form-label font-weight-bold required']) !!}
        <div class="col-6 ">
            {!! Form::text('code',null,['class' =>'form-control required','placeholder'=>'Check email and fill code here','required']) !!}
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {!! Form::btSubmit(__('common.submit_verification_code'), 'success', ['class' => 'btn-sm mr-2', 'icon' => 'far fa-check','onclick'=>"return window.confirm('Are you sure submit verification code?')"]) !!}
        {!! bt_link_to_route("{$sectionCode}.disable-user", __('common.resend'), 'warning', [ $data['id'],'type'=>'resent'], ['class' => 'btn-sm mr-2', 'icon' => "fa fa-redo",'onclick'=>"return confirm('Are you want resend verification code?')"]);!!}
        {!! bt_link_to_route("{$sectionCode}.index", __('common.back'), 'danger', [], ['class' => 'btn-sm', 'icon' => 'fa-undo']) !!}

    </div>
    {!! Form::close() !!}

@endsection
