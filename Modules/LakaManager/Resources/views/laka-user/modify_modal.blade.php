@php
    $view = str_is(data_get($data, 'modal.action'), 'detail') ? module_views_path('lakamanager', 'laka-user.buttons.modal-buttons') : null;
    $id = data_get($data, 'modal.model.id');
    $btn_user_type = data_get($data, 'modal.model.btn_user_type');
@endphp

{!! Modal::start($data['modal']) !!}
    {!! $data['form'] !!}
{!! Modal::end($view, compact('id', 'btn_user_type')) !!}

@if (str_is(data_get($data, 'modal.action'), 'detail'))
<script>
(function ($) {
    function submitForm(target, msg) {
        let btn = $('#btn-'+target);
        let inputHidden = $('#add-contact-option');
        btn.on('click', function(e) {
            e.preventDefault();
            if (!showConfirmMessage(btn)) {
                return;
            }
            let formTarget = $('#modal_form');
            inputHidden.val(btn.data('value') || target);
            let ajaxData = JSON.stringify(formTarget.serializeObject());
            $api._callApi(formTarget.attr('method'), formTarget.attr('action'), ajaxData, {
                contentType: 'application/json',
                targetLoading: btn,
                pjaxContainer: '#lakaUser-grid'
            })
        });
    }
    _grids.utils.handleAjaxRequest($('.btn-reset'), 'click', {
        pjaxContainer: '#lakaUser-grid'
    });

    submitForm('add-all-contact', 'add all contact');
    submitForm('add-all-room', 'add to all room');
    submitForm('set-user-type', 'set user type');
})(jQuery);
</script>
@endif
