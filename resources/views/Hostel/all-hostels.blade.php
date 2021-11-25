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
                                    <h1>Hello, <span class="text-uppercase">Welcome {{ auth()->user()->name }}</span>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active">All Hostels</li>
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
                    <section id="main-content" class="card">
                        <form method="POST" action="{{ route('assign.manger') }}" >
                            @csrf
                        <div class="row">
                            <div class="col-md-4 p-l-0 title-margin-left">
                                <div class="page-header">
                                    <div class="page-title">
                                        <h4>Assign Hostel to Manager</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 p-l-0 title-margin-left  mt-2">
                                <select class="form-control form-white"
                                        name="hostel_id">
                                    <option selected disabled
                                    >-- select hostel --</option>
                                @foreach($hostels as $val)
                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 p-l-0 title-margin-left  mt-2">
                                <select class="form-control form-white"
                                        name="user_id">
                                    <option selected disabled
                                    >-- select manager --</option>
                                    @foreach($mangers as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 p-l-0 title-margin-left  mt-2">
                                <input class="form-control btn"
                                       type="submit" value="Assign" style="background-color: green;color: white;" />

                            </div>
                        </div>
                        </form>
                    </section>

                    <section id="main-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="bootstrap-data-table-panel">
                                        <div class="table-responsive">
                                            <table id="bootstrap-data-table-export"
                                                   class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Hostel Name</th>
                                                    <th>Location</th>
                                                    <th>Contact</th>
                                                    <th>City</th>
                                                    <th>State</th>
                                                    <th>Assigned To</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($hostels as $val)
                                                    <?php
                                                    $manger = \App\Models\User::where('role_id', $val->user_id)->pluck('name')->first();
                                                    ?>


                                                    <tr>
                                                        <td>{{ $val->name }} Room</td>
                                                        <td>{{ $val->location }} Bed</td>
                                                        <td>{{ $val->contact }}</td>
                                                        <td>{{ $val->city }}</td>
                                                        <td>{{ $val->state }}</td>
                                                        <td>{{ $manger }}</td>
                                                        <td>
                                                            <a data-toggle="modal" data-target="#d{{ $val->id }}"
                                                               class="btn btn-sm btn-warning ck waves-effect waves-light">
                                                                edit
                                                            </a>
                                                            <a href="{{ route('delete.hostel', ['id' => $val->id]) }}"
                                                               class="btn btn-sm btn-danger">delete</a>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Add Category -->
                                                    <div class="modal fade none-border" id="d{{ $val->id }}">
                                                        <div class="modal-dialog">
                                                            <form method="POST" action="{{ route('update.hostel') }}">
                                                                @csrf

                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            <strong>Update Hostel</strong>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <input type="hidden" name="hostel_id"
                                                                                       value="{{ $val->id }}">
                                                                                <label class="control-label">Hostel Name
                                                                                </label>
                                                                                <input class="form-control form-white"
                                                                                       name="name"
                                                                                       value="{{ $val->name }}"
                                                                                       placeholder=""
                                                                                       type="text"/>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Hostel
                                                                                    Location
                                                                                </label>
                                                                                <input class="form-control form-white"
                                                                                       name="location"
                                                                                       value="{{ $val->location }}"
                                                                                       placeholder=""
                                                                                       type="text"/>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Hostel
                                                                                    Contact
                                                                                </label>
                                                                                <input class="form-control form-white"
                                                                                       name="contact"
                                                                                       value="{{ $val->contact }}"
                                                                                       placeholder=""
                                                                                       type="text"/>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">City
                                                                                </label>
                                                                                <input class="form-control form-white"
                                                                                       name="city"
                                                                                       value="{{ $val->city }}"
                                                                                       placeholder=""
                                                                                       type="text"/>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">State
                                                                                </label>
                                                                                <input class="form-control form-white"
                                                                                       name="state"
                                                                                       value="{{ $val->state }}"
                                                                                       placeholder=""
                                                                                       type="text"/>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Country
                                                                                </label>
                                                                                <input class="form-control form-white"
                                                                                       name="country"
                                                                                       value="{{ $val->country }}"
                                                                                       placeholder=""
                                                                                       type="text"/>
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
