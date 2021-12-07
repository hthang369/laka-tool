<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="/" >
        <img src="{{asset('/images/logo-official.png')}}" alt="logo">
        Laka Tool</a>
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-sm btn-secondary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="d-flex flex-row-reverse bd-highlight collapse navbar-collapse " id="navbarSupportedContent">
        <div class=" bd-highlight dropdown dropdown-menu-left ">

            <i class="fas fa-user btn btn-md btn-secondary" id="dropdownMenuButton" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }}</i>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                <a class="dropdown-item d-flex" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item d-flex"
                   href="{{route('user-management.update-password-form')}}">
                    Change password
                </a>
            </div>
        </div>
    </div>
    </div>

</nav>
