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
                                        <li class="breadcrumb-item active">All Courses</li>
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
                                                    <th>Course Name</th>
                                                    <th>Course Code</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($courses as $val)
                                                    <tr>
                                                        <td>{{ $val->name }}</td>
                                                        <td>{{ $val->course_code }}</td>
                                                        <td>
                                                            <a data-toggle="modal" data-target="#a{{ $val->id }}"
                                                               class="btn btn-sm btn-warning ck waves-effect waves-light">
                                                                edit
                                                            </a>
                                                            <a href="{{ route('delete.course', ['id' => $val->id]) }}" class="btn btn-sm btn-danger">delete</a>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Add Category -->
                                                    <div class="modal fade none-border" id="a{{ $val->id }}">
                                                        <div class="modal-dialog">
                                                            <form method="POST" action="{{ route('update.course') }}">
                                                                @csrf

                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            <strong>Update Course</strong>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <input type="hidden" name="course_id"
                                                                                       value="{{ $val->id }}">
                                                                                <label class="control-label">Course
                                                                                    Name</label>
                                                                                <input class="form-control form-white"
                                                                                       name="name"
                                                                                       value="{{ $val->name }}"
                                                                                       placeholder="Enter name"
                                                                                       type="text"/>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label">Course
                                                                                    Code</label>
                                                                                <input class="form-control form-white"
                                                                                       name="course_code"
                                                                                       value="{{ $val->course_code }}"
                                                                                       placeholder="Enter name"
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
                                                                                class="btn btn-danger">Save
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
