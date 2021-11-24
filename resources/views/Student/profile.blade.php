@extends('layouts.app')

@push('custom-styles')
    <link href="{{ asset('assets/css/lib/data-table/buttons.bootstrap.min.css') }}" rel="stylesheet"/>
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
                                            <form class="form-valide" action="{{ route('update.profile') }}" method="POST">
                                                @csrf
                                                <div class="form-group row">
                                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Username
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-username"
                                                               name="name" value="{{ auth()->user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Father
                                                        Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-username"
                                                               name="father_name" placeholder="Enter your Father Name" value="{{ auth()->user()->father_name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="email" class="form-control" id="val-email"
                                                               name="email" value="{{ auth()->user()->email }}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-select2">Gender
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <select class="js-select2 form-control" id="val-select2"
                                                                name="gender" style="width: 100%;"
                                                                data-placeholder="Choose one..">
                                                            @if(auth()->user()->gender)
                                                            <option value="{{ auth()->user()->gender }}" selected disabled>{{ auth()->user()->gender }}</option>
                                                            @endif
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            <option value="other">Other</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Address
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-suggestions"
                                                                  name="address" rows="5"
                                                                  placeholder="Enter your address..." value="{{ auth()->user()->address }}" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Contact
                                                        Number<span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="number" class="form-control" id="val-phoneus"
                                                               name="contact" placeholder="212-999-0000" value="{{ auth()->user()->contact }}" ></div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
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
