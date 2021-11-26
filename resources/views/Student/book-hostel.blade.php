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
                                    @if($booked_user == null)
                                        <h1 class="text-uppercase">WelCome {{ auth()->user()->name }},  The Luxury Hostel is waiting for you</h1>
                                    @else
                                        <h1 class="alert alert-danger">{{ auth()->user()->name }} Hostel already booked by
                                            you</h1>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Hostel Booking</li>
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
                                        <div>
                                            <h3 class="alert alert-success">Room Information</h3>
                                        </div>
                                        <div class="form-validation">
                                            <form class="form-valide" action="{{ route('create.booking') }}" method="POST">
                                                @csrf

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-select2">Select Hostel
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <select class="js-select2 form-control"
                                                                id="hostel_id" name="hostel_id" style="width: 100%;" >
                                                            <option selected disabled>---</option>
                                                            @foreach($hostels as $val)
                                                                <option
                                                                    value="{{ $val->id }}">{{ $val->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-select2">Select Room
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <select class="js-select2 form-control"
                                                                id="room_id" name="room_id" style="width: 100%;"
                                                                data-placeholder="Choose one..">
                                                            <option selected disabled>---</option>
                                                            @foreach($rooms as $val)
                                                                <option
                                                                    value="{{ $val->id }}">{{ $val->room_no }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Room Details
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <p class="total_seats" style="color:red"></p>
                                                        <p class="total_fees" style="color:red"></p>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-select2">Food Status
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                   name="food_status" id="inlineRadio1" value="0">
                                                            <label class="form-check-label" for="inlineRadio1">Without
                                                                Food</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                   name="food_status" id="inlineRadio2" value="2000">
                                                            <label class="form-check-label" for="inlineRadio2">With
                                                                Food(Rs 2000.00 Per Month Extra)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Stay
                                                        From <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="date" class="form-control" id="val-suggestions"
                                                               name="stay_from"/>
                                                    </div>
                                                </div>

                                                <div>
                                                    <h3 class="alert alert-success">Personal Information</h3>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-select2">Select
                                                        Course <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <select class="js-select2 form-control"
                                                                 name="course_id" style="width: 100%;" >
                                                            <option selected disabled>---</option>
                                                            @foreach($course as $val)
                                                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <input type="hidden" name="user_id"
                                                           value="{{ auth()->user()->id }}">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Username
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-username"
                                                               name="name" value="{{ auth()->user()->name }}" disabled/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Father
                                                        Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-username"
                                                               name="father_name"
                                                               value="{{ auth()->user()->father_name }}" disabled/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="email" class="form-control" id="val-email"
                                                               name="email" value="{{ auth()->user()->email }}"
                                                               disabled/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-select2">Gender
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="email" class="form-control" id="val-email"
                                                               name="email" value="{{ auth()->user()->gender }}"
                                                               disabled/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Contact
                                                        Number<span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="number" class="form-control" id="val-phoneus"
                                                               name="contact"
                                                               value="{{ auth()->user()->contact }}" disabled/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Address
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-suggestions"
                                                               name="address"
                                                               value="{{ auth()->user()->address }}" disabled/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Emergency
                                                        Contact:
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="number" class="form-control" id="val-suggestions"
                                                               name="emergency_contact"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Guardian
                                                        Name
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-suggestions"
                                                               name="guardian_name"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Guardian
                                                        Relation
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-suggestions"
                                                               name="guardian_relation"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Guardian
                                                        Contact
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="number" class="form-control" id="val-suggestions"
                                                               name="guardian_contact"/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Permanent
                                                        Address
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-suggestions"
                                                               name="permanent_address"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Zip
                                                        Code
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="number" class="form-control" id="val-suggestions"
                                                               name="zip_code"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">City
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-suggestions"
                                                               name="city"/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">state
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="val-suggestions"
                                                               name="state"/>
                                                    </div>
                                                </div>


                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
        <script>
            $(document).ready(function () {
                $('#room_id').on('change', function () {
                    var room_id = $("#room_id option:selected").val();

                    let _token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: "/get-rooms",
                        type: "POST",
                        data: {
                            room_id: room_id,
                            _token: _token
                        },
                        success: function (response) {
                            var total_space = response.total_space;
                            var fee_per_student = response.fee_per_student;
                            $('.total_seats').html("This Room Have " + total_space + " Bed Space Available")
                            $('.total_fees').html("Fees Per Student: " + fee_per_student)


                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });

            });

        </script>
@endsection

@push('custom-scripts')

@endpush
