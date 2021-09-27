@can("add_{$sectionCode}")
<x-form method="POST" route="laka-log.store">
    {!! Form::hidden('files[]', data_get($data,'name')) !!}
    <x-button :variant="$data->status == 1 ? secondary : primary" size="sm" :text="__('laka_log.btn-parse')" type="submit" :disabled="$data->status == 1 ? true : false"/>
</x-form>
@endcan

