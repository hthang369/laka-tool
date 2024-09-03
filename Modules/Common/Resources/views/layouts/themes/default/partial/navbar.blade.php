<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center"  href="/">
            <img class="logo" src="{{asset('/images/logo-official.png')}}" alt="logo">
            <span class="logo-name"> Management Tool</span>
        </a>
        <button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="bd-highlight dropdown dropdown-menu-left ">
                <x-button icon="fas fa-user" class="dropdown-toggle" size="md" text="{{ Auth::user()->name }}"
                    data-toggle="dropdown" aria-expanded="false" id="dropdownMenuButton"></x-button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
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
