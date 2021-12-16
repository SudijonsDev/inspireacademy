<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CentreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centres = Centre::where('id', '>', 0)->get();
        return view('centre.index', ['centres' => $centres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('centre.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $centre = Centre::where('name', '=', $request->name)->count();
        if ($centre > 0)
            return redirect('centre/add')->withInput()->with('danger', 'Centre already exists!');

        $input = $request->all();
        $centre = new Centre($input);
        $centre->name = $request->name;

        if ($centre->save())
            return Redirect::route('centres')->with('success', 'Successfully added centre!');
        else
            return Redirect::route('centre.add')->withInput()->withErrors($centre->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Centre  $centre
     * @return \Illuminate\Http\Response
     */
    public function show(Centre $centre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Centre  $centre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $centre = Centre::find($id);
        return view('centre.edit', ['centre' => $centre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Centre  $centre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $centre = Centre::find($id);

        $centre_check = Centre::where('name', '=', $request->name)->first();

        if ($centre_check && $centre_check->id != $id)
            return Redirect::route('editCentre', [$id])->withInput()->with('danger', 'Centre already exists');

        $centre->name = $request->name;

        if ($centre->update())
            return Redirect::route('centres')->with('success', 'Successfully updated centre');
        else
            return Redirect::route('editCentre', [$id])->withInput()->withErrors($centre->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Centre  $centre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centre $centre)
    {
        //
    }
}
