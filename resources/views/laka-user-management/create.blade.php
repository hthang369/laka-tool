@extends('components.system-admin.create')

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
        <x-form-input type="password" name="confirm_password" groupClass="col-sm-10 form-row"
            placeholder="{{__('users.fields.confirm_password')}}" autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label">@lang('users.laka.fields.company')</x-form-label>
        <x-form-select name="company_id" :items="$data['company_list']" placeholder=" "
            groupClass="col-sm-10 form-row" />
    </x-form-group>
    <div class="form-group row align-items-center">
        {!! Form::label('',__('users.laka.fields.type_of_user'),['class' => 'col-2 col-form-label']) !!}
        <div class="col-10">
            <div class="custom-control custom-checkbox">
                {!! Form::checkbox('is_user_bot',1,(bool)$value,['class'=>'custom-control-input','id'=>'is_user_bot']) !!}
                {!! Form::label('is_user_bot', __("users.laka.is_user_bot"), ['class' => 'custom-control-label']) !!}
            </div>
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('', __('users.laka.add_contact_option'), ['class' => 'col-2 col-form-label required']) !!}
        <div class="col-10">
            @foreach (['add_all_contacts', 'add_to_all_rooms'] as $item)
            <div class="custom-control custom-checkbox mr-2">
                {!! Form::checkbox($item, 1, (bool)$value, ['class' => "custom-control-input $has_option_class", 'id' => $item]) !!}
                {!! Form::label($item, __("users.laka.$item"), ['class' => 'custom-control-label']) !!}
            </div>
            @endforeach
        </div>
    </div>
@endsection
