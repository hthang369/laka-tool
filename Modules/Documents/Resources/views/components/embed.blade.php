@extends('documents::layouts.partial.components')

@section('content_components')
<section id="example">
    <h2>Example</h2>
    <div class="bd-example">
        <x-embed src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></x-embed>
    </div>

    <div class="bd-highlight">
        @php
            $code = '<x-embed src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></x-embed>';

            echo highlight_code($code, 'html');
        @endphp
    </div>
</section>

@endsection
