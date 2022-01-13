@extends('layouts.main-page')

@section('content')
    <div class="card-body px-0">
        @foreach (['socket', 'backend', 'frontend', 'api'] as $item)
            @php($versionNumber = data_get($data, "result.versions.{$item}_version"))
            @if(is_null($versionNumber))
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> No Socket Version Found.
                </div>
            @else
                <div class="alert alert-success" role="alert">
                    <span class="badge badge-success">@lang("version.{$item}_version") </span> {{$versionNumber}}
                </div>
            @endif
        @endforeach
    </div>

@endsection

