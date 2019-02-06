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

        if($request->isMethod('POST')){
           $inputFields = $request->except('_token');
           $story->form = json_encode($inputFields);
           $story->save();

           return redirect()->route('admin.story.form.update', $story->id)->with('success', 'Form successfully saved');
        }

        $content = $story->content;
        $formInputs = [];
        if (preg_match_all('/{([^}]*)}/', $content, $matches)) {
            $formInputs = $matches[1];
        }

        return view('admin.story.generate_form', [
            'story' => $story,
            'formInputs' => $formInputs
        ]);
    }

    public function storyFormUpdate(Request $request, $id)
    {
        $story = Story::where('id', $id)->first();

        if(is_null($story->form)){
          return redirect()->route('admin.story.form', $story->id)->with('error', 'You need to generate a form first before updating it');
        }

        if($request->isMethod('POST')){
           $inputFields = $request->except('_token');
           $story->form = json_encode($inputFields);
           $story->save();

           return redirect()->route('admin.story.form.update', $story->id)->with('success', 'Form successfully saved');
        }

        return view('admin.story.update_form', [
            'story' => $story,
            'formInputs' => json_decode($story->form)
        ]);
    }

}
