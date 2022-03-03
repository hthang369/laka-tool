@props(['data'])
<div>

    {!! bt_link_to_route("permission-role.show", __('common.role_setting'), 'primary', [$data['id']], ['class' => 'btn-sm ml-2', 'icon' => 'fas fa-tools'],'edit','permission-role') !!}
</div>
