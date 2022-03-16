@extends('components.system-admin.form')

@section('body_content')
    {!! Form::open(['route' => ["{$sectionCode}.update-password", request('id')], 'method' => 'PUT']) !!}

    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.current_password')</x-form-label>
        <x-form-input type="password" name="current_password" groupClass="col-sm-10 form-row"
                      value="{{request('current_password')}}"
                      placeholder="{{__('common.current_password')}}" required autocomplete/>
    </x-form-group>

    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.new_password')</x-form-label>
        <x-form-input type="password" name="new_password" groupClass="col-sm-10 form-row"
                      value="{{request('new_password')}}"
                      placeholder="{{__('common.new_password')}}" required autocomplete/>
    </x-form-group>

    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.confirm_password')</x-form-label>
        <x-form-input type="password" name="confirm_password" groupClass="col-sm-10 form-row"
                      value="{{request('confirm_password')}}"
                      placeholder="{{__('common.confirm_password')}}" required autocomplete/>
    </x-form-group>

    <div class="form-row d-flex justify-content-center">
        {!! Form::btSubmit(__('common.save'), 'primary', ['class' => 'btn-sm mr-2', 'icon' => "fa-save"]) !!}
        {!! bt_link_to_route("{$sectionCode}.index", __('common.back'), 'danger', [], ['class' => 'btn-sm', 'icon' => 'fa-undo']) !!}
    </div>
    {!! Form::close() !!}
@endsection
