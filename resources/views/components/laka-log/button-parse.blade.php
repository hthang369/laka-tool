@can("add_{$sectionCode}")
    @php
        $variantBtnParse = $data->status == 1?'secondary':'primary';
        $isDisable = $data->status == 1 ? true : false;
    @endphp
    <x-form method="POST" route="laka-log.store">
        {!! Form::hidden('files[]', data_get($data,'name')) !!}
        {!! Form::btSubmit(__('laka_log.btn-parse'), $variantBtnParse, ['class' => 'btn-sm','disabled'=>$isDisable, 'icon' => "fas fa-exchange-alt",'onclick'=>"return confirm('".__('common.confirm_parse_record')."')"]) !!}
    </x-form>
@endcan

