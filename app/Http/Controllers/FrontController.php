<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\UserStory;
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

        $formattedStoryContent = preg_replace_callback("/\{[\w\s]*?\}/", function($matches) {
            return preg_replace("/\s+/", "_", $matches[0]);
            }, $storyContent);

        $formedStory = preg_replace_callback('/{(.+?)}/ix',function($match)use($storyFormFields){
            return !empty($storyFormFields[$match[1]]) ? $storyFormFields[$match[1]] : $match[0];
        }, $formattedStoryContent);

        $slug = $this->generateSlug();

        $userStory = UserStory::create([
            'slug' => $slug,
            'story_id' => $story->id,
            'content' => $formedStory
        ]);

        return redirect()->route('story.preview', $userStory->slug);
    }

    public function storyPreview(Request $request, $slug)
    {
        if(!$slug) {
            return redirect()->route('front.index');
        }

        $formedStory = UserStory::where('slug', $slug)->first();

        if(!$formedStory){
            return redirect()->route('front.index');
        }

        $story = Story::where('id', $formedStory->story_id)->first();

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

    public function generateSlug() {
        $slug = str_random(15);
        // call the same function if the slug exists already
        if (slugExists($slug)) {
            return generateSlug();
        }
        // otherwise, it's valid and can be used
        return $slug;
    }

    public function slugExists($slug) {
        return UserStory::whereSlug($slug)->exists();
    }

}
