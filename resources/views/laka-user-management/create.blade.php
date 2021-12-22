@extends('components.system-admin.create')

@section('message_content')
@php
    $contactOptions = [
        'add_all_contacts' => ['label' => __('users.laka.add_all_contacts'), 'checked' => false],
        'add_to_all_rooms' => ['label' => __('users.laka.add_to_all_rooms'), 'checked' => false]
    ];
@endphp
@if (session('errors') || session('success'))
    <x-alert type="{{session()->get('errors') ? 'danger' : 'success'}}" dismissible="true">
        {{session()->get('message')}}
    </x-alert>
@endif
@endsection

@section('form_content')
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('users.fields.name')</x-form-label>
        <x-form-input type="text" name="name" groupClass="col-sm-10 form-row"
            placeholder="{{__('users.fields.name')}}" required autocomplete />
    </x-form-group>

    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('users.fields.email')</x-form-label>
        <x-form-input type="email" name="email" groupClass="col-sm-10 form-row"
            placeholder="{{__('users.fields.email')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('users.fields.password')</x-form-label>
        <x-form-input type="password" name="password" groupClass="col-sm-10 form-row"
            placeholder="{{__('users.fields.password')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label">@lang('users.fields.confirm_password')</x-form-label>
        <x-form-input type="password" name="password_confirmation" groupClass="col-sm-10 form-row"
            placeholder="{{__('users.fields.confirm_password')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label">@lang('users.laka.fields.company')</x-form-label>
        <x-form-select name="company_id" :items="$data['company_list']" placeholder=" " required
            groupClass="col-sm-10 form-row" />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label">@lang('users.laka.fields.type_of_user')</x-form-label>
        <div class="col-10 d-flex align-items-center">
            <x-form-checkbox name="is_user_bot" :label='__("users.laka.is_user_bot")' :custom="true"></x-form-checkbox>
        </div>
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('users.laka.add_contact_option')</x-form-label>
        <x-form-checkbox-group name="add_contact_option[]" class="col-10" :items="$contactOptions"></x-form-checkbox-group>
    </x-form-group>
@endsection
