@php
    $linkClass = ['nav-link', 'px-3'];
    $currentRoute = Route::currentRouteName();
    if (str_is($currentRoute, $subItem->route_name)) {
        array_push($linkClass, 'active');
    }
@endphp
{{--{{dd($subItem)}}--}}
{{--@can("add_$sectionCode")--}}
{{($subItem->route_name)}}
<li class="sub-menu">

    {!! link_to_route($subItem->route_name, __($subItem->lang) ,[], ['class' => Arr::toCssClasses($linkClass)],'add',$sectionCode) !!}
</li>
{{--@endcan--}}
