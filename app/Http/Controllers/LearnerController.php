<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Learner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LearnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $learners = Learner::where('id', '>', 0)->get();
        return view('learner.index', compact('learners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $centres = Centre::all();
        return view('learner.add', ['centres' => $centres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $learner = Learner::where('name', '=', $request->name)
            ->where('surname', '=', $request->surname)->count();
        if ($learner > 0)
            return redirect('learner/add')->withInput()->with('danger', 'Learner already exists!');

        $input = $request->all();
        $learner = new Learner($input);
        $learner->name = $request->name;
        $learner->surname = $request->surname;
        $learner->user_name = $request->user_name;
        $learner->password = Hash::make($request->password);
        $learner->centre_id = $request->centre_id;

        if ($learner->save())
            return Redirect::route('courses')->with('success', 'Successfully added learner!');
        else
            return Redirect::route('learner.add')->withInput()->withErrors($learner->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function show(Learner $learner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $learner = Learner::find($id);
        $centres = Centre::where('id', '>', 0)->get();
        $centre = Centre::where('id', '=', $learner->centre_id)->first();
        $cid = $centre->id;
        $name = $learner->name . ' ' . $learner->name;

        return view('learner.edit', compact('learner', 'centres', 'cid', 'name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $learner = Learner::find($id);

        $learner_check = Learner::where('name', '=', $request->name)
            ->where('surname', '=', $request->surname)->first();

        if ($learner_check && $learner_check->id != $id)
            return Redirect::route('editLearner', [$id])->withInput()->with('danger', 'Learner already exists');

        $learner->name = $request->name;
        $learner->surname = $request->surname;
        $learner->user_name = $request->user_name;
        $learner->password = Hash::make($request->password);
        $learner->centre_id = $request->centre_id;

        if ($learner->update())
            return Redirect::route('courses')->with('success', 'Successfully updated learner');
        else
            return Redirect::route('editLearner', [$id])->withInput()->withErrors($learner->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Learner $learner)
    {
        //
    }
}
