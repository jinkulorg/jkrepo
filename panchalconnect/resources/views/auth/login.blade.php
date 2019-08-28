@extends('layouts.app')

@section('content')

<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/index"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Login</li>
            </ul>
        </div>
        <div class="services">
            <div class="col-sm-6 login_left">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-item form-type-textfield form-item-name">
                        <label for="email">{{ __('Email Address') }}<span class="form-required" title="This field is required.">*</span></label>
                        <input id="email" type="email" size="60" maxlength="60" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-item form-type-textfield form-item-name">
                        <label for="password">{{ __('Password') }}<span class="form-required" title="This field is required.">*</span></label>
                        <input id="password" type="password" size="60" maxlength="60" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="form-item form-type-textfield form-item-name">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn_1 submit">
                                {{ __('Login') }}
                            </button>
                            


                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
                <a href = "/register"><button type="submit" class="btn_1 submit">
                                {{ __('Register') }}
                            </button></a>
            </div>
            <div class="col-sm-6">
                <ul class="sharing">
                    <li><a href="#" class="facebook" title="Facebook"><i class="fa fa-boxed fa-fw fa-facebook"></i> Share on Facebook</a></li>
                    <li><a href="#" class="twitter" title="Twitter"><i class="fa fa-boxed fa-fw fa-twitter"></i> Tweet</a></li>
                    <li><a href="#" class="google" title="Google"><i class="fa fa-boxed fa-fw fa-google-plus"></i> Share on Google+</a></li>
                    <li><a href="#" class="linkedin" title="Linkedin"><i class="fa fa-boxed fa-fw fa-linkedin"></i> Share on LinkedIn</a></li>
                    <li><a href="#" class="mail" title="Email"><i class="fa fa-boxed fa-fw fa-envelope-o"></i> E-mail</a></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
@endsection