<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Guest;
use App\Models\UserStory;
use Illuminate\Http\Request;
use App\Models\Wordgroup;

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

        // $contentFormInputs = [];
        // if (preg_match_all('/{([^}]*)}/', $story->content, $matches)) {
        //     $matches[1] = array_map('trim', $matches[1]);
        //     $contentFormInputs = preg_replace('/\s+/', '_', $matches[1]);
        // }

        // $contentForm = [];
        // foreach ($contentFormInputs as $key => $value) {
        //     $contentForm['form_'.$key.'_'.$value] = '';
        // }

        $existingStoryInputs = json_decode($story->form, true);
        // $formInputs = array_merge($contentForm, $existingStoryInputs);

        // dd($existingStoryInputs);

        // Record a view after 2 minutes
        views($story)->delayInSession(2)->record();

        return view('play-test', [
            'story' => $story,
            'formInputs' => $existingStoryInputs
        ]);
    }

    public function playWithSuggestions(Request $request, Story $story)
    {
        $guest = session()->get('guest');
        $userStories = UserStory::where('guest_id', $guest->id)->count();

        if(!$guest->has_unlocked && $userStories >= 2){
            return redirect()->route('story.unlock');
        }

        if ($request->session()->has('story')) {
            $story = session('story');
        }

        if(!$story){
            return redirect()->route('front.index');
         }

         // We're looking to build an array of form.
         /* [
             [
              'form_0_type_of_liquid' => [
                  'wordgroup' => 'Type of liquid',
                  'suggestions' => [ 'hypo', 'milk' ]
               ]
            ],
           ]
        */

         $formInputs = array();
         // Below condition always true cos form field will be null if there were
         // no matches at story creation by admin. Null form fields are not retrieved for play
         if (preg_match_all('/{([^}]*)}/', $story->content, $matches)) {
            $matchedWordgroups = array_map('trim', $matches[1]);
        }

        // To hold suggested wereywords in order to avoid duplicate suggestions
        $wereywordNames = array();

        foreach ($matchedWordgroups as $key => $matchedWordgroup) {
            $underscored = str_replace(' ', '_', $matchedWordgroup);
            $index = 'form_'. $key .'_'. $underscored;
            $wordgroupName = ucfirst( $matchedWordgroup );
            $suggestions = $this->getSuggestions( $wordgroupName, $wereywordNames );

            $formInput = [
                'wordgroup' => $wordgroupName,
                'suggestions' => $suggestions
            ];

            // Add to $formInputs
            $formInputs[$index] = $formInput;
            // Add suggestions to wereywordNames
            $wereywordNames = array_merge($wereywordNames, $suggestions);
            // $wereywordNames = $wereywordNames + $suggestions;
        }
        // dd($wereywordNames, $formInputs);
        return view('play-suggestions', [
            'story' => $story,
            'formInputs' => $formInputs
        ]);
    }

    private function getSuggestions($wordgroupName, $wereywordNames, $numOfSuggestions=5)
    {
        $wordgroup = Wordgroup::with([ 'wereywords' => function($query) use ($wereywordNames) {
            // $query->whereNotIn('name', $wereywordNames)->inRandomOrder();
            $query->inRandomOrder();
        }])->whereName($wordgroupName)->first();

        $suggestionsCollection = $wordgroup->wereywords->take($numOfSuggestions);
        $suggestions = array();

        foreach($suggestionsCollection as $sc) {
            $suggestions[] = $sc->name;
        }

        return $suggestions;
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

        // Not used, useless
        // $contentFormInputs = [];
        // if (preg_match_all('/{([^}]*)}/', $storyContent, $matches)) {
        //     $contentFormInputs = preg_replace('/\s+/', '_', $matches[1]);
        // }

        // Get the keys of the form inputs. e.g form_1_noun, form_2_type_of_liquid
        $combinedInputKeys =  array_keys($storyFormFields);

        // Replace every match of a set containing alphanumeric, underscore and whitespace characters 0 or more times
        // non-greedy by the match with whitespaces replaced with underscores in story content
        // $matches[0] is entire regex match, $matches[1] is the match(es) of the first occurring subpattern or group
        // e.g. type of liquid => type_of_liquid
        // $formattedStoryContent = preg_replace_callback("/\{[\w\s]*?\}/", function($matches) use ($storyFormFields){
        //     return preg_replace("/\s+/", "_", $matches[0]);
        //  }, $storyContent);

        // e.g. replace {type_of_liquid} => {form_0_noun}. Pass $combinedInputKeys by reference when it was looking through
        // $formattedStoryContent.
        // Now it's doing e.g. replace { type of liquid } => {form_0_type_of_liquid}.
        $processedStoryContent = preg_replace_callback('/\{(.+?)\}/', function () use(&$combinedInputKeys) {
        $replacement = array_shift($combinedInputKeys);
            return "{{$replacement}}";
        }, $storyContent);

        // Ignore case match. e.g. $storyFormFields['form_0_noun']
        // $match[1] is the match of the first group.
        $formedStory = preg_replace_callback('/{(.+?)}/ix',function($match)use($storyFormFields){
            return !empty($storyFormFields[$match[1]]) ? '<strong><u>'.$storyFormFields[$match[1]].'</u></strong>' : $match[0];
        }, $processedStoryContent);

        dd($storyFormFields, $storyContent, $processedStoryContent, $formedStory);

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

    public function getHints(Request $request)
    {
        // $fieldName = $request->fieldName;
        $wordgroupName = $request->wordgroupName;
        // dd($fieldName, $wordgroupName);

        // Get wereywords associated with the wordgroup
        $wordgroup = Wordgroup::with([ 'wereywords' => function ($query) {
            $query->inRandomOrder();
        }])->whereName($wordgroupName)->first();

        // Take 5 elements and retrieve only the 'name' columns in format ['name' => 'sweaty balls']
        $wereywords = $wordgroup->wereywords->take(5)->map->only('name');
        return $wereywords->toJson();
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
