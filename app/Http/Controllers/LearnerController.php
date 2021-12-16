<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Learner;
use App\Models\User;
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
        $input = $request->all();
        $learner = new Learner($input);
        $learner->firstNames = $request->name;
        $learner->surname = $request->surname;
        $learner->centre_id = $request->centre_id;

        // Store learner as a user too for logging in credentials

        $user = new User($input);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);

        $exists = User::where('user_name', $user->user_name)->first();
        if ($exists) {
            return Redirect::route('learner.add')->withInput()
                ->with('danger', 'Learner with user_name "' . $user->user_name . '" already exists!');
        }

        if ($learner->save()) {
            $user->save();
            return Redirect::route('learners')->with('success', 'Successfully added learner!');
        } else
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
        $name = $learner->firstNames . ' ' . $learner->name;
        $user = User::where('name', '=', $learner->firstNames)
            ->where('surname', '=', $learner->surname)->first();

        return view('learner.edit', compact('learner', 'centres', 'cid', 'name', 'user'));
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
        $user = User::where('name', '=', $learner->firstNames)
            ->where('surname', '=', $learner->surname)->first();

        $learner->firstNames = $request->name;
        $learner->surname = $request->surname;
        $learner->centre_id = $request->centre_id;

        // update user table as well

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);

        if ($learner->update()) {
            $user->update();
            return Redirect::route('learners')->with('success', 'Successfully updated learner');
        } else
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
