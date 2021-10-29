@extends('components.system-admin.form')

@section('message_content')
    <!-- Show notification when redirect action-->
    @if(session()->has('added_all_contact'))
        @if(session()->get('added_all_contact') == true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                @lang('custom_message.added_all_contacts')
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @else
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @lang('custom_message.add_all_contacts_failed')
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endif
    @if(session()->has('added_to_all_rooms'))
        @if(session()->get('added_to_all_rooms') == true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                @lang('custom_message.added_to_all_rooms')
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @else
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @lang('custom_message.add_to_all_rooms_failed')
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    @endif
    @if(session()->has('user_has_been_disabled'))
        <div class="alert alert-danger">
            <strong>@lang('custom_message.user_has_been_disabled')</strong>
        </div>
    @endif
    @if(session()->has('isResetPass'))
        @if(session()->get('isResetPass')==true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @else
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
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
    @php
        $has_choose_company = session('has_chosen_company', false);
        $choose_company_class = $has_choose_company ? 'is-invalid' : '';
        $has_option_class = session('has_chosen_add_option', false) ? 'is-invalid' : '';
    @endphp
    <div class="form-group-update mt-4">
    {!! Form::open(['method' => 'POST']) !!}
        <div class="form-group row">
            {!! Form::label('', __('common.choose_company'), ['class' => 'col-2 col-form-label required']) !!}
            <div class="col-10">
            {!! Form::select('company_id', $data['company_list'], null, ['class' => "form-control $choose_company_class"]) !!}
            </div>

            <span class="invalid-feedback" role="alert">
                <strong>{{ $has_choose_company == false ? 'You must choose a company' : '' }}</strong>
            </span>
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

                <span class="invalid-feedback mt-0" role="alert">
                    <strong>{{ session('has_chosen_add_option') == false ? 'You must choose at least 1 option' : '' }}</strong>
                </span>
            </div>
        </div>
        {!! link_to(route("{$sectionCode}.update", $data['id']), __('common.update'), ['class' => 'btn btn-sm btn-primary']) !!}
        {!! Html::tag('a', __('common.back'), ['class' => 'btn btn-sm btn-danger ml-2', 'onclick' => "history.back()"]) !!}
    {!! Form::close() !!}
    </div>
@endsection
