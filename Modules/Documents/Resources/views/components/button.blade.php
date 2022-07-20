@extends('documents::layouts.partial.components')

@section('content_components')
    <section id="example">
        <h2>Example</h2>
        <div class="bd-example">
            <x-button text="Button default" />
            <x-button variant="info">Button info</x-button>
            <x-button variant="outline-primary">Button info</x-button>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-button text="Button default" />
            <x-button variant="info">Button info</x-button>
            <x-button variant="outline-primary">Button info</x-button>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>

    <section id="example">
        <h2>Type</h2>
        <div class="bd-example">
            You can specify the button's type by setting the prop type to <span class="hljs-string">'button'</span>, <span class="hljs-string">'submit'</span> or <span class="hljs-string">'reset'</span>. The default type is 'button'.

            Note the type prop has no effect when either href or to props are set.
        </div>
    </section>

    <section id="example">
        <h2>Sizing</h2>
        <div class="bd-example">
            <x-button text="Small button" size="sm" />
            <x-button>Default button</x-button>
            <x-button size="lg">Large buttons</x-button>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-button text="Button default" size="sm" />
            <x-button>Button info</x-button>
            <x-button size="lg">Button info</x-button>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>

    <section id="example">
        <h2>Solid color variants</h2>
        <div class="bd-example">
            <x-button variant="primary">Primary</x-button>
            <x-button variant="secondary">Secondary</x-button>
            <x-button variant="success">Success</x-button>
            <x-button variant="danger">Danger</x-button>
            <x-button variant="warning">Warning</x-button>
            <x-button variant="info">Info</x-button>
            <x-button variant="light">Light</x-button>
            <x-button variant="dark">Dark</x-button>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-button variant="primary">Primary</x-button>
            <x-button variant="secondary">Secondary</x-button>
            <x-button variant="success">Success</x-button>
            <x-button variant="danger">Danger</x-button>
            <x-button variant="warning">Warning</x-button>
            <x-button variant="info">Info</x-button>
            <x-button variant="light">Light</x-button>
            <x-button variant="dark">Dark</x-button>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>

    <section id="example">
        <h2>Outline color variants</h2>
        <div class="bd-example">
            <x-button variant="outline-primary">Primary</x-button>
            <x-button variant="outline-secondary">Secondary</x-button>
            <x-button variant="outline-success">Success</x-button>
            <x-button variant="outline-danger">Danger</x-button>
            <x-button variant="outline-warning">Warning</x-button>
            <x-button variant="outline-info">Info</x-button>
            <x-button variant="outline-light">Light</x-button>
            <x-button variant="outline-dark">Dark</x-button>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-button variant="outline-primary">Primary</x-button>
            <x-button variant="outline-secondary">Secondary</x-button>
            <x-button variant="outline-success">Success</x-button>
            <x-button variant="outline-danger">Danger</x-button>
            <x-button variant="outline-warning">Warning</x-button>
            <x-button variant="outline-info">Info</x-button>
            <x-button variant="outline-light">Light</x-button>
            <x-button variant="outline-dark">Dark</x-button>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>

    <section id="example">
        <h2>Link variants</h2>
        <div class="bd-example">
            <x-button variant="link">Link</x-button>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-button variant="link">Link</x-button>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>

    <section id="example">
        <h2>Block level buttons</h2>
        <div class="bd-example">
            <x-button block variant="primary">Block level button</x-button>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-button block variant="primary">Block level button</x-button>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>

    <section id="example">
        <h2>Pill style</h2>
        <div class="bd-example">
            <x-button pill variant="primary">Primary</x-button>
            <x-button pill variant="secondary">Secondary</x-button>
            <x-button pill variant="success">Success</x-button>
            <x-button pill variant="danger">Danger</x-button>
            <x-button pill variant="warning">Warning</x-button>
            <x-button pill variant="info">Info</x-button>
            <x-button pill variant="light">Light</x-button>
            <x-button pill variant="dark">Dark</x-button>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-button pill variant="primary">Primary</x-button>
            <x-button pill variant="secondary">Secondary</x-button>
            <x-button pill variant="success">Success</x-button>
            <x-button pill variant="danger">Danger</x-button>
            <x-button pill variant="warning">Warning</x-button>
            <x-button pill variant="info">Info</x-button>
            <x-button pill variant="light">Light</x-button>
            <x-button pill variant="dark">Dark</x-button>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>

    <section id="example">
        <h2>Squared style</h2>
        <div class="bd-example">
            <x-button squared variant="primary">Primary</x-button>
            <x-button squared variant="secondary">Secondary</x-button>
            <x-button squared variant="success">Success</x-button>
            <x-button squared variant="danger">Danger</x-button>
            <x-button squared variant="warning">Warning</x-button>
            <x-button squared variant="info">Info</x-button>
            <x-button squared variant="light">Light</x-button>
            <x-button squared variant="dark">Dark</x-button>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-button squared variant="primary">Primary</x-button>
            <x-button squared variant="secondary">Secondary</x-button>
            <x-button squared variant="success">Success</x-button>
            <x-button squared variant="danger">Danger</x-button>
            <x-button squared variant="warning">Warning</x-button>
            <x-button squared variant="info">Info</x-button>
            <x-button squared variant="light">Light</x-button>
            <x-button squared variant="dark">Dark</x-button>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>

    <section id="example">
        <h2>Disabled state</h2>
        <div class="bd-example">
            <x-button disabled variant="primary">Disabled</x-button>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-button disabled variant="primary">Disabled</x-button>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>
@endsection
