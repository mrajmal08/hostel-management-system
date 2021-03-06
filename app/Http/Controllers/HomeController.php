<?php

namespace App\Http\Controllers;

use App\Models\BookHostel;
use App\Models\Hostel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use Redirect;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //managers rooms
        $hostel_id = Hostel::where('user_id', Auth()->user()->id)->pluck('id')->first();
        $my_rooms = Room::where('hostel_id', $hostel_id)->get()->count();
        $my_students = BookHostel::where('hostel_id', $hostel_id)->get()->count();


        $users = User::all();
        $rooms = Room::all();
        $total_users = count($users);
        $total_rooms = count($rooms);
        return view('home', compact('total_users', 'total_rooms', 'my_rooms', 'my_students'));
    }

    public function add_user(){
        return view('Admin.add-user');
    }

    public function create_user(Request $request){
        $this->validate($request, [
            'name' => 'required|max:155',
            'email' => 'required',
            'password' => 'required',
            'contact' => 'required',
            'role_id' => 'required',
        ]);

        $result = User::create([
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'password' => Hash::make($request->new_password),
            'contact' => $request->contact,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'User Updated successfully');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }

    public function all_users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('Admin.all-users', compact('users'));
    }
    public function update_user(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $result = User::where('id', $request->user_id)->update([
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'contact' => $request->contact,
            'gender' => $request->gender,
            'address' => $request->address,
            'role_id' => $request->role_id,
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'User Updated successfully');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }

    public function delete_user($id){
        $user = User::find($id);
        if($user){
            $result = User::destroy($id);
            if ($result) {

                return redirect()->back()->with('success', 'User Deleted successfully');

            } else {
                return Redirect::back()->withErrors(['Something went wrong']);
            }
        }
    }

    public function assign_manger(Request $request){

        $this->validate($request, [
            'hostel_id' => 'required',
            'user_id' => 'required',
        ]);

        $result = Hostel::where('id', $request->hostel_id)->update([
            'user_id' => $request->user_id,
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'Manager Assigned to Hostel successfully');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }

    public function manage_student(){
        $bookings = BookHostel::all();
        return view('Student.manage-student', compact('bookings'));
    }

    public function all_managers(){
        $managers = User::where('role_id', 2)->orderBy('created_at', 'desc')->get();
        return view('Admin.all-managers', compact('managers'));
    }
}
