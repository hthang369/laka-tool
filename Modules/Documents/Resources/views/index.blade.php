@extends('documents::layouts.master')

@section('content')
    <div class="">
        @foreach ($data as $item)
            <h4>@lang($item['text'])</h4>

            <nav class="list-group">
                @foreach ($item['children'] as $subItem)
                    <span>{{$subItem}}</span>
                @endforeach
            </nav>
        @endforeach
    </div>
@endsection
