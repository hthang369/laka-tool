@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container container-login">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'login']) !!}

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <x-form-input name="email" icon="fa fa-user" prepent value="{{ old('email') }}" autocomplete="email" autofocus />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@icon('fa fa-lock')</span>
                                    </div>
                                    <x-form-input type="password" name="password" autocomplete="current-password" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">@icon('fa fa-eye btn-eye')</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function() {
    $('.btn-eye').on('click', function() {
        let btn = $(this);
        if (btn.hasClass('fa-eye')) {
            btn.addClass('fa-eye-slash').removeClass('fa-eye')
            btn.parents('.input-group').find('.form-control').attr('type', 'text')
        } else {
            btn.addClass('fa-eye').removeClass('fa-eye-slash')
            btn.parents('.input-group').find('.form-control').attr('type', 'password')
        }
    });
})(jQuery);
</script>
@endpush
