@php
    $variantBtnParse = $data->status == 1?'secondary':'primary';
    $isDisable = $data->status == 1 ? true : false;
@endphp
{!! Form::btSubmit(__('laka_log.btn-parse'), $variantBtnParse, ['class' => 'btn-sm btn-parse','disabled'=>$isDisable,
    'data-action' => route('laka-log.store'), 'data-value' => '{"files": ["'.data_get($data,'name').'"]}',
    'icon' => "fas fa-exchange-alt", 'data-trigger-confirm' => '1', 'data-loading' => translate('table.loading_text'),
    'data-confirmation-msg'=>__('common.confirm_parse_record')],'add',$sectionCode) !!}
