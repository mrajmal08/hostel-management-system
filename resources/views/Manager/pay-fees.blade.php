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
                                    <h1 style="color: red">Pay Your Hostel Fees Between Date (1 to 5) on every
                                        month otherwise you may be eliminated from hostel</h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Hostel</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->

                        <?php
                        $notification = \App\Models\StudentDue::where('user_id', auth()->user()->id)->pluck('notification')->first();

                        ?>
                        @if($notification)
                            <div class="alert alert-danger">
                                {{ $notification }}
                            </div>
                        @endif


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
                                <div class="mb-3">
                                    <span class="alert alert-success">Your monthly fees is {{ $monthly_fees }} </span>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-validation">
                                            <form class="form-valide" action="{{ route('fees.submit') }}" method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username"> Total
                                                        Fees in numbers
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="number" class="form-control" id="val-username"
                                                               name="fees" required/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username"> Upload
                                                        Screen Shot
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="hidden" name="user_id"
                                                               value="{{ auth()->user()->id }}">
                                                        <input type="file" class="form-control" id="val-username"
                                                               name="image" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            Post Screen Shot Of Payable slip
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

    {{--        <script>--}}
    {{--            $(document).ready(function () {--}}
    {{--                $(function() {--}}
    {{--                    $( "#datepicker" ).datepicker({dateFormat: 'yy'});--}}
    {{--                });--}}

    {{--            });--}}

    {{--        </script>--}}

@endsection

@push('custom-scripts')

@endpush
