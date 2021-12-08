<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{asset('/images/logo-official.png')}}" alt="logo">
            Management Tool</a>

{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"--}}
{{--                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
        <div class="d-flex flex-row-reverse bd-highlight collapse navbar-collapse " id="navbarSupportedContent">
            <div class=" bd-highlight dropdown dropdown-menu-left ">

                <i class="fas fa-user btn btn-md btn-secondary" id="dropdownMenuButton" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }}</i>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="list-item">
                        <a class="dropdown-item"
                           href="{{route('user-management.update-password-form')}}">
                            <i class="fas fa-user-cog text-warning"></i>
                            <span>Change password</span>
                        </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="list-item">
                        <a class="dropdown-item align-items-center"
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt text-info"></i>
                            <span>
                            {{ __('Logout') }}
                        </span>

                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</nav>
