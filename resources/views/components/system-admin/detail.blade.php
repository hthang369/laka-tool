@extends('components.system-admin.form')

@section('body_button')
<div class="form-row d-flex justify-content-center">
    @if($data['userLoginRoleRank'] <= $data['role_rank'] && $data['status']!=1)
        @can("edit_{$sectionCode}")
            {!! Route::has("{$sectionCode}.edit") ? bt_link_to_route("{$sectionCode}.edit", __('common.update'), 'primary', [data_get($data, 'id')], ['class' => 'btn-sm', 'icon' => 'fa-edit']) : '' !!}
        @endcan
    @endif
    {!! bt_link_to_route("{$sectionCode}.index", __('common.back'), 'danger', [], ['class' => 'btn-sm ml-2', 'icon' => 'fa-undo']) !!}
</div>
@endsection
