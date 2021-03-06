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
                                    <h1 class="text-uppercase">Add a Room</h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Room</li>
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
                                            <form class="form-valide" action="{{ route('create.room') }}" method="POST">
                                                @csrf

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Select
                                                        Hostel
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <select class="js-select2 form-control" id="val-select2"
                                                                name="hostel_id" style="width: 100%;"
                                                                >
                                                            <option selected disabled>--Select Hostel--</option>
                                                            @foreach($hostels as $val)
                                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                           @endforeach

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Room
                                                        No.<span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-username"
                                                               name="room_no" placeholder="Enter Room No">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Select
                                                        Seater
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <select class="js-select2 form-control" id="val-select2"
                                                                name="room_seats" style="width: 100%;"
                                                                data-placeholder="Choose one..">
                                                            <option selected disabled>--Select Seats--</option>
                                                            <option value="1">Single Seater</option>
                                                            <option value="2">Two Seater</option>
                                                            <option value="3">Three Seater</option>
                                                            <option value="4">Four Seater</option>
                                                            <option value="5">Five Seater</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-select2">Fee(Per
                                                        Student)
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="number" class="form-control" id="val-username"
                                                               name="fee_per_student">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary btn-block">Add
                                                            Room
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
