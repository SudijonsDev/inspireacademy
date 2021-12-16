<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::where('id', '>', 0)->get();
        return view('course.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $subjects = Subject::where('id','>', 0)->get();
        return view('course.add', ['subjects' => $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = Course::where('grade', '=', $request->grade)
            ->where('subject_id', '=', $request->subject_id)->count();
        if ($course > 0)
            return redirect('course/add')->withInput()->with('danger', 'Course for that grade and subject already exists');

        $input = $request->all();
        $course = new Course($input);
        $course->name = $request->name;
        $course->grade = $request->grade;
        $course->subject_id = $request->subject_id;

        if ($course->save())
            return Redirect::route('courses')->with('success', 'Successfully added course!');
        else
            return Redirect::route('course.add')->withInput()->withErrors($course->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $subjects = Subject::where('id', '>', 0)->get();
        $subject = Subject::where('id', '=', $course->subject_id)->first();
        $sid = $subject->id;

        return view('course.edit', compact('course', 'subjects', 'sid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        $course_check = Course::where('grade', '=', $request->grade)
            ->where('subject_id', '=', $request->subject_id)->first();

        if ($course_check && $course_check->id != $id)
            return Redirect::route('editCourse', [$id])->withInput()
                ->with('danger', 'Course for that grade and subject already exists');

        $course->name = $request->name;
        $course->grade = $request->grade;
        $course->subject_id = $request->subject_id;

        if ($course->update())
            return Redirect::route('courses')->with('success', 'Successfully updated course');
        else
            return Redirect::route('editCourse', [$id])->withInput()->withErrors($course->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
