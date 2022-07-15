@extends('documents::layouts.master')

@section('content')
    <div class="">
        <header>
            <h2>{{ $data['name'] }}</h2>
            <span>{{ head($data['summary']) }}</span>
        </header>

        @yield('content_components')

        @foreach ($grid as $gridItem)
            <h3>Properties {{$gridItem->getName()}}</h3>
            @php
                $idx = key(array_where($data['component'], function ($value) use($gridItem) {
                    return ends_with($value, $gridItem->getName());
                })) ?? 0;
            @endphp
            {!! $gridItem->render($data['properties'][$idx]) !!}
        @endforeach
    </div>
@endsection
