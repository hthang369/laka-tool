@can("download_{$sectionCode}")
    <x-button
        :variant="$data['isDownloaded'] == 1 ? secondary : success"
        size="sm"
        icon="fas fa-download"
        type="submit"
        class="btn-download"
        data-name="{{$data['name']}}"/>
        {{-- :disabled="$data['isDownloaded'] == 1 ? true : false"/> --}}
@endcan
