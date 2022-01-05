@extends('layouts.main-page')

@section('content')
    <x-row>
        <x-col size="6">
            <div class="progress-group my-2">
                <div class="progress-title">Đang download: <span></span></div>
                <x-progress class="marquee" />
            </div>
        </x-col>
        <x-col size="6">
            <div class="d-flex align-items-center my-2">
                <x-button class="btn-run" variant="primary" text="Download backup" />
            </div>
        </x-col>
    </x-row>
    <x-row>
        <x-col size="6">
            <label>Danh sách file download:</label>
        </x-col>
    </x-row>
@endsection
@push('scripts')
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script>
(function ($) {
    $('.btn-run').click(function() {
        // $(this).attr('disabled', true);
        // let actionMethod = $(this).data('method');
        // axios.post('{{route("repair-data.test")}}', null, {
        //     transformRequest: function (data, headers) {
        //         $('.btn-run').attr('disabled', true);
        //         return data;
        //     },

        //     transformResponse: function (data) {
        //         $('.btn-run').attr('disabled', false);
        //         return data;
        //     },
        // });
        let params = new URLSearchParams(location.search)
        params.set('name', 'anhd')
        let url = params.toString() == '' ? '' : '?' + params.toString();
        let fullUrl = new URL(url, '{{request()->url()}}');
        window.location.href = fullUrl.toString(), true;
    });
    // var pusher = new Pusher('{{env("PUSHER_APP_KEY")}}', {
    //     cluster: '{{env("PUSHER_APP_CLUSTER")}}',
    //     encrypted: true
    // });
    // var channel = pusher.subscribe('channel-demo');
    // channel.bind('App\\Events\\DemoNotificationEvent', function(data) {
    //     if (data.success) {
    //         $('.progress-bar').addClass('marquee-bar');
    //     } else {
    //         $('.progress-bar').removeClass('marquee-bar');
    //     }
    //     $('.progress-title').find('span').text(data.message);
    // });
})(jQuery);
</script>
@endpush
