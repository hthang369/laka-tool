@extends('layouts.system-admin')

@section('title', 'Danh sách version')

@section('sidebar')
    @parent
@endsection

@section('content')
    @if(session()->has('success'))
        @if(session()->get('success') == true)
            <div class="alert {{session()->get('success') == true ? 'alert-success' : 'alert-danger' }}">
                Deployed to: <strong>server {{old('server')}}</strong>
                <br>
                Environment: <strong>{{old('environment')}}</strong>
                <br>
                Input version: <strong>{{old('version')}}</strong>
                <br>
                Message: <strong> {{session()->get('message')}}</strong>
                <br>
            </div>
            {{session()->forget('_old_input')}}
        @else
            {{session()->forget('_old_input')}}
            <div class="alert alert-danger }}">
                <strong>{{session()->get('message')}}</strong>
            </div>
        @endif
    @endif
    <div class="card mb-5">
        <div class="text-white card-header bg-primary">
            <h2>{{$data['environment']}} </h2>
        </div>
        <div class="card-body ">
            @foreach($data['serverArray'] as $key => $value)

                <div class="well mb-4">
                    <h3>{{$value->server}}</h3>
                    <div class="form-group ">
                        <p>Current version: {{$value->version != null ? $value->version :  'Can\'t get data'}}</p>
                    </div>

                    <x-form method="post" route="version-deploy.deploy">
                        <x-form-group>
                            <x-form-label for="redmine-ticket" class="required">Redmine Ticket:</x-form-label>
                            <x-form-input type="text" 
                                name="{{$value->server.'_redmine_id'}}" 
                                id="redmine-ticket" 
                                placeholder="Input redmine ticket" 
                                required />
                        </x-form-group>
                        <x-form-group>
                            <x-form-label for="deploy-version" class="required">Deploy version:</x-form-label>
                            <x-form-input type="text" 
                                name="{{$value->server.'_version'}}" 
                                id="deploy-version" 
                                placeholder="ID commit / Version" 
                                required />
                        </x-form-group>
                        <input type="hidden" class="form-control" name="server" value="{{$value->server}}">
                        <input type="hidden" class="form-control" name="environment" value="{{$data['environment']}}">
                        @can("add_{$sectionCode}")
                        <x-button variant="primary" :text="Deploy" />    
                        @endcan
                    </x-form>
                </div>
            @endforeach
        </div>

    </div>
@endsection

