@props(['data'])
@php
    $permissions = json_decode($data['permission'], true);
    $permissions = array_intersect_key($permissions, array_flip($data['available_actions']));
    $sectionCode = data_get($data, 'section_code');
@endphp
<div class="form-row">
    @foreach ($permissions as $action => $value)
    <div class="custom-control custom-checkbox mr-2">
        {!! Form::checkbox("{$action}_{$sectionCode}", 1, (bool)$value, [
                'class' => 'custom-control-input',
                'id' => "{$action}_{$sectionCode}",
            ]) !!}
        {!! Form::label("{$action}_{$sectionCode}", __("$action"), ['class' => 'custom-control-label']) !!}
    </div>
    @endforeach

</div>
