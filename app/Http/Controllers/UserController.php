<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $users = User::where('id', '>', 0)->get();
        return view('user.index', ['users' => $users]);
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
        $exists = User::where('email', $request->email)->first();
        if ($exists) {
            return Redirect::route('addUser')->withInput()
                ->with('danger', 'User with email "' . $request->email . '" already exists!');
        }

        $input = $request->all();
        $user = new User($input);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save())
            return Redirect::route('login')->with('success', 'Successfully added user!');
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
        $user = User::where('email', '=', $request->email)->first();

        // check if email address exists
        if (!$user) {
            $learner = Learner::where('user_name', '=', $request->email)->first();
            if (!$learner)
                return Redirect::to('login')->withInput()->with('danger', 'Please register first');
            else
                return redirect('courses');
        } else {
            $rules = array(
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:3');

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
                return Redirect::to('login')
                    ->withInput($validator)
                    ->withInput()
                    ->with('danger', 'Your login failed, Please try again.');
            else
                $userData = array(
                    'email' => $request->email,
                    'password' => $request->password);

            if (Auth::attempt($userData, true))
                return redirect('learners');
            else
                return Redirect::to('login')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('danger', 'Your login failed, Please try again');
        }
    }
    public function doLogout()
    {
        Auth::logout();
        return Redirect::to('login');
    }
}