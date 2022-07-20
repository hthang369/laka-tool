@extends('documents::layouts.partial.components')

@section('content_components')
<section id="example">
    <h2>Example</h2>
    <div class="bd-example">
        <x-carousel :control="true" :indicators="true" id="demo" :items="[
                [
                    'image' => ['src' => 'https://picsum.photos/1024/480/?image=52'],
                    'content' => '<div class=\'carousel-caption\'>Nulla vitae elit libero, a pharetra augue mollis interdum.</div>'
                ],
                [
                    'image' => ['src' => 'https://picsum.photos/1024/480/?image=54'],
                    'content' => '<div class=\'carousel-caption\'>Nulla vitae elit libero, a pharetra augue mollis interdum.</div>'
                ],
                [
                    'image' => ['src' => 'https://picsum.photos/1024/480/?image=58'],
                    'content' => '<div class=\'carousel-caption\'>Nulla vitae elit libero, a pharetra augue mollis interdum.</div>'
                ]
            ]">
        </x-carousel>
    </div>

    <div class="bd-highlight">
        @php
            $code = '<x-carousel :control="true" :indicators="true" id="demo" :items="[
        [
            \'image\' => [\'src\' => \'https://picsum.photos/1024/480/?image=52\'],
            \'content\' => \'<div class=\'carousel-caption\'>Nulla vitae elit libero, a pharetra augue mollis interdum.</div>\'
        ],
        [
            \'image\' => [\'src\' => \'https://picsum.photos/1024/480/?image=54\'],
            \'content\' => \'<div class=\'carousel-caption\'>Nulla vitae elit libero, a pharetra augue mollis interdum.</div>\'
        ],
        [
            \'image\' => [\'src\' => \'https://picsum.photos/1024/480/?image=58\'],
            \'content\' => \'<div class=\'carousel-caption\'>Nulla vitae elit libero, a pharetra augue mollis interdum.</div>\'
        ]
    ]">
</x-carousel>';

            echo highlight_code($code, 'html');
        @endphp
    </div>
</section>



@endsection
