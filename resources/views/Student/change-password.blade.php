@extends('layouts.app')

@push('custom-styles')
@endpush

@section('content')

    @include('layouts.sidebar')
    <!-- /# sidebar -->

    <div class="header">
        @include('layouts.navbar')

        <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 p-r-0 title-margin-right">
                            <div class="page-header">
                                <div class="page-title">
                                    <h1 class="text-uppercase">{{ auth()->user()->name }} Profile</h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Profile</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif

                    </div>
                    <!-- /# row -->
                    <section id="main-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-validation">
                                            <form class="form-valide" action="{{ route('update.password') }}"
                                                  method="POST">
                                                @csrf
                                                <div class="form-group row">
                                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                                    <label class="col-lg-4 col-form-label" for="val-password">Old
                                                        Password
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="password" class="form-control" id="val-password"
                                                               name="password" placeholder="old password" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-password">New
                                                        Password
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="password" class="form-control" id="txtNewPassword"
                                                               name="new_password" placeholder="Choose a safe one.." required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">Confirm
                                                        Password <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="password" class="form-control"
                                                               id="txtConfirmPassword"
                                                               name="confirm_password"
                                                               placeholder="..and confirm it!" required>

                                                    </div>

                                                </div>

                                                <div class="form-group update-btn row ">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary btn-block">Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('layouts.footer')
                    </section>
                </div>
            </div>
        </div>



@endsection

@push('custom-scripts')
@endpush
