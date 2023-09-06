@extends('layouts.font')

@section('content')
<div class="app-container">
    <div class="h-100">
        <div class="h-100 g-0 row">
            <div class="d-none d-lg-block col-lg-4">
                <div class="slider-light">
                    <div class="slick-slider">
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url('images/originals/city.jpg');"></div>
                                <div class="slider-content">
                                    <h1>Mahathep Auto</h1>
                                    <p>
                                        Pull Data Ato
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url('images/originals/citynights.jpg');"></div>
                                <div class="slider-content">
                                    <h1>Mahathep Auto</h1>
                                    <p>
                                       Check Sit Auto
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url('images/originals/citydark.jpg');"></div>
                                <div class="slider-content">
                                    <h1>Mahathep Auto</h1>
                                    <p>We are Mahathep</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                    {{-- <div class="app-logo"></div> --}}
                    <div>
                        {{-- <img width="150" class="rounded mb-5" src="{{ asset('distemplate/images/dataaudit.jpg') }}" alt=""> --}}

                    </div>
                    <h4 class="mb-0">
                        <span class="d-block">
                            {{-- <h1>Welcome</h1><h1>Mahathep</h1><h1>-</h1><h1>Auto</h1> --}}
                            <h1> Welcome Mahathep-Auto </h1>
                        </span>
                        {{-- <span>Please sign in to your account.</span> --}}
                    </h4>
                    <h6 class="mt-3">No account?
                        <a href="{{ route('register') }}" class="text-primary">Sign up now</a>
                    </h6>
                    <div class="divider row"></div>
                    <div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body"> --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
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
                        </div> --}}

                        <div class="">
                            <div class="col-md-6">
                                <div class="position-relative mb-3">
                                    <label for="username" class="form-label">Username</label>
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative mb-3">
                                    <label for="examplePassword" class="form-label">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-check mb-3">
                            <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                            <label for="exampleCheck" class="form-label form-check-label">Keep me logged in</label>
                        </div>
                        <div class="divider row"></div>
                        <div class="d-flex align-items-center">
                            <div class="ms-auto"> 
                                {{-- <button class="me-2 btn-icon btn-shadow btn-dashed btn btn-outline-info">
                                    <i class="pe-7s-refresh btn-icon-wrapper"></i>Recover Password
                                </button> --}}
                                <button type="submit" class="me-2 btn-icon btn-shadow btn-dashed btn btn-outline-success">
                                    <i class="pe-7s-shuffle btn-icon-wrapper"></i>Login
                                </button>
                                <a href="{{url('datahosauto')}}" class="me-2 btn-icon btn-shadow btn-dashed btn btn-outline-primary">
                                    <i class="pe-7s-shuffle btn-icon-wrapper"></i>Auto System
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
