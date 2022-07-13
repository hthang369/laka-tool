<input type="hidden" id="add-contact-option" name="add-contact-option">
@if (user_can("edit_$sectionCode"))
    <x-button type="button" variant="primary" size="sm" class="mr-2" id="btn-set-user-type" data-value="set-user-{{ data_get($data, 'btn_user_type.value') }}"
        data-trigger-confirm="1" data-confirmation-msg="{{__('common.confirm.set_user_type')}}"
        text="{{ data_get($data, 'btn_user_type.text') }}" icon="fa fa-edit" />
    <x-button type="button" variant="primary" size="sm" class="mr-2" id="btn-add-all-contact"
        data-trigger-confirm="1" data-confirmation-msg="{{__('common.confirm.add_all_contact')}}"
        text="{{ __('users.laka.add_all_contacts') }}" icon="fa fa-plus" />
    <x-button type="button" id="btn-add-all-room" class="mr-2" variant="primary" size="sm"
        data-trigger-confirm="1" data-confirmation-msg="{{__('common.confirm.add_all_to_room')}}"
        text="{{ __('users.laka.add_to_all_rooms') }}" icon="fa fa-plus" />
@endif

{!! bt_link_to_route("{$sectionCode}.reset-password", __('common.reset_password'), 'warning', [$data['id']], ['class' => 'btn-sm btn-reset mr-2',
    'icon' => 'fa fa-redo', 'data-trigger-confirm' => '1', 'data-confirmation-msg' => __('common.confirm_reset_pass')], 'edit', $sectionCode) !!}
<x-button text="{{'Close'}}" icon="fa fa-times" size="sm" variant="danger" data-dismiss="modal" />
