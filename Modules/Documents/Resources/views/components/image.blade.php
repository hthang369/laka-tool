@extends('documents::layouts.partial.components')

@section('content_components')
<section id="example">
    <h2>Example</h2>
    <div class="bd-example">
        <x-image src="https://picsum.photos/1024/400/?image=41" fluid></x-image>
    </div>

    <div class="bd-highlight">
        @php
            $code = '<x-image src="https://picsum.photos/800/400/?image=41" fluid></x-image>';

            echo highlight_code($code, 'html');
        @endphp
    </div>
</section>

@endsection
