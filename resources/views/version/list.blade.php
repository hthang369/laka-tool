@extends('layouts.system-admin')

@section('title', $titlePage)

@section('content')
    <!-- TITLE -->
    @section('header_page')
        <h2 class="card-header px-0">
            @lang($headerPage)
        </h2>
    @show
        
    <div class="card-body px-0">
        @foreach (['socket', 'backend', 'frontend', 'api'] as $item)
            @if(data_get($data, "versions.{$item}_version") == null)
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> No Socket Version Found.
                </div>
            @else
                <div class="alert alert-success" role="alert">
                    <span class="badge badge-success">@lang("version.{$item}_version") </span> {{data_get($data, "versions.{$item}_version")}}
                </div>
            @endif
        @endforeach
    </div>

@endsection

