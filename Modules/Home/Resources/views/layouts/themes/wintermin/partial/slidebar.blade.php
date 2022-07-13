<aside class="aside collapse navbar-sidebar navbar-collapse col-lg-2 col-md-3 px-0" id="navbarNavDropdown">
    <!-- START Sidebar (left)-->
    <nav class="sidebar col-lg-2 col-md-3 p-0" id="sidebar">
       <ul class="nav flex-column">
           @foreach ($MENUS as $menu)
                <li class="nav-item nav-heading">
                    <span class="nav-link">@lang($menu->lang)</span>
                    <ul class="nav flex-column pl-3">
                        @each(layouts_path('home', 'partial.slidebar-item'), $menu->children, 'subItem')
                    </ul>
                </li>
           @endforeach
       </ul>
    </nav>
    <!-- END Sidebar (left)-->
</aside>
@push('scripts')
 {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> --}}
 <script src="{{asset('js/sidebar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
 <script>
     (function ($) {
         "use strict";
         $(window).on("load", function () {
             $("#sidebar").mCustomScrollbar({
                     theme: "dark",
                     autoHideScrollbar: "true",
                 }
             );
         });
     })(jQuery);
 </script>
@endpush
