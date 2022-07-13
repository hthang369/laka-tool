@extends('documents::layouts.partial.components')

@section('content_components')
    <section id="example">
        <h2>Examples</h2>
        <div class="">
            <x-badge variant="primary">A simple primary badge</x-badge>
            <x-badge variant="secondary" text="A simple secondary badge" />
            <x-badge variant="success">A simple success badge</x-badge>
            <x-badge variant="danger">A simple danger badge</x-badge>
            <x-badge variant="warning">A simple warning badge</x-badge>
            <x-badge variant="info">A simple info badge</x-badge>
            <x-badge variant="light">A simple light badge</x-badge>
            <x-badge variant="dark">A simple dark badge</x-badge>
        </div>

        <div class="bd-example">
            <x-badge pill variant="primary">A simple primary badge</x-badge>
            <x-badge pill variant="secondary" text="A simple secondary badge" />
            <x-badge pill variant="success">A simple success badge</x-badge>
            <x-badge pill variant="danger">A simple danger badge</x-badge>
            <x-badge pill variant="warning">A simple warning badge</x-badge>
            <x-badge pill variant="info">A simple info badge</x-badge>
            <x-badge pill variant="light">A simple light badge</x-badge>
            <x-badge pill variant="dark">A simple dark badge</x-badge>
        </div>

    </section>
@endsection
