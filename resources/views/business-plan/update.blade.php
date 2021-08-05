@extends('components.system-admin.update')

@php
    request()->merge($data);
@endphp

@section('form_content')
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('custom_label.name')</x-form-label>
        <x-form-input type="text" name="name" groupClass="col-sm-10 form-row" value="{{request('name')}}"
            placeholder="{{__('custom_label.name')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('custom_label.maximum_storage_file')</x-form-label>
        <x-form-input type="text" name="maximum_storage_file" groupClass="col-sm-10 form-row" value="{{request('maximum_storage_file')}}"
            placeholder="{{__('custom_label.maximum_storage_file')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label">@lang('custom_label.description')</x-form-label>
        <x-form-textarea name="description" groupClass="col-sm-10 form-row" :rows="5" value="{{request('description')}}"
            placeholder="{{__('custom_label.description')}}" autocomplete />
    </x-form-group>

@endsection
