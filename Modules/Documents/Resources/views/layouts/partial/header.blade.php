<x-navbar type="dark" variant="dark" sticky toggleable="lg">
    <div class="container-fluid">
        <x-navbar-brand href="/">
            <img class="logo" src="{{asset('/images/logo-official.png')}}" alt="logo">
            <span class="logo-name"> Management Tool</span>
        </x-navbar-brand>

        <x-navbar-toggle target="navbarNavDropdown" />

        <x-navbar-nav>
            <x-nav-item to="docs.index">Docs</x-nav-item>
            <x-nav-item to="components.index">Components</x-nav-item>
        </x-navbar-nav>
    </div>
</x-navbar>
