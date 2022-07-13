{!! Form::btSubmit(__('common.submit_verification_code'), 'success',
['class' => 'btn-sm mr-2', 'icon' => 'far fa-check',
'data-trigger-confirm' => '1',
'data-confirmation-msg'=>__('common.confirm_submit_verification_code')],'delete',$sectionCode) !!}
{!! bt_link_to_route("{$sectionCode}.resend-code", __('common.resend'), 'warning', [ $data['id'],'type'=>'resent'], ['class' => 'btn-sm btn-resend mr-2',
    'icon' => "fa fa-redo",'data-trigger-confirm' => '1',
    'data-confirmation-msg'=>__('common.confirm_resend')],'delete',$sectionCode);!!}
<x-button text="{{'Close'}}" icon="fa fa-times" size="sm" variant="danger" data-dismiss="modal" />
