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
        return view('play', [
            'story' => $story,
            'formInputs' => json_decode($story->form)
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
        $stories = Story::whereNotNull('form')->orderBy('created_at', 'desc')->paginate(40);

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

        $formattedStoryContent = preg_replace_callback("/\{[\w\s]*?\}/", function($matches) {
            return preg_replace("/\s+/", "_", $matches[0]);
            }, $storyContent);

        $formedStory = preg_replace_callback('/{(.+?)}/ix',function($match)use($storyFormFields){
            return !empty($storyFormFields[$match[1]]) ? $storyFormFields[$match[1]] : $match[0];
        }, $formattedStoryContent);

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
        if($request->isMethod('POST')){
            $guest->has_unlocked = true;
            $guest->save();
            return response()->json([
                'success' => true,
            ]);
        }
        return view('unlock');
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
