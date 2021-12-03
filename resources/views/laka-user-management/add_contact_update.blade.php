@extends('components.system-admin.form')

@section('message_content')
    @php
        // dd(session('errors'));
        $session_error = session('errors');
        if (!is_null($session_error) && is_object($session_error)){
            $errors = $session_error->toArray();
        };
        $contactOptions = [
            'add_all_contacts' => ['label' => __('users.laka.add_all_contacts'), 'checked' => false],
            'add_to_all_rooms' => ['label' => __('users.laka.add_to_all_rooms'), 'checked' => false]
        ];
    @endphp
    <!-- Show notification when redirect action-->
    @if (session('errors') || session('success'))
        <x-alert type="{{session()->get('errors') ? 'danger' : 'success'}}" dismissible="true">
            {{ is_string(session('errors')) ? session('errors') : session('message')}}
        </x-alert>
    @endif
@endsection
<!--    End show notification-->
@section('body_content')
    @foreach (['name', 'email', 'company','type_of_user'] as $key)
        <div class="form-group row">
            {!! Form::label($key, __("users.laka.fields.{$key}"), ['class' => 'col-2 font-weight-bold']) !!}
            {!! Form::label($key, $data[$key], ['class' => 'col-10']) !!}
        </div>
    @endforeach
@endsection

@section('body_button')
    <div class="form-group-update mt-4">
        {!! Form::open(['method' => 'POST']) !!}
        <x-form-group :inline="true">
            <x-form-label class="col-sm-2 col-form-label required">@lang('users.laka.fields.company')</x-form-label>
            <x-form-select name="company_id" :items="$data['company_list']" :selected="$data['company_id']" placeholder=" " required
                groupClass="col-sm-10 form-row" />
        </x-form-group>
        <x-form-group :inline="true">
            <x-form-label class="col-sm-2 col-form-label required">@lang('users.laka.add_contact_option')</x-form-label>
            <x-form-checkbox-group name="add_contact_option[]" class="col-10" :items="$contactOptions"></x-form-checkbox-group>
        </x-form-group>
        <button type="submit" class="btn btn-sm btn-primary">{{__('common.update')}}</button>
        {!! link_to(route("{$sectionCode}.reset-password", $data['id']), __('common.reset_password'), ['class' => 'btn btn-sm btn-warning']) !!}
        {!! Html::tag('a', __('common.back'), ['class' => 'btn btn-sm btn-danger', 'onclick' => "history.back()"]) !!}
        {!! Form::close() !!}
    </div>
@endsection
