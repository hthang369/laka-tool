@props(['data'])
<div>
    @if($data['isShowBtnRoleSetting'])
    {!! bt_link_to_route("permission-role.edit", __('common.role_setting'), 'primary', [$data['id'], 'ref' => 'role-grid'], ['class' => 'btn-sm show_modal_form ml-2'
        ,'data-modal-size' => 'modal-xl', 'icon' => 'fas fa-tools'],'edit','permission-role') !!}
    @endif
</div>
