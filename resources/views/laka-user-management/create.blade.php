@extends('components.system-admin.create')

@section('message_content')
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
        {!! Form::label('',__('users.laka.fields.type_of_user'),['class' => 'col-2 col-form-label']) !!}
        <div class="col-10 d-flex align-items-center">
            <x-form-checkbox name="is_user_bot" :label='__("users.laka.is_user_bot")' :custom="true"></x-form-checkbox>
        </div>
    </x-form-group>
    <x-form-group :inline="true">
        {!! Form::label('', __('users.laka.add_contact_option'), ['class' => 'col-2 col-form-label required']) !!}
        <div class="col-10">
            @foreach (['add_all_contacts', 'add_to_all_rooms'] as $item)
            <x-form-checkbox name="add_contact_option[]" :value="$item" :label='trans("users.laka.{$item}")' :id="$item" groupClass="mr-2" :custom="true"></x-form-checkbox>
            @endforeach
        </div>

    </x-form-group>
@endsection
