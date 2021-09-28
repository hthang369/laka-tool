@extends('layouts.full-page')

@section('style-css')
    <link rel="stylesheet" href="{{ asset('css/error-page.css') }}"/>
@endsection
@section('content')
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-bg">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <h1>oops!</h1>
            <h2>
                <span class="text-danger">{{trans('common.error')}} {{data_get($data,'statusCode')}} :</span>
                {{$message}}
            </h2>
            <div class="go-back">
                {!! Form::button(__('common.back'), ['class' => 'btn btn-danger btn-md', 'onclick' => "history.back()"]) !!}
            </div>

        </div>
    </div>

@endsection
