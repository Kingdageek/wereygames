<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\Facades\Image;
use App\Models\Story;
use Validator;
use Log;
use Auth;



class StoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $stories = Story::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.story.list', [
            'stories' => $stories
        ]);
    }


    public function create(Request $request)
    {
        if($request->isMethod('POST')){

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'content' => 'required'
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->input());
            }

            Story::create([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);

            return redirect()->route('admin.stories')->with('success', 'Story successfully created');
        }

        return view('admin.story.create');
    }

    public function edit(Request $request, $id)
    {
        $story = Story::where('id', $id)->first();

        if($request->isMethod('POST')){

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'content' => 'required'
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->input());
            }

            $story->title = $request->input('title');
            $story->content = $request->input('content');
            $story->save();

            return redirect()->route('admin.stories')->with('success', 'Story successfully updated');
        }

        return view('admin.story.edit', [
            'story' => $story,
        ]);
    }

    public function storyForm(Request $request, $id)
    {
        $story = Story::where('id', $id)->first();
        $content = $story->content;

        if (preg_match_all('/{([^}]*)}/', $content, $matches)) {
            $formInputs = join("\n", $matches[1]);
        }

            dd($formInputs);

    }

}
