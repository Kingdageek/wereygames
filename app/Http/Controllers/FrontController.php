<?php

namespace App\Http\Controllers;

use Cookie;
use App\Models\Story;
use App\Models\Guest;
use App\Models\UserStory;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Services\PageSeoService;

class FrontController extends Controller
{
    protected $pageSeoService;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageSeoService $pageSeoService)
    {
        $this->pageSeoService = $pageSeoService;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cookie = Cookie::get('identifier');
        $guest = Guest::where('identifier', $cookie)->first();

        if(!$guest){
            $agent = new Agent();
            $guestIdentifier = md5(request()->ip().session()->getId().$agent->platform().$agent->device().$agent->browser());
            $guest = Guest::create([
                'identifier' => $guestIdentifier,
                'has_unlocked' => false
            ]);
        }

        session(['guest' => $guest]);

        $this->pageSeoService->index();

        return response()->view('index-backup')->cookie('identifier', $guest->identifier);
        // return response()->view('index')->cookie('identifier', $guest->identifier);
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

        $this->pageSeoService->preview($story, $formedStory);

        views($formedStory)->delayInSession(2)->record();

        $socialShare = str_limit(strip_tags($formedStory->content),185);

        return view('preview', [
            'story' => $story,
            'formedStory' => $formedStory,
            'socialShare' => $socialShare
        ]);
    }

    public function about()
    {
        return view('about');
    }

}
