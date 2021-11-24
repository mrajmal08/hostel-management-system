<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Redirect;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.add-course');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_course(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'course_code' => 'required',
        ]);

        $result = Course::create([
            'name' => $request->name,
            'course_code' => $request->course_code,
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'Course Added successfully');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function all_courses()
    {
        $courses = Course::all();
        return view('Admin.all-courses', compact('courses'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update_course(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'course_code' => 'required',
        ]);

        $result = Course::where('id', $request->course_id)->update([
            'name' => $request->name,
            'course_code' => $request->course_code,
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'Course Updated successfully');

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function delete_course($id)
    {
        $course = Course::find($id);
        if($course){
            $result = Course::destroy($id);
            if ($result) {

                return redirect()->back()->with('success', 'Course deleted successfully');

            } else {
                return Redirect::back()->withErrors(['Something went wrong']);
            }
        }
    }
}
