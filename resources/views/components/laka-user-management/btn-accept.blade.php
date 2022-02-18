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
        1=>'btn-success',
        2=>'btn-warning',
        3=>'btn-success'
    ];
    $urlAction = "{$sectionCode}.{$routeNameWithStatus[$data['request_approval_status']]}";
    $nameBtn = $arrNameBtn[$data['request_approval_status']];
    $colorBtn = $arrColorBtn[$data['request_approval_status']];

@endphp
<a class="btn btn-sm {{$colorBtn}}" href="{{ route($urlAction,['id'=>$data['id']])}}" onclick="return window.confirm('{{__('common.are_you_sure',['message'=>"{$nameBtn}"])}}')" >@lang("common.{$nameBtn}")</a>
<a name="destroy" class="btn btn-sm btn-danger data-remote" href="{{ route("{$sectionCode}.delete-token",['id'=>$data['id']])}}" title="Delete" data-loading="Loading" data-trigger-confirm="1" data-confirmation-msg="Are you sure you want to delete?" data-method="DELETE" data-pjax-target="#approvalApiToken-grid">
    <i class="fa fa fa-trash"></i>

</a>
