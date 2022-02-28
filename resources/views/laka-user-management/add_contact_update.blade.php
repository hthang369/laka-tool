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
        {!! Form::open(['method' => 'POST','id'=>'form-update-laka-user']) !!}
        <x-form-group :inline="true">
            <x-form-label class="col-sm-2 col-form-label required">@lang('users.laka.fields.company')</x-form-label>
            <x-form-select name="company_id" :items="$data['company_list']" :selected="$data['company_id']"
                           placeholder=" " required
                           groupClass="col-sm-10 form-row"/>
        </x-form-group>
        <div class="form-row align-items-center justify-content-center">
            <input type="hidden" id="add-contact-option" name="add-contact-option">
            <x-button type="button" variant="primary" size="sm" class="mr-2" id="btn-add-all-contact"
                      text="{{__('users.laka.add_all_contacts')}}" icon="fa fa-plus"/>
            <x-button type="button" id="btn-add-all-room" class="mr-2" variant="primary" size="sm"
                      text="{{__('users.laka.add_to_all_rooms')}}" icon="fa fa-plus"/>
            {!! bt_link_to_route("{$sectionCode}.reset-password", __('common.reset_password'), 'warning', [$data['id']], ['class' => 'btn-sm  mr-2', 'icon' => "fa fa-redo",'onclick'=>"return confirm('".__('common.confirm_reset_pass')."')"]);!!}
            {!! bt_link_to_route("{$sectionCode}.add-contact", __('common.back'), 'danger', [], ['class' => 'btn-sm', 'icon' => 'fa-undo']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@push('scripts')
    <script>
        let btnAddAllContact = document.getElementById('btn-add-all-contact');
        let btnAddAllRoom = document.getElementById('btn-add-all-room');
        let inputAddContactOption = document.getElementById('add-contact-option');
        let form = document.getElementById('form-update-laka-user');
        let confirmSubmit = (message) => {
            return window.confirm('Are you sure ' + message + '?');
        }

        btnAddAllContact.addEventListener('click', () => {
            inputAddContactOption.value = "add-all-contact";
            return confirmSubmit('add all contact') ? form.submit() : false;

        });
        btnAddAllRoom.addEventListener('click', () => {
            inputAddContactOption.value = "add-all-room";
            return confirmSubmit('add to all room') ? form.submit() : false;
        });


    </script>
@endpush
