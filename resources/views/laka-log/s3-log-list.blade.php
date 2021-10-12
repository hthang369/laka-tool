@extends('components.system-admin.list')

@section('caption_page')
    <x-form route="laka-log.s3-log-list">
        <x-form-group :inline="true">
            <div class="col-2">
                <x-datepicker name="dtFrom" :value="$dtFrom" />
            </div>
            <span>~</span>
            <div class="col-2">
                <x-datepicker name="dtTo" :value="$dtTo" />
            </div>
            <x-button type="submit" variant="primary" text="Search" />
        </x-form-group>
        @parent
    </x-form>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.btn-download').click(function() {
            var btnTarget = $(this);
            $api.post('{{route("laka-log.download-log")}}', JSON.stringify({name: btnTarget.data('name')}), {
                contentType: 'application/json',
                beforeSend: function() {
                    btnTarget.attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                onComplete: function() {
                    btnTarget.html('<i class="fas fa-download"></i>');
                },
                onSuccess: function(data) {
                    _grids.formUtils.renderAlert('success', data.message)
                    window.location.href = data.data
                    setTimeout(function () {
                        $.pjax.reload({ container: '#gridData' });
                    }, 500);
                }
            })
        });
    })

</script>
@endpush
