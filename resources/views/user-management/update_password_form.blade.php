@extends('components.system-admin.form')

@section('body_content')
    {!! Form::open(['route' => ["{$sectionCode}.update-password", request('id')], 'method' => 'PUT']) !!}
    
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.current_password')</x-form-label>
        <x-form-input type="password" name="current_password" groupClass="col-sm-10 form-row" value="{{request('current_password')}}"
            placeholder="{{__('common.current_password')}}" required autocomplete />
    </x-form-group>

    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.new_password')</x-form-label>
        <x-form-input type="password" name="new_password" groupClass="col-sm-10 form-row" value="{{request('new_password')}}"
            placeholder="{{__('common.new_password')}}" required autocomplete />
    </x-form-group>

    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.current_password')</x-form-label>
        <x-form-input type="password" name="confirm_password" groupClass="col-sm-10 form-row" value="{{request('confirm_password')}}"
            placeholder="{{__('common.confirm_password')}}" required autocomplete />
    </x-form-group>

    <div class="form-row">
    {!! Form::submit(__('common.save'), ['class' => 'btn btn-primary btn-sm']) !!}
    {!! Form::button(__('common.back'), ['class' => 'btn btn-danger btn-sm ml-2', 'onclick' => "history.back()"]) !!}
    </div>
    {!! Form::close() !!}
@endsection