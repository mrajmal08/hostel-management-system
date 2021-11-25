<?php

namespace App\Http\Controllers;

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
        return view('Admin.add-room');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_room(Request $request)
    {
        $this->validate($request, [
            'room_no' => 'required',
            'room_seats' => 'required',
            'fee_per_student' => 'required',
        ]);

        $result = Room::create([
            'room_no' => $request->room_no,
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
}
