<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Learner;
use App\Models\Registered_Course;
use App\Models\Registered_Learners;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RegisteredCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();
        $learner = Learner::where('name', '=', $user->name)
            ->where('surname', '=', $user->surname)->first();
        $registered_courses = Registered_Course::where('learner_id', '=', $learner->id)
            ->where('status', '=', 'A')->get();

        return view('registercourse.index', compact('learner', 'registered_courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $course = Course::where('id', '=', $request->id)->first();
        $subject = Subject::where('id', '=', $course->subject_id)->first();
        $course_name = $subject->name;
        $grade = $course->grade;
        return view('registercourse.create', compact('course_name', 'grade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = Subject::where('name', '=', $request->name)->first();
        $course = Course::where('grade', '=', $request->grade)
            ->where('subject_id', '=', $subject->id)->first();
        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();
        $learner = Learner::where('name', '=', $user->name)
            ->where('surname', '=', $user->surname)->first();

        $registerCourse = Registered_Course::where('status', '=', 'A')
            ->where('learner_id', '=', $learner->id)
            ->where('course_id', '=', $course->id)->first();

        $registeredLearners = Registered_Learners::where('regCourseId', '=', $course->id)->first();

        if ($registerCourse == null) {
            if ($registeredLearners == null) {
                $input = $request->all();
                $registered_Course = new Registered_Course($input);
                $registered_Learner = new Registered_Learners($input);
                $registered_Course->learner_id = $learner->id;
                $registered_Course->course_id = $course->id;
                $registered_Learner->noOfLearners = $registered_Learner->noOfLearners + 1;
                $registered_Learner->regCourseId = $registered_Course->course_id;

                if ($registered_Course->save()) {
                    $registered_Learner->save();
                    return Redirect::route('registeredCourses')->with('success', 'Successfully registered for a course');
                } else
                    return Redirect::route('courses')->withInput()->withErrors($course->errors());

            } else {
                if ($registeredLearners->noOfLearners < 35) {
                    $input = $request->all();
                    $registered_Course = new Registered_Course($input);
                    $registered_Learner = Registered_Learners::where('regCourseId', '=', $course->id)->first();
                    $registered_Course->learner_id = $learner->id;
                    $registered_Course->course_id = $course->id;
                    $registered_Learner->noOfLearners = $registered_Learner->noOfLearners + 1;

                    if ($registered_Course->save()) {
                        $registered_Learner->update();
                        return Redirect::route('registeredCourses')->with('success', 'Successfully registered for a course');
                    } else
                        return Redirect::route('courses')->withInput()->withErrors($course->errors());
                } else
                    return Redirect::route('courses')->with('danger', 'Sorry there is no more space for the selected course');
            }
        } else
            return Redirect::route('courses')->with('danger', 'You are already registered for the course');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registered_Course  $registered_Course
     * @return \Illuminate\Http\Response
     */
    public function show(Registered_Course $registered_Course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registered_Course  $registered_Course
     * @return \Illuminate\Http\Response
     */
    public function edit(Registered_Course $registered_Course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registered_Course  $registered_Course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registered_Course $registered_Course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registered_Course  $registered_Course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registered_course = Registered_Course::find($id);
        $registered_course->status = 'I';

        if ($registered_course->update())
            return Redirect::route('registeredCourses')->with('success', 'Successfully deregister user from course');
        else
            return Redirect::route('registeredCourses', [$id])->withInput()->withErrors($registered_course->errors());
    }
}
