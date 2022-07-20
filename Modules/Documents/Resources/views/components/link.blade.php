@extends('documents::layouts.partial.components')

@section('content_components')
<section id="example">
    <h2>Example</h2>
    <div class="bd-example">
        <x-link to="components.index">Link</x-link>
    </div>

    <div class="bd-highlight">
        @php
            $code = '<x-link to="components.index">Link</x-link>';

            echo highlight_code($code, 'html');
        @endphp
    </div>
</section>

@endsection
