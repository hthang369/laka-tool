@extends('components.system-admin.update')

@php
    request()->merge($data);
@endphp

@section('form_content')
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('role.level')</x-form-label>
        <x-form-input type="text" name="level" groupClass="col-sm-10 form-row" value="{{request('level')}}"
            placeholder="{{__('role.level')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.name')</x-form-label>
        <x-form-input type="text" name="name" groupClass="col-sm-10 form-row" value="{{request('name')}}"
            placeholder="{{__('common.name')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('role.role_rank')</x-form-label>
        <x-form-input type="text" name="role_rank" groupClass="col-sm-10 form-row" value="{{request('role_rank')}}"
            placeholder="{{__('role.role_rank')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label">@lang('common.description')</x-form-label>
        <x-form-textarea :rows="5" name="description" groupClass="col-sm-10 form-row" value="{{request('description')}}"
            placeholder="{{__('common.description')}}" autocomplete />
    </x-form-group>

@endsection
