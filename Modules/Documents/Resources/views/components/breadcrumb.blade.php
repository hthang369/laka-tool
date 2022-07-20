@extends('documents::layouts.partial.components')

@section('content_components')
    <section id="example">
        <h2>Example</h2>
        <div class="bd-example">
            <x-breadcrumb :pages="['Admin' => '#', 'Manage' => '']" />
        </div>

        <div class="bd-highlight">
            @php
                $code = '<x-breadcrumb :pages="[\'Admin\' => \'#\', \'Manage\' => \'\']" />';

                echo highlight_code($code, 'html');
            @endphp
        </div>
    </section>
@endsection
