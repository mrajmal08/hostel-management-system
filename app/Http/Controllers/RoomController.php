<?php

namespace App\Http\Controllers;

use App\Models\BookHostel;
use App\Models\Hostel;
use App\Models\StudentDue;
use Illuminate\Http\Request;
use App\Models\Room;
use Redirect;
use Image;
Use \Carbon\Carbon;

class RoomController extends Controller
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
        $hostels = Hostel::all();
        return view('Admin.add-room', compact('hostels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_room(Request $request)
    {
        $this->validate($request, [
            'hostel_id' => 'required',
            'room_no' => 'required',
            'room_seats' => 'required',
            'fee_per_student' => 'required',
        ]);

        $result = Room::create([
            'room_no' => $request->room_no,
            'hostel_id' => $request->hostel_id,
            'room_seats' => $request->room_seats,
            'fee_per_student' => $request->fee_per_student,
            'total_space' => $request->room_seats,
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'Room Added successfully');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function all_rooms()
    {
        $rooms = Room::orderBy('created_at', 'desc')->get();
        return view('Admin.all-rooms', compact('rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function update_room(Request $request)
    {
        $this->validate($request, [
            'room_no' => 'required',
            'total_space' => 'required',
            'fee_per_student' => 'required',
        ]);

        $result = Room::where('id', $request->room_id)->update([
            'room_no' => $request->room_no,
            'total_space' => $request->total_space,
            'fee_per_student' => $request->fee_per_student,
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'Room Updated successfully');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function delete_room($id)
    {
        $room = Room::find($id);
        if ($room) {
            $result = Room::destroy($id);
            if ($result) {

                return redirect()->back()->with('success', 'Room Deleted successfully');

            } else {
                return Redirect::back()->withErrors(['Something went wrong']);
            }
        }
    }

    /* Get Rooms Data with ajax request **/
    public function get_rooms(Request $request)
    {
        if ($request->room_id) {
            $rooms = Room::where('id', $request->room_id)->first();
            return response($rooms);
        } else {
            return response('Id cannot be null');
        }
    }

    public function my_rooms(){

        $hostel_id = Hostel::where('user_id', Auth()->user()->id)->pluck('id')->first();
        $my_rooms = Room::where('hostel_id', $hostel_id)->get();

        return view('Manager.my-rooms', compact('my_rooms'));
    }

    public function my_student(){
        $hostel_id = Hostel::where('user_id', Auth()->user()->id)->pluck('id')->first();
        $my_students = BookHostel::where('hostel_id', $hostel_id)->get();

        return view('Manager.my-student', compact('my_students'));
    }

    public function pay_fees(){

        //Get teh monthly fees of a student
        $user_id = Auth()->user()->id;
        $monthly_fees = BookHostel::where('user_id', $user_id)->pluck('total_amount')->first();

        return view('Manager.pay-fees', compact('monthly_fees'));
    }

    public function fees_submit(Request $request){

        $this->validate($request, [
            'fees' => 'required',
            'image' => 'required',
        ]);

        //get monthly fees of current user
        $monthly_fees = BookHostel::where('user_id', Auth()->user()->id)->pluck('total_amount')->first();

        if ($monthly_fees > $request->fees){
            return Redirect::back()->withErrors(['Kindly pay your full fees']);
        }

        $first = str_replace('-', '', date('m-01-Y'));
        $second = str_replace('-', '', date('m-02-Y'));
        $third = str_replace('-', '', date('m-03-Y'));
        $fourth = str_replace('-', '', date('m-04-Y'));
        $fifth = str_replace('-', '', date('m-05-Y'));
        $current_date = str_replace('-', '',date('m-d-Y'));
        $today_date = date('y-m-d');

        if($current_date != $first && $current_date != $second && $current_date != $third && $current_date != $fourth && $current_date != $fifth){
            return Redirect::back()->withErrors(['Sorry, your fees submission date is over, kindly contact with your manger for further notice']);
        }

        $image = $request->file('image');
        $input['image'] = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/');
        $img = Image::make($image->getRealPath());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $input['image']);

        $result = StudentDue::create([
            'user_id' => $request->user_id,
            'fees' => $request->fees,
            'date' => $today_date,
            'screen_shot' => $input['image'],
            'status' => "Not Approved",

        ]);
        if ($result) {
            return back()->with('success', 'Your payment received wait for verification');
        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }

    public function fees_status(){
        $student_dues = StudentDue::orderBy('created_at', 'desc')->get();
        return view('Manager.fees-status', compact('student_dues'));
    }

    public function update_fees_status(Request $request){
        $this->validate($request, [
            'status' => 'required',
        ]);

        $result = StudentDue::where('id', $request->user_id)->update([
            'status' => "Verified",
        ]);
        if ($result) {
            return back()->with('success', 'Payment Verified');
        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }
}
