@php
    $menus = config('documents.menus');
@endphp
<ul class="nav flex-column">
    @foreach ($menus as $menu)
        <li class="nav-item">
            {!! link_to($menu['route'], $menu['name'], ['class' => array_css_class(['nav-link', 'dropdown-toggle']), 'data-toggle' => 'collapse']) !!}
            <ul class="nav flex-column">
                @each('documents::layouts.partial.slidebar-item', $menu['children'], 'subItem')
            </ul>
        </li>
    @endforeach

</ul>
