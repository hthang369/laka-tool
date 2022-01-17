@extends('layouts.main-page')

@section('content')
    <div class="card-body px-0">
        @section('message_content')
            @if (session('message'))
            <x-alert type="info" dismissible>{{session('message')}}</x-alert>
            @endif
        @show

        {!! $grid->render($data) !!}
    </div>
@endsection

