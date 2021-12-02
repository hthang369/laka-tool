@extends('components.system-admin.form')

@section('message_content')
    @php
        $has_choose_company = session('has_chosen_company', false);
        $choose_company_class = $has_choose_company ? 'is-invalid' : '';
        $session_error = session('errors');

        if (!is_null($session_error) && gettype($session_error) =='object'){
            $errors = $session_error->toArray();
        };
    @endphp
    <!-- Show notification when redirect action-->

    @if (session('errors')||session('success'))
        <x-alert type="{{session()->get('errors') ? 'danger' : 'success'}}" dismissible="true">
            {{session()->get('message')}}
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
        <div class="form-group row">
            {!! Form::label('', __('common.choose_company'), ['class' => 'col-2 col-form-label required']) !!}
            <div class="col-10">
                {!! Form::select('company_id', $data['company_list'],null, ['class' => "form-control"]) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('', __('users.laka.add_contact_option'), ['class' => 'col-2 col-form-label required']) !!}
            <div class="col-10">
                @foreach (['add_all_contacts', 'add_to_all_rooms'] as $item)
                    <div class="custom-control custom-checkbox mr-2">
                        {!! Form::checkbox('add_contact_option[]', $item, (bool)$value, ['class' => "custom-control-input $has_option_class", 'id' => $item]) !!}
                        {!! Form::label($item, __("users.laka.$item"), ['class' => 'custom-control-label']) !!}
                    </div>
                @endforeach

                @if(!is_null($errors['add_contact_option']))
                    <span class="invalid-feedback d-block" role="alert">
                                       {{trans('common.validate_add_contact_options')}}
                                    </span>
                @endif

            </div>

        </div>
        <button type="submit" class="btn btn-sm btn-primary">{{__('common.update')}}</button>
        {!! link_to(route("{$sectionCode}.reset-password", $data['id']), __('common.reset_password'), ['class' => 'btn btn-sm btn-warning']) !!}
        {!! Html::tag('a', __('common.back'), ['class' => 'btn btn-sm btn-danger', 'onclick' => "history.back()"]) !!}
        {!! Form::close() !!}
    </div>
@endsection
