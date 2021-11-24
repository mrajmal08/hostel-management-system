@extends('layouts.app')

@push('custom-styles')
@endpush

@section('content')

    <div class="unix-login login-bg bg-secondary" >
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-logo">
                            <h1 class="text-white">Hostel Management System</h1>
                        </div>
                        <div class="login-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" placeholder="User Name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" id="email" placeholder="example@example.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" required> Agree the terms and policy
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>

                                <div class="register-link m-t-15 text-center">
                                    <p>Already have account ? <a href="{{ route('login') }}"> Sign in</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('custom-scripts')


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
