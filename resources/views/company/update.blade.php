@extends('components.system-admin.update')

@php
    request()->merge($data);
@endphp

@section('message_content')
    @if (count($data['listBusinessPlan']) == 0)
        <x-alert type="warning">
            <strong>@lang('business_plan.alert_no_business_plan')</strong>
        </x-alert>
        {!! link_to(route('business-plan.create'),
            '+' . __('common.add_new') .' '. __('business_plan.business_plan'),
            ['class' => 'my-2 btn btn-sm btn-primary']) !!}
    @endif
@endsection

@section('form_content')
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.name')</x-form-label>
        <x-form-input type="text" name="name" groupClass="col-sm-10 form-row" value="{{request('name')}}"
            placeholder="{{__('common.name')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.email')</x-form-label>
        <x-form-input type="email" name="email" groupClass="col-sm-10 form-row" value="{{request('email')}}"
            placeholder="{{__('common.email')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label">@lang('common.phone')</x-form-label>
        <x-form-input type="text" name="phone" groupClass="col-sm-10 form-row" value="{{request('phone')}}"
            placeholder="{{__('common.phone')}}" autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label">@lang('common.address')</x-form-label>
        <x-form-textarea name="address" groupClass="col-sm-10 form-row" :rows="5" value="{{request('address')}}"
            placeholder="{{__('common.address')}}" autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('business_plan.business_plan')</x-form-label>
        <x-form-select name="business_plan_id" required :items="array_pluck($data['listBusinessPlan'], 'name', 'id')" placeholder=" "
            groupClass="col-sm-10 form-row" selected="{{request('business_plan_id')}}" />
    </x-form-group>

@endsection
