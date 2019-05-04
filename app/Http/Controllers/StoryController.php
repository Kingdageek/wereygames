<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Guest;
use App\Models\UserStory;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function play(Request $request)
    {
        $guest = session()->get('guest');

        $userStories = UserStory::where('guest_id', $guest->id)->count();

        if(!$guest->has_unlocked && $userStories >= 2){
            return redirect()->route('story.unlock');
        }

        if ($request->session()->has('story')) {
            $story = session('story');
        }else{
            $story = Story::whereNotNull('form')->inRandomOrder()->first();
        }
        if(!$story){
            return redirect()->route('front.index');
         }

        $contentFormInputs = [];
        if (preg_match_all('/{([^}]*)}/', $story->content, $matches)) {
            $contentFormInputs = preg_replace('/\s+/', '_', $matches[1]);
        }

        $contentForm = [];
        foreach ($contentFormInputs as $key => $value) {
            $contentForm['form_'.$key.'_'.$value] = '';
        }

        $existingStoryInputs = json_decode($story->form, true);
        $formInputs = array_merge($contentForm, $existingStoryInputs);

        // Record a view after 2 minutes
        views($story)->delayInSession(2)->record();

        return view('play', [
            'story' => $story,
            'formInputs' => $formInputs
        ]);
    }

    public function selectStory(Request $request, $id)
    {
        $story = Story::where('id', $id)->first();
        session(['story' => $story]);
        return redirect()->route('story.play');
    }

    public function getStories(Request $request)
    {
        $stories = Story::whereNotNull('form')->orderBy('created_at', 'desc')->paginate(20);

        return view('stories', [
            'stories' => $stories
        ]);
    }

    public function storyGenerate(Request $request, $id)
    {
        $guest = session()->get('guest');
        $story = Story::where('id', $id)->first();
        $storyFormFields = $request->except('_token');
        $storyContent = $story->content;

        $contentFormInputs = [];
        if (preg_match_all('/{([^}]*)}/', $storyContent, $matches)) {
            $contentFormInputs = preg_replace('/\s+/', '_', $matches[1]);
        }

        $combinedInputKeys =  array_keys($storyFormFields);

        $formattedStoryContent = preg_replace_callback("/\{[\w\s]*?\}/", function($matches) use ($storyFormFields){
            return preg_replace("/\s+/", "_", $matches[0]);
         }, $storyContent);

        $processedStoryContent = preg_replace_callback('/\{(.+?)\}/', function () use(&$combinedInputKeys) {
        $replacement = array_shift($combinedInputKeys);
            return "{{$replacement}}";
        }, $formattedStoryContent);

        $formedStory = preg_replace_callback('/{(.+?)}/ix',function($match)use($storyFormFields){
            return !empty($storyFormFields[$match[1]]) ? '<strong><u>'.$storyFormFields[$match[1]].'</u></strong>' : $match[0];
        }, $processedStoryContent);

        $slug = $this->generateSlug();

        $userStory = UserStory::create([
            'slug' => $slug,
            'guest_id' => $guest->id,
            'story_id' => $story->id,
            'content' => $formedStory
        ]);

        return redirect()->route('story.preview', $userStory->slug);
    }

    public function unlock(Request $request)
    {
        $guest = session()->get('guest');

        if($guest->has_unlocked){
            return redirect()->route('get.stories');
        }

        if($request->isMethod('POST')){
            $guest->has_unlocked = true;
            $guest->save();
            return response()->json([
                'success' => true,
            ]);
        }

        $stories = Story::whereNotNull('form')->orderBy('created_at', 'desc')->take(20)->get();

        return view('unlock', [
            'stories' => $stories
        ]);
    }

    public function generateSlug() {
        $slug = str_random(15);
        // call the same function if the slug exists already
        if ($this->slugExists($slug)) {
            return $this->generateSlug();
        }
        // otherwise, it's valid and can be used
        return $slug;
    }

    public function slugExists($slug) {
        return UserStory::whereSlug($slug)->exists();
    }
}
