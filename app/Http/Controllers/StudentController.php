<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Redirect;

class StudentController extends Controller
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

    public function profile()
    {
        return view('Student.profile');
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);

        $result = User::where('id', $request->id)->update([
            'name' => $request->name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address,
            'contact' => $request->contact,
        ]);

        if ($result) {
            return redirect()->back()->with('success', 'Profile updated successfully');

        } else {
            return Redirect::back()->withErrors(['User not updated']);
        }
    }

    public function change_password()
    {
        return view('Student.change-password');
    }

    public function update_password(Request $request)
    {


        $user = User::findOrFail($request->id);

        /*
        * Validate all input fields
        */
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required|min:8',
        ]);


        if ($request->new_password != $request->confirm_password) {
            return Redirect::back()->withErrors(['Password does not match']);
        }


        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            return redirect()->back()->with('success', 'Password change successfully');

        } else {
            return Redirect::back()->withErrors(['Old Password does not match']);

        }


    }

    public function book_hostel()
    {
        return view('Student.book-hostel');
    }

    public function room_detail()
    {
        return view('Student.room-detail');
    }
}
