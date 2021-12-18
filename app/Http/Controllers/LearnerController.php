<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Learner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class LearnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->admin == 'Y')
            $learners = Learner::where('id', '>', 0)->get();
        else
            $learners = Learner::where('name', '=', Auth::user()->name)
                ->where('surname', '=', Auth::user()->surname)->get();

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
        $agreement = null;
        if ($request->centre_id == null)
            return redirect('learner/add')->withInput()->with('danger', 'Centre cannot be null');

        $learner = Learner::where('name', '=', $request->name)
            ->where('surname', '=', $request->surname)->count();
        if ($learner > 0)
            return redirect('learner/add')->withInput()->with('danger', 'Learner already exists');

        $input = $request->all();
        $learner = new Learner($input);
        $learner->name = $request->name;
        $learner->surname = $request->surname;
        $learner->centre_id = $request->centre_id;

        $file = $request->file('agreement');
        if ($file == null)
            return redirect('learner/add')->withInput()->with('danger', 'Parent/Guardian"s agreement letter is needed');
        else {
            $path = $request->file('agreement')->store('public/parentsAgreement');
            $learner->agreement = $file;
            $learner->path = $path;
        }

        //store learner as a user
        $user = new User($input);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->admin = 'N';
        $user->email = $request->user_name;
        $user->password = Hash::make($request->password);

        if ($learner->save()) {
            $user->save();
            return Redirect::route('login')->with('success', 'Successfully added learner!');
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
        $user = User::where('name', '=', $learner->name)
            ->where('surname', '=', $learner->surname)->first();
        $centres = Centre::where('id', '>', 0)->get();
        $centre = Centre::where('id', '=', $learner->centre_id)->first();
        $cid = $centre->id;
        $name = $learner->name . ' ' . $learner->surname;

        return view('learner.edit', compact('learner', 'user', 'centres', 'cid', 'name'));
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

        $user = User::where('name', '=', $learner->name)
            ->where('surname', '=', $learner->surname)->first();

        $learner->name = $request->name;
        $learner->surname = $request->surname;
        $learner->centre_id = $request->centre_id;

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->user_name;

        if ($request->get('password') != $user->password)
            $user->password = Hash::make($request->password);

        if ($learner->update()) {
            $user->update();
            return Redirect::route('logout')->with('success', 'Successfully updated learner');
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
