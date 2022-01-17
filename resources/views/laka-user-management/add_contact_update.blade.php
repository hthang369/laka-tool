@extends('components.system-admin.form')

@section('message_content')
    @php
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
        {!! Form::open(['method' => 'POST','id'=>'form-update-laka-usser']) !!}
        <x-form-group :inline="true">
            <x-form-label class="col-sm-2 col-form-label required">@lang('users.laka.fields.company')</x-form-label>
            <x-form-select name="company_id" :items="$data['company_list']" :selected="$data['company_id']"
                           placeholder=" " required
                           groupClass="col-sm-10 form-row"/>
        </x-form-group>
        <x-form-group :inline="true">
            <x-form-label class="col-sm-2  required">@lang('users.laka.add_contact_option')</x-form-label>
            <input type="hidden" id="add-contact-option" name="add-contact-option">
            <x-button type="submit" variant="primary" size="sm" class="mr-2" id="btn-add-all-contact" text="{{__('users.laka.add_all_contacts')}}" />
            <x-button type="submit" id="btn-add-all-room" variant="primary" size="sm" text="{{__('users.laka.add_to_all_rooms')}}" />
        </x-form-group>
        <div class="form-row align-items-center justify-content-center">
            {!! link_to(route("{$sectionCode}.reset-password", $data['id']), __('common.reset_password'), ['class' => 'btn btn-sm btn-warning mr-2']) !!}
            {!! Html::tag('a', __('common.back'), ['class' => 'btn btn-sm btn-danger', 'onclick' => "history.back()"]) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@push('scripts')
    <script>
        let btnAddAllContact = document.getElementById('btn-add-all-contact');
        let btnAddAllRoom = document.getElementById('btn-add-all-room');
        let inputAddContactOption = document.getElementById('add-contact-option');
        let form = document.getElementById('form-update-laka-usser');

        btnAddAllContact.addEventListener('click', () => {
            inputAddContactOption.value = "add-all-contact";
            form.submit();
        });
        btnAddAllRoom.addEventListener('click', () => {
            inputAddContactOption.value = "add-all-room";
            form.submit();
        });
    </script>
@endpush
