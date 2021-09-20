@extends('components.system-admin.create')

@section('message_content')
    @if ($data['listBusinessPlan']->count() == 0)
        <x-alert type="warning">
            <strong>@lang('custom_message.alert_no_business_plan')</strong>
        </x-alert>
        {!! link_to(route('business-plan.create'),
            '+' . __('common.add_new') .' '. __('custom_title.business_plan'),
            ['class' => 'my-2 btn btn-sm btn-primary']) !!}
    @endif
@endsection

@section('form_content')
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.name')</x-form-label>
        <x-form-input type="text" name="name" groupClass="col-sm-10 form-row" 
            placeholder="{{__('common.name')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.email')</x-form-label>
        <x-form-input type="email" name="email" groupClass="col-sm-10 form-row" 
            placeholder="{{__('common.email')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.phone')</x-form-label>
        <x-form-input type="text" name="phone" groupClass="col-sm-10 form-row"
            placeholder="{{__('common.phone')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.address')</x-form-label>
        <x-form-textarea name="address" groupClass="col-sm-10 form-row" :rows="5"
            placeholder="{{__('common.address')}}" required autocomplete />
    </x-form-group>
    <x-form-group :inline="true">
        <x-form-label class="col-sm-2 col-form-label required">@lang('common.business_plan')</x-form-label>
        <x-form-select name="business_plan_id" :items="$data['listBusinessPlan']->pluck('name', 'id')" placeholder=" "
            groupClass="col-sm-10 form-row" />
    </x-form-group>

@endsection
