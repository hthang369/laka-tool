@can("download_{$sectionCode}")
<x-form method="POST" route="laka-log.download-log">
    {!! Form::hidden('name', $data['name']) !!}
    <x-button :variant="$data['isDownloaded'] == 1 ? secondary : success" size="sm" icon="fas fa-download" type="submit" :disabled="$data['isDownloaded'] == 1 ? true : false"/>
</x-form>
@endcan
