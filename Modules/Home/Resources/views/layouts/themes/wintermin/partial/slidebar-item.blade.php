@php
    $active = str_is(get_route_name(), $subItem->route_name) ? 'active' : '';
    $collapseShow = starts_with(Route::current()->uri(), $subItem->group) ? 'show' : '';
@endphp
<li class="nav-item dropdown">
    @if (empty($subItem->route_name))
        {!! link_to($subItem->link, __($subItem->lang), ['class' => array_css_class(['nav-link', 'dropdown-toggle', $active]), 'data-toggle' => 'collapse']) !!}
        <div class="{{array_css_class(['pl-3', 'collapse', $collapseShow])}}" id="{{ltrim($subItem->link,'#')}}">
            <ul class="nav flex-column">
                @each(layouts_path('home', 'partial.slidebar-item'), $subItem->children, 'subItem')
            </ul>
        </div>
    @else
        {!! link_to_route($subItem->route_name, __($subItem->lang), [], ['class' => array_css_class(['nav-link', $active])]) !!}
    @endif
</li>
