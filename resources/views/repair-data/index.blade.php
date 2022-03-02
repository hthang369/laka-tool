@extends('components.system-admin.list')

@section('caption_page')
    <x-row>
        <x-col size="6">
            <div class="progress-group my-2">
                <div class="progress-title">Đang download: <span></span></div>
                <x-progress class="marquee" />
            </div>
        </x-col>
        <x-col size="6">
            <div class="d-flex align-items-center my-2">
                <x-button class="btn-search" variant="primary" icon="fa fa-search" data-loading="{{translate('table.loading_text')}}" text="Get all file" />
            </div>
        </x-col>
    </x-row>
    <x-row>
        <x-col size="6">
            <label>Danh sách file download:</label>
        </x-col>
    </x-row>
    @parent
@endsection
@push('scripts')
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script>
(function ($) {
    $('.btn-search').click(function() {
        $api.post('{{route("repair-data.store")}}', null, {
            'contentType': 'application/json',
            'targetLoading': '.btn-search',
            'pjaxContainer': '#repairData-grid'
        });
    });
    $('.btn-run').click(function() {
        let data = JSON.stringify({name: $(this).data('name'), id: $(this).data('id')});
        $api.post('{{route("repair-data.download")}}', data, {
            'contentType': 'application/json',
            'targetLoading': $(this),
            'pjaxContainer': '#repairData-grid'
        });
    });
    $('.btn-restore').click(function() {
        let data = JSON.stringify({name: $(this).data('name'), id: $(this).data('id')});
        $api.post('{{route("repair-data.restore")}}', data, {
            'contentType': 'application/json',
            'targetLoading': $(this),
            'pjaxContainer': '#repairData-grid'
        });
    });
    var pusher = new Pusher('{{env("PUSHER_APP_KEY")}}', {
        cluster: '{{env("PUSHER_APP_CLUSTER")}}',
        encrypted: true
    });
    var channel = pusher.subscribe('channel-download');
    channel.bind('App\\Events\\DownloadDataNotificationEvent', function(data) {
        if (data.success) {
            $('.progress-bar').addClass('marquee-bar');
        } else {
            $('.progress-bar').removeClass('marquee-bar');
        }
        _grids.utils.getProgressButton('#btn-run-'+data.targetId, data.success);
        $('.progress-title').find('span').text(data.message);
    });
    var channel = pusher.subscribe('channel-restore');
    channel.bind('App\\Events\\RestoreDataNotificationEvent', function(data) {
        if (data.success) {
            $('.progress-bar').addClass('marquee-bar');
        } else {
            $('.progress-bar').removeClass('marquee-bar');
            window.location.reload();
        }
        _grids.utils.getProgressButton('#btn-run-'+data.targetId, data.success);
        $('.progress-title').find('span').text(data.message);
    });
})(jQuery);
</script>
@endpush
