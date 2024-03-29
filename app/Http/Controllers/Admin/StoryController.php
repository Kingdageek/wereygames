<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\Facades\Image;
use App\Models\Story;
use App\Models\UserStory;
use Validator;
use Log;
use Auth;
use App\Models\Wordgroup;
use App\Models\Wereyimage;
use App\Models\Settings;

class StoryController extends Controller
{
    private $wereywordHints;

    public function __construct()
    {
        $this->middleware('auth');
        $this->wereywordHints = Settings::first()->wereyword_hints;
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

            $story = new Story;
            $story->title = $request->input('title');
            $story->content = $request->input('content');

            if ($file = $request->hasFile('featured_image')) {
                $file = $request->file ('featured_image');
                $randomKey = sha1(time() . microtime());
                $extension = $file->getClientOriginalExtension();
                $fileName = $randomKey . '.' . $extension;
                $destinationPath = public_path (). '/uploads';

                /*$featuredImage = Image::make($file->getRealPath())->fit(900, 600, function ($constraint) {
                    $constraint->upsize();
                });*/

                $featuredImage = Image::make($file->getRealPath());
                $upload_success = $featuredImage->save($destinationPath . '/' . $fileName);

                if ($upload_success) {
                    $story->featured_photo = $fileName;
                }
            }

            $story->save();

            return redirect()->route('admin.stories')->with('success', 'Story successfully created');
        }

