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
                                    <h1>Hello, <span class="text-uppercase">Welcome {{ auth()->user()->name }}</span></h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active">All Rooms</li>
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
                                    <div class="bootstrap-data-table-panel">
                                        <div class="table-responsive">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Room Number</th>
                                                    <th>Rooms Space Available</th>
                                                    <th>Fee Per Student</th>
                                                    <th>Hostel Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($rooms as $val)
                                                    <?php
                                                        $hostel_name = \App\Models\Hostel::where('id', $val->hostel_id)->pluck('name')->first();
                                                    ?>
                                                <tr>
                                                    <td>{{ $val->room_no }} Room</td>
                                                    <td>{{ $val->total_space }} Bed</td>
                                                    <td>{{ $val->fee_per_student }}</td>
                                                    <td>{{ $hostel_name }}</td>
                                                    <td>
                                                        <a data-toggle="modal" data-target="#c{{ $val->id }}"
                                                           class="btn btn-sm btn-warning ck waves-effect waves-light">
                                                            edit
                                                        </a>
                                                        <a href="{{ route('delete.room', ['id' => $val->id]) }}" class="btn btn-sm btn-danger">delete</a>
                                                    </td>
                                                </tr>
                                                <!-- Modal Add Category -->
                                                <div class="modal fade none-border" id="c{{ $val->id }}">
                                                    <div class="modal-dialog">
                                                        <form method="POST" action="{{ route('update.room') }}">
                                                            @csrf

                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">
                                                                        <strong>Update Room</strong>
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input type="hidden" name="room_id"
                                                                                   value="{{ $val->id }}">
                                                                            <label class="control-label">Room
                                                                                Number</label>
                                                                            <input class="form-control form-white"
                                                                                   name="room_no"
                                                                                   value="{{ $val->room_no }}"
                                                                                   placeholder=""
                                                                                   type="number"/>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Room Space Available
                                                                                </label>
                                                                            <select class="js-select2 form-control" id="val-select2"
                                                                                    name="total_space" style="width: 100%;"
                                                                                    >
                                                                                @if($val->total_space)
                                                                                    <option value="{{ $val->total_space }}" selected
                                                                                            disabled>{{ $val->total_space }}</option>
                                                                                @endif
                                                                                <option value="1">Single Bed</option>
                                                                                <option value="2">Two Bed</option>
                                                                                <option value="3">Three Bed</option>
                                                                                <option value="4">Four Bed</option>
                                                                                <option value="5">Five Bed</option>
                                                                            </select>

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Fee Per Student
                                                                            </label>
                                                                            <input class="form-control form-white"
                                                                                   name="fee_per_student"
                                                                                   value="{{ $val->fee_per_student }}"
                                                                                   placeholder=""
                                                                                   type="number"/>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-default waves-effect"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">Update
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- END MODAL -->
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /# card -->
                            </div>
                            <!-- /# column -->
                        </div>
                        <!-- /# row -->

                        @include('layouts.footer')
                    </section>
                </div>
            </div>
        </div>


        @endsection

        @push('custom-scripts')
            <script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
            <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('assets/js/lib/data-table/buttons.flash.min.js') }}"></script>
            <script src="{{ asset('assets/js/lib/data-table/jszip.min.js') }}"></script>
            <script src="{{ asset('assets/js/lib/data-table/pdfmake.min.js') }}"></script>
            <script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js') }}"></script>
            <script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js') }}"></script>
            <script src="{{ asset('assets/js/lib/data-table/datatables-init.js') }}"></script>
    @endpush
