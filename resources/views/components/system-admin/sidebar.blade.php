{{--<div class="bg-light border-right" id="sidebar-wrapper">--}}
{{--    <div class="list-group list-group-flush">--}}

{{--    @foreach($LEFTMENU as $itemLeft)--}}
{{--        @php($activeClass = Route::currentRouteName() == $itemLeft->route_name ? 'active font-weight-bold bg-info' : '')--}}
{{--        {!! link_to_route($itemLeft->route_name, __($itemLeft->lang), [], [--}}
{{--            'class' => get_classes(['list-group-item', 'list-group-item-action', $activeClass])--}}
{{--        ]) !!}--}}
{{--    @endforeach--}}
{{--    </div>--}}
{{--</div>--}}

<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Bootstrap Slider</h3>
    </div>
    <ul class="lisst-unstyled components">
        <p>The Providers</p>
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a
            >
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">Home 1</a>
                </li>
                <li>
                    <a href="#">Home 2</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">About</a>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a
            >
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#">Policy</a>
        </li>

        <li>
            <a href="#">Contact Us</a>
        </li>
    </ul>
</nav>
