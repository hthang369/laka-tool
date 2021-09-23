@extends('layouts.system-admin')

@section('style-css')
    <link rel="stylesheet" href="{{ asset('css/error-page.css') }}" />
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
              <span class="text-danger">Error {{data_get($data,'statusCode')}} :</span>
                {{$message}}
            </h2>
        </div>
    </div>

@endsection
