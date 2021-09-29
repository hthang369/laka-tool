@extends('layouts.system-admin')

@section('title', ' ')

@section('sidebar')
    @parent


@endsection

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            <strong>@lang('custom_message.update_password_success')</strong>
        </div>
    @endif
    <div class="card">
        <h5 class="card-header">Update your password</h5>
        <div class="card-body">
            <form action="{{ route('LMT user manage.Update Password') }}" method="POST" >
                @csrf
                <div class="form-group">
                    <label>Current password</label>
                    <input name="currentPassword" type="password"
                           class="form-control @error('currentPassword') is-invalid @enderror" placeholder="Current password">
                    @error('currentPassword')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @if(session()->has('wrongCurrentPassword'))
                        <div class="alert alert-danger">
                            <strong>@lang('custom_message.wrong_password')</strong>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>New password</label>
                    <input name="newPassword" type="password"
                           class="form-control @error('newPassword') is-invalid @enderror" placeholder="New password">
                    @error('newPassword')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm password</label>
                    <input name="confirmPassword" type="password"
                           class="form-control @error('confirmPassword') is-invalid @enderror form-control" placeholder="Confirm password">
                    @error('confirmPassword')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-danger ml-2" href="/system-admin/user-management" role="button">@lang('common.cancel')</a>
            </form>
        </div>
    </div>
@endsection
