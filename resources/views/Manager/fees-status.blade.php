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
                                        <li class="breadcrumb-item active">Fees Status</li>
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
                                                    <th>Hostel Name</th>
                                                    <th>Room No</th>
                                                    <th>Monthly Fees</th>
                                                    <th>Payed Date</th>
                                                    <th>Screen Shot</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($student_dues as $val)
                                                    <?php
                                                    $hostel = \App\Models\BookHostel::where('user_id', $val->user_id)->first();
                                                    $hostel_id = $hostel->hostel_id;
                                                    $hostel_name = \App\Models\Hostel::where('id', $hostel_id)->pluck('name')->first();
                                                    $monthly_fees = $hostel->total_amount;
                                                    $room = \App\Models\Room::where('hostel_id', $hostel_id)->first();
                                                    $room_no = $room->room_no;

                                                    ?>
                                                    <tr>
                                                        <td>{{ $hostel_name }}</td>
                                                        <td>{{ $room_no }}</td>
                                                        <td>{{ $monthly_fees }}</td>
                                                        <td>{{ $val->date }}</td>
                                                        <td><img data-enlargeable width="100" style="cursor: zoom-in" src="{{ asset("images/".$val->screen_shot) }}" alt="screen shot"></td>
                                                        <td>{{ $val->status }}</td>
                                                        <td>
                                                            @if(auth()->user()->id == 3)
                                                            @else
                                                            <a data-toggle="modal" data-target="#c{{ $val->id }}"
                                                               class="btn btn-sm btn-warning ck waves-effect waves-light">
                                                                edit
                                                            </a>
                                                                @if($val->notification == null)
                                                                <a data-toggle="modal" data-target="#g{{ $val->id }}"
                                                                   class="btn btn-sm btn-danger ck waves-effect waves-light">
                                                                    Send Reason
                                                                </a>
                                                                @else
                                                                    <a href="{{ route('delete.notification', ['id' => $val->id]) }}" class="btn btn-sm btn-danger">remove notification</a>

                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Add Category -->
                                                    <div class="modal fade none-border" id="c{{ $val->id }}">
                                                        <div class="modal-dialog">
                                                            <form method="POST" action="{{ route('update.fees_status') }}">
                                                                @csrf

                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            <strong>Update Fees Status</strong>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <input type="hidden" name="user_id"
                                                                                       value="{{ $val->id }}">

                                                                                <label class="control-label">Update Status
                                                                                    </label>

                                                                                <select class="js-select2 form-control" id="val-select2"
                                                                                        name="status" style="width: 100%;"
                                                                                >
                                                                                    @if($val->status)
                                                                                        <option value="{{ $val->status }}" selected
                                                                                                disabled>{{ $val->status }}</option>
                                                                                    @endif
                                                                                    <option value="Not Verified">Not Verified</option>
                                                                                    <option value="Verified">Verified</option>

                                                                                </select>
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

                                                    <!-- Modal Add Category -->
                                                    <div class="modal fade none-border" id="g{{ $val->id }}">
                                                        <div class="modal-dialog">
                                                            <form method="POST" action="{{ route('send.notification') }}">
                                                                @csrf

                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            <strong>Send any notification to this student</strong>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <input type="hidden" name="user_id"
                                                                                       value="{{ $val->id }}">

                                                                                <label class="control-label">Send any notification to Student
                                                                                </label>

                                                                                <div class="">
                                                                                    <input type="text" class="form-control" id="val-username"
                                                                                           name="notification">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-default waves-effect"
                                                                                data-dismiss="modal">Close
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="btn btn-danger">Send Notification
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

<script>
    $('img[data-enlargeable]').addClass('img-enlargeable').click(function() {
        var src = $(this).attr('src');
        var modal;

        function removeModal() {
            modal.remove();
            $('body').off('keyup.modal-close');
        }
        modal = $('<div>').css({
            background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
            backgroundSize: 'contain',
            width: '100%',
            height: '100%',
            position: 'fixed',
            zIndex: '10000',
            top: '0',
            left: '0',
            cursor: 'zoom-out'
        }).click(function() {
            removeModal();
        }).appendTo('body');
        //handling ESC
        $('body').on('keyup.modal-close', function(e) {
            if (e.key === 'Escape') {
                removeModal();
            }
        });
    });
</script>
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
