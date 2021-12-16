<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
    public function add()
    {
        return view('user.add');
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
        $user = new User($input);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);

        $exists = User::where('user_name', $user->user_name)->first();
        if ($exists) {
            return Redirect::route('user.add')->withInput()
                ->with('danger', 'User with user_name "' . $user->user_name . '" already exists!');
        }

        if ($user->save())
            return Redirect::route('learners')->with('success', 'Successfully added user!');
        else
            return Redirect::route('user.add')->withInput()->withErrors($user->errors());
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showLogin()
    {
        // show the form
        return view('user.login');
    }
    public function doLogin(Request $request)
    {
        // validate the credentials, create rules for the input
        $users = User::where('user_name', '=', $request->user_name)->get();

        // check if email address exists
        if ($users -> isEmpty())
            return Redirect::to('login')->withInput()
                ->with('danger', 'Sorry user name or password is incorrect or you need to register first');

        dd('I am here');
    }
    public function doLogout()
    {
        Auth::logout();
        return Redirect::to('login');
    }
}
