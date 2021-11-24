@extends('layouts.app')

@push('custom-styles')

@endpush

@section('content')

    <div class="unix-login login-bg bg-secondary"  id="particles-js">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-logo">
                            <h1 class="text-white">Hostel Management System</h1>
                        </div>
                        <div class="login-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="example@example.com">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="*******">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
{{--                                <div class="checkbox">--}}
{{--                                    <label class="ml-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                                        <label class="form-check-label" for="remember">--}}
{{--                                            {{ __('Remember Me') }}--}}
{{--                                        </label>--}}
{{--                                    </label>--}}
{{--                                    <label class="pull-right">--}}
{{--                                        @if (Route::has('password.request'))--}}
{{--                                            <a href="{{ route('password.request') }}">--}}
{{--                                                {{ __('Forgot Your Password?') }}--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    </label>--}}
{{--                                </div>--}}
                                <button type="submit" class="btn btn-primary btn-flat ">Sign in</button>

                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="{{ route('register') }}"> Sign Up Here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div id="particles-js"></div>--}}
        </div>
    </div>
@endsection

@push('custom-scripts')




{{--    <script src="{{ asset('assets/js/particle/jquery-3.5.1.min.js') }}"></script>--}}
    <script src="{{ asset('assets/js/particle/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/particle/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/js/particle/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/particle/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/particle/particles.min.js') }}"></script>


    <script src="{{ asset('assets/js/particle/jquery.ripples-min.js') }}"></script>
    <script src="{{ asset('assets/js/particle/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/particle/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/js/particle/form-validator.min.js') }}"></script>


@endpush
