@extends('documents::layouts.partial.components')

@section('content_components')
<section id="example">
    <h2>Example</h2>
    <div class="bd-example">
        <x-card header="Card header" title="Card Title">
            <x-card-text>
                Some quick example text to build on the card title and make up the bulk of the card's content.
            </x-card-text>
        </x-card>
    </div>

    <div class="bd-highlight">
        @php
            $code = '<x-card header="Card header" title="Card Title">
    <x-card-text>
        Some quick example text to build on the card title and make up the bulk of the card\'s content.
    </x-card-text>
</x-card>';

            echo highlight_code($code, 'html');
        @endphp
    </div>
</section>

@endsection
