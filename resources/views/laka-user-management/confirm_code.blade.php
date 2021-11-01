@extends('components.system-admin.form')

@section('message_content')
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
        {!! Form::submit(__('common.submit_verification_code'), ['class' => 'btn btn-danger btn-sm mr-3']) !!}
        {!! link_to(route("{$sectionCode}.disable-user",[ $data['id'],'type'=>'resent']), __('common.resend'), ['class' => 'btn btn-sm btn-warning'] )!!}

    </div>
    {!! Form::close() !!}

@endsection
