<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::where('id', '>', 0)->get();
        return view('subject.index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('subject.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = Subject::where('name', '=', $request->name)->count();
        if ($subject > 0)
            return redirect('subject/add')->withInput()->with('danger', 'Subject already exists!');

        $input = $request->all();
        $subject = new Subject($input);
        $subject->name = $request->name;

        if ($subject->save())
            return Redirect::route('subjects')->with('success', 'Successfully added subject!');
        else
            return Redirect::route('subject.add')->withInput()->withErrors($subject->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('subject.edit', ['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);

        $subject_check = Subject::where('name', '=', $request->name)->first();

        if ($subject_check && $subject_check->id != $id)
            return Redirect::route('editSubject', [$id])->withInput()->with('danger', 'Subject already exists');

        $subject->name = $request->name;

        if ($subject->update())
            return Redirect::route('subjects')->with('success', 'Successfully updated subject');
        else
            return Redirect::route('editSubject', [$id])->withInput()->withErrors($subject->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
