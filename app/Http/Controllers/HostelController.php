<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\BookHostel;
use App\Models\Room;
use App\Models\User;
use Redirect;


class HostelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::all();
       $course = Course::all();
       $rooms = Room::where('total_space', '>', '0')->get();
       $booked_user = BookHostel::where('user_id', Auth()->user()->id)->first();

       return view('Student.book-hostel', compact('users', 'rooms', 'course', 'booked_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_booking(Request $request)
    {
        $user_id = BookHostel::where('user_id', $request->user_id)->first();
        if ($user_id) {
            return Redirect::back()->withErrors(['Sorry you can not book hostel, Hostel already booked by you']);
        }

        $this->validate($request, [
            'room_id' => 'required',
            'food_status' => 'required',
            'stay_from' => 'required',
            'course_id' => 'required',
            'emergency_contact' => 'required',
            'guardian_name' => 'required',
            'guardian_contact' => 'required',
            'permanent_address' => 'required|max:200',
            'city' => 'required',
        ]);

        /** calculate the total fees of student */
        $room_detail = Room::where('id', $request->room_id)->first();
        $fees_per_month = $room_detail->fee_per_student + $request->food_status;

        $total_space = $room_detail->total_space;
        $remaining_space = $total_space - 1;

        Room::where('id', $request->room_id)->update([
            'total_space' => $remaining_space,
        ]);

        $result = BookHostel::create([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'course_id' => $request->course_id,
            'food_status' => $request->food_status,
            'fees_per_month' => $room_detail->fee_per_student,
            'total_amount' => $fees_per_month,
            'stay_from' => $request->stay_from,
            'emergency_contact' => $request->emergency_contact,
            'guardian_name' => $request->guardian_name,
            'guardian_relation' => $request->guardian_relation,
            'guardian_contact' => $request->guardian_contact,
            'permanent_address' => $request->permanent_address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        if ($result) {
            return redirect()->back()->with('success', 'Thanks for booking, Your request is under review');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }


    }

    public function add_hostel(){

        return view('Hostel.add-hostel');
    }
    public function create_hostel(Request $request){

        $all_hostels = Hostel::all();
        $count = count($all_hostels);
        if ($count > 3){
            return Redirect::back()->withErrors(['Sorry you can not add HOSTEL more than 4']);
        }

        $this->validate($request, [
            'name' => 'required',
            'location' => 'required',
            'contact' => 'required',
        ]);

        $result = Hostel::create([
            'name' => $request->name,
            'location' => $request->location,
            'contact' => $request->contact,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ]);

        if ($result) {
            return redirect()->back()->with('success', 'Hostel Created Successfully');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }

    public function show_hostel()
    {
        $hostels = Hostel::orderBy('created_at', 'desc')->get();
        $mangers = User::where('role_id', '2')->get();

        return view('Hostel.all-hostels', compact('hostels', 'mangers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookHostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function update_hostel(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:155',
            'location' => 'required',
            'contact' => 'required',
        ]);

        $result = Hostel::where('id', $request->hostel_id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'contact' => $request->contact,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'Hostel Updated successfully');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookHostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function delete_hostel($id)
    {
        $hostel = Hostel::find($id);
        if($hostel){
            $result = Hostel::destroy($id);
            if ($result) {

                return redirect()->back()->with('success', 'Hostel Deleted successfully');

            } else {
                return Redirect::back()->withErrors(['Something went wrong']);
            }
        }
    }
}
