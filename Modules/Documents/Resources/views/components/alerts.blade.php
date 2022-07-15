@extends('documents::layouts.partial.components')

@section('content_components')
    <section id="example">
        <h2>Examples</h2>
        <div class="bd-example">
            <x-alert type="primary">A simple primary alert</x-alert>
            <x-alert type="secondary" message="A simple secondary alert" />
            <x-alert type="success" dismissible>A simple success alert</x-alert>
            <x-alert type="danger">A simple danger alert</x-alert>
            <x-alert type="warning">A simple warning alert</x-alert>
            <x-alert type="info">A simple info alert</x-alert>
            <x-alert type="light">A simple light alert</x-alert>
            <x-alert type="dark">A simple dark alert</x-alert>
        </div>
        <div class="bd-highlight">
        @php
            $code = '<div>
    <x-alert type="primary">A simple primary alert</x-alert>
    <x-alert type="secondary" message="A simple secondary alert" />
    <x-alert type="success" dismissible>A simple success alert</x-alert>
    <x-alert type="danger">A simple danger alert</x-alert>
    <x-alert type="warning">A simple warning alert</x-alert>
    <x-alert type="info">A simple info alert</x-alert>
    <x-alert type="light">A simple light alert</x-alert>
    <x-alert type="dark">A simple dark alert</x-alert>
</div>';

            echo highlight_code($code, 'html');
        @endphp
        </div>
    </section>

@endsection
