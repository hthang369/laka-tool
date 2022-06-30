@php
    $routeNameWithStatus = [
        1 => 'approval-token',
        2 =>'stop-token',
        3 =>'approval-token'
    ];
    $arrNameBtn= [
            1 => 'accept',
            2 =>'pause',
            3 =>'accept',
    ];
    $arrColorBtn = [
        1=>'success',
        2=>'warning',
        3=>'success'
    ];
    $arrIcon = [
        1=>'fas fa-check',
        2=>'fas fa-pause',
        3=>'fas fa-check'
    ];
    $urlAction = "{$sectionCode}.{$routeNameWithStatus[$data['request_approval_status']]}";
    $nameBtn = $arrNameBtn[$data['request_approval_status']];
    $colorBtn = $arrColorBtn[$data['request_approval_status']];
    $iconBtn = $arrIcon[$data['request_approval_status']];

@endphp
{!! bt_link_to_route($urlAction, __("common.{$nameBtn}"), $colorBtn, ['id'=>$data['id']], ['class' => 'btn-sm btn-remote', 'icon' => $iconBtn,
'data-trigger-confirm' => '1', 'data-loading' => translate('table.loading_text'),
"data-confirmation-msg"=>__('common.are_you_sure',['message'=>"{$nameBtn}"])],'edit',$sectionCode) !!}

