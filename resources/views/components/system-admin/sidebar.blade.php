<nav id="sidebar" class="sidebar my-2">
    {{--    <div class="p-4">--}}
    <ul class="list-unstyled components mb-5" id="menu">
        @foreach($TOPMENU as $itemTop)
            @php
                $route = substr(Route::currentRouteName(), 0, strpos(Route::currentRouteName(), '.'));
                $isShow= $route == $itemTop->group ? 'show' : '';
                $activeClass = $isShow == 'show' ? 'parrent-active' :'';
            @endphp
            <li class="active">

                <a href="#{{$itemTop->group}}" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle {{$activeClass}}">@lang($itemTop->lang)</a
                >
                <ul class="collapse list-unstyled {{$isShow}} " id="{{$itemTop->group}}">
                    @foreach($LEFTMENU as $itemLeft)
                        @if($itemLeft->group == $itemTop->group)
                            @php
                                $activeClass = Route::currentRouteName() == $itemLeft->route_name ? 'sub-menu-active' : ''
                            @endphp
                            <li class="{{$activeClass}} my-2 sub-menu mx-2">
                                {!! link_to_route($itemLeft->route_name, __($itemLeft->lang),[]) !!}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
            <li>
        @endforeach

    </ul>
    {{--    </div>--}}
</nav>
@push('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{asset('js/sidebar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script>
        (function ($) {
            "use strict";
            $(window).on("load", function () {
                $("#sidebar").mCustomScrollbar({
                        theme: "inset",
                    }
                );
            });
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

