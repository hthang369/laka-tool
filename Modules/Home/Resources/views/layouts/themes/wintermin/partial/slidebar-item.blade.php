@php($active = (str_is(get_route_name(), $subItem->route_name) ? 'active' : ''))
<li class="nav-item dropdown">
    @if (empty($subItem->route_name))
        {!! link_to($subItem->link, __($subItem->lang), ['class' => array_css_class(['nav-link', 'dropdown-toggle', $active]), 'data-toggle' => 'collapse']) !!}
        <div class="pl-3 collapse" id="{{ltrim($subItem->link,'#')}}">
            <ul class="nav flex-column">
                @each(layouts_path('home', 'partial.slidebar-item'), $subItem->children, 'subItem')
            </ul>
        </div>
    @else
        {!! link_to_route($subItem->route_name, __($subItem->lang), [], ['class' => array_css_class(['nav-link', $active])]) !!}
    @endif
</li>
