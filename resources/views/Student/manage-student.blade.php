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
                                        <li class="breadcrumb-item active">Management Students</li>
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
                                            <table id="bootstrap-data-table-export"
                                                   class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Contact No</th>
                                                    <th>Room No</th>
                                                    <th>Seater</th>
                                                    <th>Hostel Name</th>
                                                    <th>Staying From</th>
{{--                                                    <th>Action</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($bookings as $val)

                                                    <?php
                                                    $student = \App\Models\User::where('id', $val->user_id)->first();
                                                    $name = $student->name;
                                                    $contact = $student->contact;
                                                    $rooms = \App\Models\Room::where('id', $val->room_id)->first();
                                                    $room_no = $rooms->room_no;
                                                    $room_seats = $rooms->room_seats;

                                                    $hoste_name = \App\Models\Hostel::where('id', $val->hostel_id)->pluck('name')->first();

                                                    ?>

                                                        <tr>
                                                            <td>{{ $name }}</td>
                                                            <td>{{ $contact }}</td>
                                                            <td>{{ $room_no }}</td>
                                                            <td>{{ $room_seats }}</td>
                                                            <td>{{ $hoste_name }}</td>
                                                            <td>{{ $val->stay_from }}</td>

{{--                                                            <td>--}}
{{--                                                                <a data-toggle="modal" data-target="#b{{ $val->id }}"--}}
{{--                                                                   class="btn btn-sm btn-warning ck waves-effect waves-light">--}}
{{--                                                                    edit--}}
{{--                                                                </a>--}}
{{--                                                                <a href="{{ route('delete.user', ['id' => $val->id]) }}"--}}
{{--                                                                   class="btn btn-sm btn-danger">delete</a>--}}
{{--                                                            </td>--}}
                                                        </tr>
                                                    <!-- Modal Add Category -->
                                                    <div class="modal fade none-border" id="b{{ $val->id }}">
                                                        <div class="modal-dialog">
                                                            <form method="POST" action="{{ route('update.user') }}">
                                                                @csrf

                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            <strong>Update User</strong>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <input type="hidden" name="user_id"
                                                                                       value="{{ $val->id }}">
                                                                                <label class="control-label">User
                                                                                    Name</label>
                                                                                <input class="form-control form-white"
                                                                                       name="name"
                                                                                       value="{{ $val->name }}"
                                                                                       placeholder=""
                                                                                       type="text"/>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Father
                                                                                    Name</label>
                                                                                <input class="form-control form-white"
                                                                                       name="father_name"
                                                                                       value="{{ $val->father_name }}"
                                                                                       placeholder=""
                                                                                       type="text"/>
                                                                            </div>
                                                                            <div class="col-md-6">

                                                                                <label class="control-label">Email
                                                                                </label>
                                                                                <input class="form-control form-white"
                                                                                       name="email"
                                                                                       value="{{ $val->email }}"
                                                                                       placeholder=""
                                                                                       type="email"/>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Contact
                                                                                </label>
                                                                                <input class="form-control form-white"
                                                                                       name="contact"
                                                                                       value="{{ $val->contact }}"
                                                                                       placeholder=""
                                                                                       type="number"/>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label
                                                                                    class="control-label">Gender</label>
                                                                                <select class="form-control form-white"
                                                                                        name="gender">
                                                                                    <option value="{{ $val->gender }}"
                                                                                            selected>{{ $val->gender }}</option>
                                                                                    <option value="male">Male</option>
                                                                                    <option value="female">Female
                                                                                    </option>
                                                                                    <option value="other">Other</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label class="control-label">Address
                                                                            </label>
                                                                            <textarea class="form-control form-white"
                                                                                      name="address"
                                                                                      value="{{ $val->address }}"
                                                                                      row="4"
                                                                                      type="text"></textarea>

                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label
                                                                                class="control-label">Change Role</label>
                                                                            <select class="form-control form-white"
                                                                                    name="role_id">
                                                                                <option value="{{ $val->role_id }}"
                                                                                        selected>
                                                                                    @if($val->role_id == 2)
                                                                                        Manager
                                                                                    @else
                                                                                        Student
                                                                                    @endif
                                                                                </option>
                                                                                <option value="2">Manager</option>
                                                                                <option value="3">Student
                                                                                </option>
                                                                            </select>
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
