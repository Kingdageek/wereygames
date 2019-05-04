<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wordgroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WordgroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wordgroups = Wordgroup::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.wordgroup.index', compact('wordgroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wordgroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:wordgroups'
        ]);

        Wordgroup::create([ 'name' => ucfirst($request->name) ]);

        session()->flash('success', 'Wordgroup successfully created');
        return redirect()->route('admin.wordgroups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wordgroup  $wordgroup
     * @return \Illuminate\Http\Response
     */
    public function show(Wordgroup $wordgroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wordgroup  $wordgroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Wordgroup $wordgroup)
    {
        return view('admin.wordgroup.edit', compact('wordgroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wordgroup  $wordgroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wordgroup $wordgroup)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:wordgroups,name,'. $wordgroup->id
        ]);

        $wordgroup->update([ 'name' => ucfirst( $request->name ) ]);
        return redirect()->route('admin.wordgroups.index')
                         ->with('success', 'Wordgroup successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wordgroup  $wordgroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wordgroup $wordgroup)
    {
        $wordgroup->delete();
        return redirect()->back()
                         ->with('success', 'Wordgroup <strong>' . $wordgroup->name . '</strong> was successfully deleted');
    }
}
