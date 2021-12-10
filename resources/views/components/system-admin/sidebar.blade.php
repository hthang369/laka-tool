@php
    $sectionCode = App\Facades\Common::getSectionCode();
@endphp
<nav id="sidebar" class="sidebar my-2">
    <ul class="nav navbar-nav my-2" id="menu">
        @foreach ($MENUS as $item)
        @php
            $parentClass = ['nav-item'];
            $itemClass = ['nav-link', 'px-3'];
            $showClass = '';
            $itemAttrs = [];
            $isChild = $item->children->count() > 0;
            if (str_is($sectionCode, $item->group)) {
                array_push($parentClass, 'active');
                $showClass = 'show';
            }
            if ($isChild) {
                $link = "#{$item->group}";
                array_push($parentClass, 'dropdown');
                array_push($itemClass, 'dropdown-toggle');
                $itemAttrs = array_merge($itemAttrs, ['data-toggle' => 'collapse', 'aria-expanded' => false]);
            }
            $itemAttrs = array_merge($itemAttrs, ['class' => Arr::toCssClasses($itemClass)]);
        @endphp
        <li class="{{Arr::toCssClasses($parentClass)}}">
            {!! link_to($item->link, __($item->lang), $itemAttrs) !!}
            @if ($isChild)
                <ul class="collapse list-unstyled pl-3 {{$showClass}}" id="{{$item->group}}">
                    @each('components.system-admin.slidebar-item', $item->children, 'subItem')
                </ul>
            @endif
        </li>
        @endforeach
    </ul>
</nav>
@push('scripts')
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> --}}
    <script src="{{asset('js/sidebar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script>
        (function ($) {
            "use strict";
            $(window).on("load", function () {
                $("#sidebar").mCustomScrollbar({
                        theme: "inset",
                        autoHideScrollbar: "true",
                    }
                );
            });
            // var fullHeight = function () {

            //     $('.js-fullheight').css('height', $(window).height());
            //     $(window).resize(function () {
            //         $('.js-fullheight').css('height', $(window).height());
            //     });

            // };
            // fullHeight();

            // $('#sidebarCollapse').on('click', function () {
            //     $('#sidebar').toggleClass('active');
            // });


        })(jQuery);
    </script>
@endpush

