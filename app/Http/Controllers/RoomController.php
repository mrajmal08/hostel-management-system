<?php

namespace App\Http\Controllers;

use App\Models\BookHostel;
use App\Models\Hostel;
use Illuminate\Http\Request;
use App\Models\Room;
use Redirect;

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
        return view('Manager.pay-fees');
    }

    public function fees_submit(Request $request){
        dd($request->all());
    }
}
