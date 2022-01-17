@extends('components.system-admin.form')

@section('body_button')
<div class="form-row d-flex justify-content-center">
    @if (user_can("edit_{$sectionCode}"))
    {!! Route::has("{$sectionCode}.edit") ? link_to(route("{$sectionCode}.edit", data_get($data, 'id')), __('common.update'), ['class' => 'btn btn-sm btn-primary']) : '' !!}
    @endif
    {!! Html::tag('a', __('common.back'), ['class' => 'btn btn-sm btn-danger ml-2', 'onclick' => "history.back()"]) !!}
</div>
@endsection
