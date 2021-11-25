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
                                    <li class="breadcrumb-item active">Rooms Detail</li>
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
                                        <table id="bootstrap-data-table-export" class="table  table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <h4>Room Info</h4>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Room no :</b></td>
                                                <td>{{ $room_detail->room_no }}</td>
                                                <td><b>Seater :</b></td>
                                                <td>{{ $room_detail->room_seats }}</td>
                                                <td><b>Fees PM :</b></td>
                                                <td>{{ $room_detail->fee_per_student }}</td>
                                            </tr>

                                            <tr>
                                                <td><b>Food Status:</b></td>
                                                <td>
                                                    @if($booking_detail->food_status == '0')
                                                        Without Food
                                                    @else
                                                    {{ $booking_detail->food_status }} Food Fees
                                                    @endif
                                                </td>
                                                <td><b>Stay From :</b></td>
                                                <td>{{ $booking_detail->stay_from }}</td>
                                                <td><b>Monthly Amount</b></td>
                                                <td>{{ $booking_detail->total_amount }}</td>
                                            </tr>

                                            <tr>
                                                <td colspan="6"><b>Total Fee :
                                                        </b></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <h4>Personal Info</h4>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Full Name :</b></td>
                                                <td>{{ $user_detail->name }}</td>
                                                <td><b>Father Name :</b></td>
                                                <td>{{ $user_detail->father_name }}</td>
                                                <td><b>Email :</b></td>
                                                <td>{{ $user_detail->email }}</td>
                                            </tr>


                                            <tr>
                                                <td><b>Contact No. :</b></td>
                                                <td>{{ $user_detail->contact }}</td>
                                                <td><b>Gender :</b></td>
                                                <td>{{ $user_detail->gender }}</td>
                                                <td><b>Course :</b></td>
                                                <td>{{ $course_detail->name }}</td>
                                            </tr>


                                            <tr>
                                                <td><b>Emergency Contact No. :</b></td>
                                                <td>{{ $booking_detail->emergency_contact }}</td>
                                                <td><b>Guardian Name :</b></td>
                                                <td>{{ $booking_detail->guardian_name }}</td>
                                                <td><b>Guardian Relation :</b></td>
                                                <td>{{ $booking_detail->guardian_relation }}</td>
                                            </tr>

                                            <tr>
                                                <td><b>Guardian Contact No. :</b></td>
                                                <td colspan="6">
                                                    <div class="text-left">
                                                    {{ $booking_detail->guardian_contact }}
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <h4>Addresses</h4>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Correspondence Address</b></td>
                                                <td colspan="2">
                                                    {{ $user_detail->address }}<br />
                                                    {{ $booking_detail->zip_code }}<br />
                                                    {{ $booking_detail->city }} <br />
                                                    {{ $booking_detail->state }}

                                                </td>
                                                <td><b>Permanent Address</b></td>
                                                <td colspan="2">
                                                    <div class="text-left">
                                                    {{ $booking_detail->permanent_address }}<br />
                                                    {{ $booking_detail->zip_code }}<br />
                                                    {{ $booking_detail->city }} <br />
                                                    {{ $booking_detail->state }}
                                                    </div>
                                                </td>
                                            </tr>


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
