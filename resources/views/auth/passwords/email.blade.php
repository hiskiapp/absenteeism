@extends('layouts.auth')

@section('content')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
    <div class="auth-box">
        <div>
            <div class="logo">
                <span class="db"><img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo" /></span>
                <h5 class="font-medium m-b-20">{{ __('Reset Password') }}</h5>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal m-t-20" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" required="" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info" type="submit">{{ __('Send Password Reset Link') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection