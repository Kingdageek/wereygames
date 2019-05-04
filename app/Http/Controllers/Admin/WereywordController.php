<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wereyword;
use App\Models\Wordgroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WereyWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wereywords = Wereyword::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.wereyword.index', compact('wereywords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wordgroups = Wordgroup::all();

        // You can't create wereywords if there are no wordgroups
        if ( $wordgroups->isEmpty() ) {
            return redirect()->back()
                             ->with('status', 'You need to create a <strong>Wordgroup</strong> first
                                    to be able to create a Wereyword.
                                    Click <a href="'. route('admin.wordgroups.create') .'">Create Wordgroup</a> to create one.');
        }
        return view('admin.wereyword.create', compact('wordgroups'));
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
            'name' => 'required|max:50|unique:wereywords',
            'wordgroups' => 'required'
        ]);

        $wereyword = Wereyword::create( [ 'name' => ucfirst($request->name) ] );

        // Handling the Many-To-Many Relationship
        // The attach() method becomes available to us when
        // we've created our Pivot table.
        $wereyword->wordgroups()->attach($request->wordgroups);

        return redirect()->route('admin.wereywords.index')
                         ->with('success', 'Wereyword successfully created');
    }

    /**
     * Show the form for creating wereywords from csv/txt file.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFromFile()
    {
        $wordgroups = Wordgroup::all();

        // You can't create wereywords if there are no wordgroups
        if ( $wordgroups->isEmpty() ) {
            return redirect()->back()
                             ->with('status', 'You need to create a <strong>Wordgroup</strong> first
                                    to be able to create a Wereyword.
                                    Click <a href="'. route('admin.wordgroups.create') .'">Create Wordgroup</a> to create one.');
        }
        return view('admin.wereyword.createFromFile', compact('wordgroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromFile(Request $request)
    {
        $this->validate($request, [
            'wereywordsFile' => 'required|mimes:csv,txt',
            'wordgroups' => 'required'
        ]);

        $filePath = $request->wereywordsFile->path();

        $totalWereywords = 0;
        // to track words successfully saved to database
        $totalAddedWords = 0;
        $row = 1;
        if ( ( $handle = fopen($filePath, 'r') ) !== false ) {
            while ( ( $data = fgetcsv($handle, 1000, ',') ) !== false ) {
                $wereywordsLineCount = count($data);
                $totalWereywords += $wereywordsLineCount;
                $row ++;

                for ($i=0; $i < $wereywordsLineCount; $i++) {
                    // handle each wereyword
                    // trim and capitalize each word
                    $word = ucfirst(trim($data[$i]));

                    // check if wereyword is already saved, if yes, continue loop
                    // otherwise save.
                    if ( Wereyword::where('name', $word)->first() ) continue;

                    $wereyword = Wereyword::create(['name' => $word]);

                    // attach the selected wordgroups to the word
                    $wereyword->wordgroups()->attach($request->wordgroups);
                    $totalAddedWords ++;
                }
            }

            fclose($handle);
        }
        $nonUniqueWords = $totalWereywords - $totalAddedWords;
        return redirect()->route('admin.wereywords.index')
                         ->with('success', 'Wereyword batch operation successful | <strong>'.
                                $totalAddedWords . '</strong> wereyword(s) of <strong>' . $totalWereywords .
                                '</strong> added. <strong>' . $nonUniqueWords .
                                '</strong> non unique word(s)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wereyword  $wereyWord
     * @return \Illuminate\Http\Response
     */
    public function show(WereyWord $wereyWord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wereyword  $wereyword
     * @return \Illuminate\Http\Response
     */
    public function edit($wereyword)
    {
        // Eager load associated wordgroups to try to avoid the 'n+1' query problem
        $wereyword = Wereyword::with('wordgroups')->where('id', $wereyword)->first();
        return view('admin.wereyword.edit', [
            'wereyword' => $wereyword,
            'wordgroups' => Wordgroup::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wereyword  $wereyWord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wereyword $wereyword)
    {
        $this->validate($request, [
            'name' => 'required|max:50|unique:wereywords,name,'.$wereyword->id,
            'wordgroups' => 'required'
        ]);

        $wereyword->update( [ 'name' => ucfirst($request->name) ] );
        $wereyword->wordgroups()->sync($request->wordgroups);

        return redirect()->route('admin.wereywords.index')
                        ->with('success', 'Wereyword successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wereyword  $wereyWord
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wereyword $wereyword)
    {
        $wereyword->wordgroups()->detach();
        $wereyword->delete();
        return redirect()->back()
                        ->with('success', 'Wereyword - <strong>' . $wereyword->name . '</strong> - was successfully deleted');
    }
}
