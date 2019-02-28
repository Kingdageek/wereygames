<?php

namespace App\Http\Controllers;

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
        $agent = new Agent();
        $guestIdentifier = md5(request()->ip().session()->getId().$agent->platform().$agent->device().$agent->browser());
        $guest = Guest::where('identifier', $guestIdentifier)->first();

        if(!$guest){
            $guest = Guest::create([
                'identifier' => $guestIdentifier,
                'has_unlocked' => false
            ]);
        }

        session(['guest' => $guest]);

        $this->pageSeoService->index();

        return view('index');
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

        return view('preview', [
            'story' => $story,
            'formedStory' => $formedStory
        ]);
    }

}
