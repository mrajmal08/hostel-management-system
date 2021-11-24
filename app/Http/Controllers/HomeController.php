<?php

namespace App\Http\Controllers;

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
        $users = User::all();
        $rooms = Room::all();
        $total_users = count($users);
        $total_rooms = count($rooms);
        return view('home', compact('total_users', 'total_rooms'));
    }

    public function all_users()
    {
        $users = User::all();
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
}
