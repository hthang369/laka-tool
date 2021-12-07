<nav id="sidebar" class="sidebar">
    <div class="p-4">
        <ul class="list-unstyled components mb-5">
            @foreach($TOPMENU as $itemTop)
                @php
                    $route = substr(Route::currentRouteName(), 0, strpos(Route::currentRouteName(), '.'));
                    $isActive= $route == $itemTop->group ? 'show' : '';
                @endphp
                <li class="active my-2">

                    <a href="#{{$itemTop->group}}" data-toggle="collapse" aria-expanded="false"
                       class="dropdown-toggle">@lang($itemTop->lang)</a
                    >
                    <ul class="collapse list-unstyled {{$isActive}}" id="{{$itemTop->group}}">
                        @foreach($LEFTMENU as $itemLeft)
                            @if($itemLeft->group == $itemTop->group)
                                @php
                                    $activeClass = Route::currentRouteName() == $itemLeft->route_name ? 'sub-menu-active' : ''
                                @endphp
                                <li class="{{$activeClass}} my-2">
                                    {!! link_to_route($itemLeft->route_name, __($itemLeft->lang),[]) !!}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li>
            @endforeach
        </ul>
    </div>
</nav>
@push('scripts')
    <script>
        (function ($) {
            "use strict";
            var fullHeight = function () {

                $('.js-fullheight').css('height', $(window).height());
                $(window).resize(function () {
                    $('.js-fullheight').css('height', $(window).height());
                });

            };
            fullHeight();

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

        })(jQuery);
    </script>
@endpush

