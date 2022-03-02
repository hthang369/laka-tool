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
{!! bt_link_to_route($urlAction, __("common.$nameBtn"), $colorBtn, ['id'=>$data['id']], ['class' => 'btn-sm', 'icon' => $iconBtn,
"data-confirmation-msg"=>__('common.are_you_sure',['message'=>"{$nameBtn}"])],'edit',$sectionCode) !!}

@if(user_can("edit_$sectionCode"))
    <a name="destroy" class="btn btn-sm btn-danger data-remote"
       href="{{ route("{$sectionCode}.delete-token",['id'=>$data['id']])}}" title="Delete" data-loading="Loading"
       data-trigger-confirm="1" data-confirmation-msg="Are you sure you want to delete?" data-method="DELETE"
       data-pjax-target="#approvalApiToken-grid">
        <i class="fa fa fa-trash"></i>
    </a>
@endif

