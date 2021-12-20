<?php

namespace App\Http\Controllers;

use App\Models\Registered_Course;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $regCourse = Registered_Course::find($id);
        $date = Carbon::now();
        $dateCheck = $date->format('Y-m-d');

        $session = Session::where('date_sessionDone', '=', $dateCheck)
            ->where('course_id', '=', $regCourse->course_id)
            ->where('learner_id', '=', $regCourse->learner_id)->count();

        if ($session > 0)
            return Redirect::route('registeredCourses')
                ->with('danger', 'You have already added a session for the selected course');
        else {
            $session = new Session();
            $session->date_sessionDone = $date->format('Y-m-d');
            $session->marksReceived = 0;
            $session->course_id = $regCourse->course_id;
            $session->learner_id = $regCourse->learner_id;
        }

        if ($session->save())
            return Redirect::route('registeredCourses')->with('success', 'Successfully added a session for today');
        else
            return Redirect::route('registeredCourses')->withInput()->withErrors($session->errors());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }

    public function weekSession(Request $request)
    {

    }
}
