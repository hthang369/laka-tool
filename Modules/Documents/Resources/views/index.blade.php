@extends('documents::layouts.master')

@section('content')
    <div class="">
        @foreach ($data as $item)
            <h4>@lang($item['text'])</h4>

            <nav class="list-group">
                @foreach ($item['children'] as $subItem)
                    <a href="{{route($subItem['route'])}}" class="list-group-item">
                        <span class="text-primary">{{$subItem['name']}}</span>
                        <span>---</span>
                        <span class="text-muted">{{$subItem['summary']}}</span>
                    </a>
                @endforeach
            </nav>
        @endforeach
    </div>
@endsection
