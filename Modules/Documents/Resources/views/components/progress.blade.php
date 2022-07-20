@extends('documents::layouts.partial.components')

@section('content_components')

    <section id="example">
        <h2>Example</h2>
        <div class="bd-example">
            <x-progress :value="30" :max="100" show-progress animated></x-progress>
            <x-progress class="mt-2" :max="100" show-value>
                <x-progress-bar :value="30" variant="success" show-value></x-progress-bar>
                <x-progress-bar :value="20" variant="warning" show-value></x-progress-bar>
                <x-progress-bar :value="10" variant="danger" show-value></x-progress-bar>
            </x-progress>
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-progress :value="30" :max="100" show-progress animated></x-progress>
<x-progress class="mt-2" :max="100" show-value>
    <x-progress-bar :value="30" variant="success" show-value></x-progress-bar>
    <x-progress-bar :value="20" variant="warning" show-value></x-progress-bar>
    <x-progress-bar :value="10" variant="danger" show-value></x-progress-bar>
</x-progress>';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>
@endsection
