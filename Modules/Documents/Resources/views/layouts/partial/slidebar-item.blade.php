<li class="nav-item dropdown">
    @if (isset($subItem['children']))
        {!! link_to($subItem['route'], $subItem['name'], ['class' => array_css_class(['nav-link', 'dropdown-toggle']), 'data-toggle' => 'collapse']) !!}
        <div class="{{array_css_class(['pl-3', 'collapse'])}}" id="{{ltrim($subItem['route'],'#')}}">
            <ul class="nav flex-column">
                @each('documents::layouts.partial.slidebar-item', $subItem['children'], 'subItem')
            </ul>
        </div>
    @else
        {!! link_to_route($subItem['route'], $subItem['name'], [], ['class' => array_css_class(['nav-link'])]) !!}
    @endif
</li>
