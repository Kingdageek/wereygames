<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function start(Request $request)
    {
        $story = Story::whereNotNull('form')->inRandomOrder()->first();

        if(!$story){
            return redirect()->route('front.index');
        }

        return view('start', [
            'story' => $story,
            'formInputs' => json_decode($story->form)
        ]);
    }

    public function storyGenerate(Request $request, $id)
    {
        $story = Story::where('id', $id)->first();
        $storyFormFields = $request->except('_token');
        $storyContent = $story->content;
        //$formattedStoryContent = preg_replace('/(?<=[\w\s])\s(?=[\w\s]*?\})/', '_', $storyContent);

        $formattedStoryContent = preg_replace_callback("/\{[\w\s]*?\}/", function($matches) {
            return preg_replace("/\s+/", "_", $matches[0]);
            }, $storyContent);

        $formedStory = preg_replace_callback('/{(.+?)}/ix',function($match)use($storyFormFields){
            return !empty($storyFormFields[$match[1]]) ? $storyFormFields[$match[1]] : $match[0];
        }, $formattedStoryContent);

        session(['story' => $story, 'formedStory' => $formedStory]);

        return redirect()->route('story.preview');
    }

    public function storyPreview(Request $request)
    {
        if(!$request->session()->has('story') && !$request->session()->has('formedStory')) {
            return redirect()->route('front.index');
        }

        $story = $request->session()->get('story');
        $formedStory = $request->session()->get('formedStory');

        return view('preview', [
            'story' => $story,
            'formedStory' => $formedStory
        ]);
    }

    public function stories(Request $request)
    {
        $stories = Story::whereNotNull('form')->orderBy('created_at', 'desc')->paginate(40);

        return view('stories', [
            'stories' => $stories
        ]);
    }

}