        return view('admin.story.create');
    }

    public function storeStory(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:stories',
            'content' => 'required',
            'image' => 'required|integer'
        ]);

        $story = new Story();
        $story->title = ucfirst($request->title);
        $story->content = $request->content;
        $story->wereyimage_id = $request->image;

        if ( ! preg_match_all('/{([^}]*)}/', $request->content, $matches) ) {
            return redirect()->back()
                        ->with('error', "You can't create a story without a wordgroup pattern. You don't want a mad libs game without libs aye")
                        ->withInput($request->input());
        }
        $contentWordgroups = array_map('trim', $matches[1]);
        foreach ($contentWordgroups as $contentWordgroup) {
            // check if match is not a Wordgroup
            $wordgroup = Wordgroup::where('name', $contentWordgroup)->first();
            if ( ! $wordgroup ) {
                return redirect()->back()
                        ->with('error', '<strong>' . $contentWordgroup . '</strong> is not a Wordgroup')
                        ->withInput($request->input());
            }

            // check if Wordgroup has at least specified wereywords
            if ( $wordgroup->wereywords->count() < $this->wereywordHints ) {
                return redirect()->back()
                        ->with('error', '<strong>' . $contentWordgroup . '</strong> Wordgroup has less than '. $this->wereywordHints .' Wereywords')
                        ->withInput($request->input());
            }
        }
        // autogenerate new form
        $story->form = $this->generateFormJson($contentWordgroups);

        // Persist
        $story->save();
        return redirect()->route('admin.stories')->with('success', 'Story successfully created');
    }

    private function generateFormJson ($matchedWordgroups)
    {
        // $matchedWordgroups is of form - [ 0 => 'noun', 1 => 'type of liquid' ]
        /* to store our array of form - [ 'form_0_type_of_liquid' => [
            'wordgroup'=>'Type of liquid',
            'placeholder'=>'randomly generated placeholder'
            ]
        ]
            We're basically trying to do most of the heavy lifting on the admin creation end
            to help make the user playing end be slighly more performant.
        */
        $formArray = array();

        // to store wordgroup wereyword names to try to prevent a word appearing > once
        $wereywordNames = array();

        foreach ($matchedWordgroups as $key => $wordgroupName) {
            $wordgroup = Wordgroup::with([ 'wereywords' => function ($query) use ($wereywordNames) {
                $query->whereNotIn('name', $wereywordNames)->inRandomOrder()->first();
            } ])->whereName($wordgroupName)->first();

            // We can use str_replace not preg_replace cos we're pretty sure it's a wordgroup
            $underscoredWordgroupName = str_replace(' ', '_', $wordgroupName);
            $wereyword = $wordgroup->wereywords->first()->name;

            $index = 'form_'. $key . '_'. $underscoredWordgroupName;
            // attach to formArray
            $formArray[$index] = [
                'wordgroup' => ucfirst($wordgroupName),
                'placeholder' => $wereyword
            ];

            // Note the name
            $wereywordNames[] = $wereyword;
        }
        return json_encode($formArray);
    }

    public function createStory()
    {
        $wereyimages = Wereyimage::orderBy('id', 'DESC')->get();
        return view('admin.story.create', compact('wereyimages'));
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

             if ($file = $request->hasFile('featured_image')) {
                $file = $request->file ('featured_image');
                $randomKey = sha1(time() . microtime());
                $extension = $file->getClientOriginalExtension();
                $fileName = $randomKey . '.' . $extension;
                $destinationPath = public_path (). '/uploads';

                /*$featuredImage = Image::make($file->getRealPath())->fit(900, 600, function ($constraint) {
                    $constraint->upsize();
                });*/

                $featuredImage = Image::make($file->getRealPath());
                $upload_success = $featuredImage->save($destinationPath . '/' . $fileName);

                if ($upload_success) {
                    $story->featured_photo = $fileName;
                }
            }

            $story->save();

            return redirect()->route('admin.stories')->with('success', 'Story successfully updated');
        }

        return view('admin.story.edit', [
            'story' => $story,
        ]);
    }

    public function editStory(Story $story)
    {
        $wereyimages = Wereyimage::orderBy('id', 'DESC')->get();
        return view('admin.story.edit', compact('story', 'wereyimages'));
    }

    public function updateStory(Story $story, Request $request)
    {
        // Validation is make sure title is unique in the title column ignore
        // the current story's title row
        $this->validate($request, [
            'title' => 'required|max:50|unique:stories,title,'. $story->id,
            'content' => 'required',
            'image' => 'required|integer'
        ]);

        if ( ! preg_match_all('/{([^}]*)}/', $request->content, $matches) ) {
            return redirect()->back()
                        ->with('error', "You can't create a story without a wordgroup pattern. You don't want a mad libs game without libs aye")
                        ->withInput($request->input());
        }
        $contentWordgroups = array_map('trim', $matches[1]);
        foreach ($contentWordgroups as $contentWordgroup) {
            // check if match is not a Wordgroup
            $wordgroup = Wordgroup::where('name', $contentWordgroup)->first();
            if ( ! $wordgroup ) {
                return redirect()->back()
                        ->with('error', '<strong>' . $contentWordgroup . '</strong> is not a Wordgroup')
                        ->withInput($request->input());
            }

            // check if Wordgroup has at least specified wereywords
            if ( $wordgroup->wereywords->count() < $this->wereywordHints ) {
                return redirect()->back()
                        ->with('error', '<strong>' . $contentWordgroup . '</strong> Wordgroup has less than '. $this->wereywordHints .' Wereywords')
                        ->withInput($request->input());
            }
        }
        // autogenerate new form
        $story->form = $this->generateFormJson($contentWordgroups);
        $story->title = ucfirst($request->title);
        $story->content = $request->content;
        $story->wereyimage_id = $request->image;
        $story->save();
        return redirect()->route('admin.stories')->with('success', 'Story successfully updated');
    }

    public function storyForm(Request $request, $id)
    {
        $story = Story::where('id', $id)->first();

        if($request->isMethod('POST')){
           $inputFields = $request->except('_token');

           // received $inputFields are converted to json and stored cos
           // the fields will be generated on the fly from certain
           // specifications in created story.

           $story->form = json_encode($inputFields);
           $story->save();

           return redirect()->route('admin.story.form.update', $story->id)->with('success', 'Form successfully saved');
        }

        $content = $story->content;
        $formInputs = [];

        // Basically match all occurences of that pattern in the story's content
        // Pattern basically is find any open and closing curly braces, group
        // everything within them then match every non-closing brace character

        if (preg_match_all('/{([^}]*)}/', $content, $matches)) {
            $formInputs = $matches[1]; //preg_replace('/\s+/', '_', $matches[1]);

            // Remove any preceding and trailing whitespace from match
            $formInputs = array_map('trim', $formInputs);
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

           $index = 0;
           foreach($inputFields as $key => $field) {
               $inputFields[$key] = array (
                    'wordgroup' => ucfirst(str_replace('_', ' ', ltrim($key, 'form_'. $index .'_'))),
                    'placeholder' => trim($field)
               );
               $index ++;
           }
           $story->form = json_encode($inputFields);
           $story->save();

           return redirect()->route('admin.story.form.update', $story->id)->with('success', 'Form successfully saved');
        }

        $storyContent = $story->content;
        $contentFormInputs = [];
        if (preg_match_all('/{([^}]*)}/', $storyContent, $matches)) {
            // To always trim user entered matches of preceding and trailing whitespaces
            // Failure to do that could cause irregular behaviors
            $matches[1] = array_map('trim', $matches[1]);

            // Replace any whitespace character within matched strings in $matches[1]
            // array with underscores
            $contentFormInputs = preg_replace('/\s+/', '_', $matches[1]);
        }

        $contentForm = [];
        foreach ($contentFormInputs as $key => $value) {
            $contentForm['form_'.$key.'_'.$value] = '';
        }

        $existingStoryInputs = json_decode($story->form, true);
        $formInputs = array_merge($contentForm, $existingStoryInputs);

        return view('admin.story.update_form', [
            'story' => $story,
            'formInputs' => $formInputs
        ]);
    }

    public function delete(Request $request, $id)
    {
        // This also deletes all created user stories associated with
        // this story.
        // Register Eloquent relationship.
        // One Story has Many UserStory s

        $story = Story::where('id', $id)->first();
        $userStory = UserStory::where('story_id', $story->id)->delete();
        $story->delete();
        return redirect()->back()->with('info', 'Story deleted successfully');
    }

    public function destroy (Story $story)
    {
        // This also deletes all created user stories associated with
        // this story.
        // Register Eloquent relationship.
        // One Story has Many UserStory s

        // Do not unlink anything
        // if ( file_exists($story->featured_photo) ) {
        //     unlink($story->featured_photo);
        // }
        $userStory = UserStory::where('story_id', $story->id);
        $userStory->delete();
        $story->delete();
        return redirect()->back()->with('status', 'Story deleted successfully');
    }

}
