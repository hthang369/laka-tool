<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="navbar-brand d-flex align-items-center"  href="/">
                <img class="logo" src="{{asset('/images/logo-official.png')}}" alt="logo">
                <span class="logo-name"> Management Tool</span>
            </a>
            <button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        @include(layouts_path('home', 'partial.authentication'))
    </div>
</nav>
