@php
    $id = data_get($data, 'modal.model.id');
@endphp

{!! Modal::start($data['modal']) !!}
    <x-alert type="success">@lang('common.alert_sent_verification_code', ['email' => user_get('email')])</x-alert>
    {!! $data['form'] !!}
{!! Modal::end(module_views_path('lakamanager', 'laka-user.buttons.modal-buttons-confirm'), compact('id')) !!}

<script>
(function ($) {
    _grids.utils.handleAjaxRequest($('.btn-resend'), 'click', {
        onSuccess: function(data) {

        }
    });
})(jQuery);
</script>
